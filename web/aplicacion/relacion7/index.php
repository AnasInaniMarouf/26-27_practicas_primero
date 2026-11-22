<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
$barra=[
    [
        "TEXTO"=> "Inicio",
        "ENLACE" =>"/index.php"
    ],
    [
        "TEXTO" => "Relacion 7",
        "ENLACE" => ""
    ]
];

leerFicheroPuntos(nombreFicheroFormateado(".dat", "puntos_"));

$datos = [
    "x" => 0,
    "y" => 0,
    "color",
    "grosor"
];

$errores = [];

if(isset($_POST["añadir"])) {
    if(validarFormulario($datos, $errores)) {
        crearFicheroPuntos(creaPunto($datos));  //primero crea el punto y luego actualiza el fichero para que aparezca en el
    }
}

if(isset($_POST["borrar"])) {
    $puntoABorrar = trim($_POST["punto"]);
    $puntoABorrar = explode(";", $puntoABorrar);

    foreach (Punto::$Puntos as $indice => $punto) {
        if ($punto->getX() == intval($puntoABorrar[0]) &&
                $punto->getY() == intval($puntoABorrar[1]) &&
                $punto->getColor() == $puntoABorrar[2] &&
                $punto->getGrosor() == intval($puntoABorrar[3])) { //si las propiedades del punto coinciden se borra el punto
            unset(Punto::$Puntos[$indice]); //se elimina el punto
        }
    }

    crearFicheroPuntos(Punto::$Puntos, "w");    //w para que sobreescriba todo lo que haya, asi solo quedaran los puntos que no se hayan borrado
}

if(isset($_POST["subir"])) {
    $archivo = $_FILES["archivo"];
    escribirAFichero(nombreFicheroFormateado($archivo["name"]), Punto::$Puntos);
}

//dibuja la plantilla de la vista
inicioCabecera("Relacion 7");
cabecera();
finCabecera();
inicioCuerpo("Relacion 7 - Ficheros", $barra);
cuerpo($datos, $errores); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera()
{}
//vista
function cuerpo(array $datos, array $errores)
{
?>
<main class="contenidoPrincipal">
<?php
// new Punto(1, 1, "black", 3);
// new Punto(2, 2, "blue", 2);
// new Punto(3, 3, "white", 1);
// escribirAFichero(nombreFicheroFormateado(".txt"), Punto::$Puntos);
// echo ipConBarrabajas($_SERVER["REMOTE_ADDR"]) . "<br>";  
// echo $_SERVER["HTTP_USER_AGENT"];
// echo navegador();
// echo $_SERVER["DOCUMENT_ROOT"];
// echo obtenerExtension("imagen.png");
formulario($datos, $errores);    
?>
</main>
<?php
}

/**
 * Funcion que muestra el formulario completo,
 * llamando a la funcion muestraError, para que si
 * hubiera algun error lo muestre al lado del campo erroneo
 *
 * @param array $datos
 * @param array $errores
 * @return void
 */
function formulario(array $datos, array $errores): void {
?> 
    <form action="index.php" method="post">
        <h3>Formulario</h3>
        <label>Coordenada X:</label><input type="text" name="x" value="<?php echo $datos["x"] ?>" maxlength="3" size="3">
        <?php muestraError($errores, "x") ?>
        <br>
        <label>Coordenada Y:</label><input type="text" name="y" value="<?php echo $datos["y"] ?>" maxlength="3" size="3">
        <?php muestraError($errores, "y") ?>
        <div>
            <label>Color:</label> 
            <select name="color">
                <?php
                    foreach(Punto::COLORES as $claveColor => $nombreColor) {
                        ?><option value="<?php echo $claveColor ?>"><?php echo $nombreColor["nombre"] ?></option>
                    <?php }
                ?>
            </select>
        </div>
        <?php muestraError($errores, "color") ?>
        <div>
            <label>Grosor:</label>
            <br>
            <?php
                foreach(Punto::GROSORES as $claveGrosor => $nombreGrosor):
                    ?><input type="radio" name="grosor" value="<?php echo $claveGrosor ?>"><?php echo $nombreGrosor ?><br>
                <?php endforeach
            ?>
            <button type="submit" name="añadir" class="boton">Añadir punto</button>
        </div>
        <?php muestraError($errores, "grosor") ?>
    </form>
    <form action="index.php" method="post">
        <div>
            <h3>Borrar Punto</h3>
            <select name="punto">
                <?php foreach(Punto::$Puntos as $punto): ?>
                    <option value="<?php echo $punto->toStringSimple() ?>"><?php echo $punto->toStringSimple() ?></option>
                <?php endforeach ?>
            </select>
            <button type="submit" name="borrar">Borrar</button>
        </div>
    </form>
    <div>
        <h3>Resumen de puntos</h3>
        <textarea name="" id="" cols="50" rows="10"><?php 
            foreach(Punto::$Puntos as $punto) {
                echo $punto . PHP_EOL;
            } ?>
        </textarea>
    </div>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <div>
            <h3>Subir fichero de puntos</h3>
            <label>Fichero:</label>
            <input type="file" name="archivo">
            <br>
            <button type="submit" name="subir">Subir</button>
        </div>
    </form>
    <div>
        <h3>Imagen</h3>
        <img src="<?php echo crearImagen(nombreFicheroFormateado(".png"), Punto::$Puntos) ?>" alt="">
        <br>
        <a href="">Descargar Imagen</a>
    </div>
<?php
}

/**
 * Funcion que a partir de un campo, comprueba que existe
 * dentro del array de errores, y añade un span con el error
 * ocurrido
 *
 * @param string $campo
 * @return void
 */
function muestraError(array $errores, string $campo): void {
    if(isset($errores[$campo])) { ?>
        <span class="error"><?php echo $errores[$campo] ?></span>
    <?php }
}

/**
 * Funcion que recorre los datos enviados por post, y los valida,
 * si todo esta bien devuelve true, si hay algo mal, se añade al array
 * de errores para mostrarlo despues en la vista y devuelve false
 *
 * @param array $datos
 * @param array $errores
 * @return boolean
 */
function validarFormulario(array &$datos, array &$errores):bool {
    $x = intval(trim($_POST["x"]));
    $y = intval(trim($_POST["y"]));
    $color = $_POST["color"] ?? null;   //en caso de que no haya ninguno seleccionado
    $grosor = $_POST["grosor"] ?? null; //igual que el color
    
    //para que no haya negativos, y el 0 es porque si no se puede parsear es lo que devuelve intval(), asi sé que no es un numero
    if($x <= 0) {
        $errores["x"] = "La coordenada x tiene que ser un numero entero positivo";
    }

    if($y <= 0) {
        $errores["y"] = "La coordenada y tiene que ser un numero entero positivo";
    }

    //si no hay ninguno seleccionado, se le habra asignado null, asi se captura y se añade a errores
    if($color == null) {
        $errores["color"] = "Debe de haber un color seleccionado";
    }

    if($grosor == null) {
        $errores["grosor"] = "Debe de haber un grosor seleccionado";
    }

    $datos["x"] = $x;
    $datos["y"] = $y;
    $datos["color"] = $color;
    $datos["grosor"] = $grosor;

    // echo $x;
    // echo $y;
    // echo $color;
    // echo $grosor;
    
    return count($errores) == 0; //si hay 0 errores devuelve verdadero, si no falso
}

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
    else if(mb_stripos($navegador, "edge")) return "edge";
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

    $imagen = imagecreatetruecolor(400, 400);   //crea una imagen de 400x400

    //colores para la imagen
    $blanco = imagecolorallocate($imagen, 255, 255, 255);
    $verde = imagecolorallocate($imagen, 0, 128, 128);

    imagefill($imagen, 0, 0, $blanco);  //rellena la imagen de blanco
    imagerectangle($imagen, 0, 0, 399, 399, $verde);    //399x399 para que el borde tenga tamaño 1 (400 de la imagen menos 399)

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
    if($datos == null) return false;

    $ruta = $_SERVER["DOCUMENT_ROOT"] . "/imagenes/puntos/";    //ruta donde se guardara el fichero

    //si no existe la ruta se crea
    if(!file_exists($ruta)) mkdir($ruta);

    $ruta .= $nombre;

    $fichero = fopen($ruta, $modo);   //se abre el fichero para la escritura ("w"), o si existe se añade el contenido al final ("a" de append)

    if(!$fichero) return false;

    // foreach($datos as $fila) {
    //     $linea = "";

    //     foreach($fila as $columna) {
    //         $linea .= $columna . ", ";
    //     }
    //     $linea .= "\r\n";

    //     fputs($fichero, $linea);    //se escribe en el fichero una linea
    // }

    foreach($datos as $punto) {
        fputs($fichero, $punto->toStringSimple() . "\r\n");
    }

    fclose($fichero);   //se cierra el fichero

    return true;
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