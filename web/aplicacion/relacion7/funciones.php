<?php
/**
 * He creado este archivo porque necesitaba algunas funciones (que estaban
 * inicialmente en index.php) para utilizarlas en imagen.php, y he aprovechado
 * y he movido todas las funciones a exepcion de la creacion y validacion de
 * formularios (y tambien la de mostrar un error). Asi se queda mas limpio y
 * corto el index
 */
include_once(dirname(__FILE__) . "/../../cabecera.php");

/**
 * Funcion que crea un punto nuevo a partir de los datos obtenidos,
 * solo se creara si todo el formulario es correcto
 *
 * @param array $datos
 * @return Punto nuevo punto creado
 */
function creaPunto(array $datos): Punto {
    return new Punto($datos["x"], $datos["y"], $datos["color"], $datos["grosor"]);
}

/**
 * Funcion que sustituye todos los puntos de la ip
 * del cliente por barrabajas
 *
 * @return string $ip formateda
 */
function ipConBarrabajas(): string {
    return str_replace(".", "_", $_SERVER["REMOTE_ADDR"]);  //reemplaza los puntos por _ de la ip
}

/**
 * Funcion que obtiene los datos del navegador que esta utilizando el cliente
 * y devuelve el nombre del propio navegador
 *
 * @return string 
 */
function navegador(): string {
    $navegador = $_SERVER["HTTP_USER_AGENT"];
    
    //Comprueba que navegador se esta utilizando, y devuelve una cadena con el nombre
    if(mb_strripos($navegador, "chrome")) return "chrome";
    else if(mb_stripos($navegador, "firefox")) return "firefox";
    else return "otro";
}

/**
 * Funcion que devuelve la ip, junto con el nombre del
 * navegador y ademas la extension del archivo que se le pasa
 *
 * @param string $nombre
 * @return string ip + navegador + extension edl nombre del fichero
 */
function nombreFicheroFormateado(string $nombre, string $tipo = ""): string {
    return $tipo . ipConBarrabajas() . "_" . navegador() . obtenerExtension($nombre);
}

/**
 * Funcion que crea una imagen a partir de los puntos que se le pasa
 *
 * @param string $nombre
 * @param array $puntos
 * @return string ruta de la imagen para despues ponerlo en el src de img del formulario de la vista
 */
function crearImagen(string $nombre, array $puntos): string {
    $rutaImagen = "/imagenes/puntos/";
    
    if(!file_exists($_SERVER["DOCUMENT_ROOT"] . $rutaImagen)) mkdir($_SERVER["DOCUMENT_ROOT"] . $rutaImagen);

    $rutaImagen .= "imagen_" . $nombre;
    $ruta = $_SERVER["DOCUMENT_ROOT"] . $rutaImagen;

    $imagen = imagecreatetruecolor(500, 500);   //crea una imagen de 500x500

    //colores para la imagen
    $blanco = imagecolorallocate($imagen, 255, 255, 255);
    $verde = imagecolorallocate($imagen, 0, 128, 128);

    imagefill($imagen, 0, 0, $blanco);  //rellena la imagen de blanco
    imagerectangle($imagen, 0, 0, 499, 499, $verde);    //499x499 para que el borde tenga tamaño 1 (500 de la imagen menos 499)

    foreach($puntos as $punto) {
        $rgbPunto = Punto::COLORES[$punto->getColor()]["rgb"];  //array de rgb del color
        $color = imagecolorallocate($imagen, $rgbPunto[0], $rgbPunto[1], $rgbPunto[2]); //crea el color para la imagen
        imagefilledellipse($imagen, $punto->getX(), $punto->getY(), $punto->getGrosor() * 10, $punto->getGrosor() * 10, $color);  //añade el punto a la imagen, con sus coordenadas y su grosor (los he multiplicado por 10 para que se vean mejor)
    }

    imagepng($imagen, $ruta);

    return $rutaImagen;
}

/**
 * Funcion que llama a la funcion escribirAFichero para escribir los puntos
 * Si punto es un punto se le pasa entre corchetes para decir que es un array,
 * si es un array se le pasa y ya, y si es un nulo se pasa null
 *
 * @param Punto|array|null|null $punto
 * @param string $modo
 * @return boolean
 */
function crearFicheroPuntos(Punto|array|null $punto = null, string $modo = "a"): bool {
    return escribirAFichero(nombreFicheroFormateado(".dat", "puntos_"),
        ($punto == null)? null : (is_array($punto)? $punto : [$punto]),
        $modo);
}

/**
 * Funcion que escribe en un fichero el array de datos que se le pasa,
 * si datos es null, devuelve false nada mas entrar en la funcion
 *
 * @param string $nombre
 * @param array|null $datos
 * @param string $modo  "a" para añadir nuevos datos, "w" para sobreescribir todo
 * @return boolean
 */
function escribirAFichero(string $nombre, array|null $datos, string $modo = "a"): bool {
    $ruta = $_SERVER["DOCUMENT_ROOT"] . "/imagenes/puntos/";    //ruta donde se guardara el fichero

    //si no existe la ruta se crea
    if(!file_exists($ruta)) mkdir($ruta);

    $ruta .= $nombre;

    $fichero = fopen($ruta, $modo);   //se abre el fichero para la escritura ("w"), o si existe se añade el contenido al final ("a" de append)

    if(!$fichero) return false;

    if($datos == null) {    //si no hay datos limpia el fichero y devuelve falso
        fputs($fichero, "");
        return false;
    }

    foreach($datos as $punto) {
        fputs($fichero, $punto->toStringSimple() . "\r\n");
    }

    fclose($fichero);   //se cierra el fichero

    return true;
}

/**
 * Funcion que busca en el nombre del archivo la extension,
 * si la encuentra la devuelve invertida (porque el bucle se
 * recorre del reves)
 *
 * @param string $nombre
 * @return string|null si no hay punto devuelve nulo
 */
function obtenerExtension(string $nombre): string | null {
    $extension = "";
    $puntoEncontrado = false;

    //bucle que recorre el nombre del archivo del reves
    for($i = mb_strlen($nombre) - 1; $i >= 0 && !$puntoEncontrado; $i--) {
        $extension .= $nombre[$i];
        if($nombre[$i] == ".") $puntoEncontrado = true;
    }

    return $puntoEncontrado? strrev($extension) : null;
}

/**
 * Funcion que lee un fichero, y va creando puntos en base
 * al numero de lineas que haya en el fichero (conforme se
 * vayan creando los puntos tambien se van añadiendo al array
 * de puntos)
 *
 * @param string $nombre
 * @return boolean
 */
function leerFicheroPuntos(string $nombre): bool {
    $ruta = $_SERVER["DOCUMENT_ROOT"] . "/imagenes/puntos/";

    if(!file_exists($ruta)) mkdir($ruta);

    $ruta .= $nombre;

    if(!file_exists($ruta)) return false;

    $fichero = fopen($ruta, "r");

    //bucle que lee el fichero linea a linea
    while($linea = fgets($fichero)) {
        $linea = str_replace("\r", "", $linea);
        $linea = str_replace("\n", "", $linea);

        if($linea != "") {
            $linea = explode(";", $linea);  //separa los elementos por punto y coma
            new Punto(intval($linea[0]), intval($linea[1]), $linea[2], intval($linea[3]));  //crea un nuevo punto por linea y automaticamente lo añade al array de puntos
        }
    }

    fclose($fichero);

    return true;
}

/**
 * Funcion que lee un fichero subido, y va creando puntos en base
 * al numero de lineas que haya en el fichero (conforme se
 * vayan creando los puntos tambien se van añadiendo al array
 * de puntos)
 *
 * @param string $ruta
 * @return boolean
 */
function leerDeFicheroPuntosSubido(string $ruta): bool {
    if (!is_file($ruta)) {
        return false;
    }

    $fichero = fopen($ruta, "r");
    if (!$fichero) {
        return false;
    }

    while (($linea = fgets($fichero)) !== false) {
        $linea = trim($linea);

        if($linea != "") {
            $linea = explode(";", $linea);  //separa los elementos por punto y coma

            if(count($linea) == 4)  //si no hay 4 elementos no es valido, por lo que no se añade
                new Punto(intval($linea[0]), intval($linea[1]), $linea[2], intval($linea[3]));  //crea un nuevo punto por linea y automaticamente lo añade al array de puntos
        }
    
    }

    fclose($fichero);
    return true;
}
