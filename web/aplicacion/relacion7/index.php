<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/funciones.php");
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

leerFicheroPuntos(nombreFicheroFormateado(".dat", "puntos_"));  //lee los puntos que haya en el fichero para cargarlos inicialmente

$datos = [
    "x" => 0,
    "y" => 0,
    "color" => "",
    "grosor" => ""
];

$errores = [];

if(isset($_POST["añadir"])) {
    if(validarFormulario($datos, $errores)) {
        crearFicheroPuntos(creaPunto($datos));  //primero crea el punto y luego actualiza el fichero para que aparezca en el
    }
}

if(isset($_POST["borrar"])) {
    if(isset($_POST["punto"])) {    //si existe algun punto
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
}

if(isset($_POST["subir"])) {
    $archivo = $_FILES["archivo"];
    
    if (obtenerExtension($archivo["name"]) == ".txt") { //si la extension del nombre del archivoes .txt
        leerDeFicheroPuntosSubido($archivo["tmp_name"]);
        crearFicheroPuntos(Punto::$Puntos, "w");
    }
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
        <textarea name="" id="" cols="50" rows="10"><?php foreach(Punto::$Puntos as $punto) {echo $punto . PHP_EOL;}?></textarea>   <!--Lo he tendio que poner todo junto en una linea para que no cree espacios dentro-->
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
        <a href="imagen.php" target="_blank">Descargar Imagen</a>
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
    if($x <= 0 || $x >= 500) {
        $errores["x"] = "La coordenada x tiene que ser un numero entero positivo y menor a 500";
    }

    if($y <= 0 || $y >= 500) {
        $errores["y"] = "La coordenada y tiene que ser un numero entero positivo y menor a 500";
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
