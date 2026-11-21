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

$datos = [
    "x" => 0,
    "y" => 0,
    "color",
    "grosor"
];

$errores = [];

if(isset($_POST["añadir"])) {
    if(validarFormulario($datos, $errores)) {
        creaPunto($datos);
    }
}

if(isset($_POST["borrar"])) {
    
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
formulario($datos, $errores);
?>
</main>
<?php
}

function formulario(array $datos, array $errores) {
?> 
    <form action="index.php" method="post">
        <h3>Formulario</h3>
        <label>Coordenada X:</label><input type="text" name="x" value="<?php echo $datos["x"] ?>" maxlength="3" size="3">
        <?php muestraError("x") ?>
        <br>
        <label>Coordenada Y:</label><input type="text" name="y" value="<?php echo $datos["y"] ?>" maxlength="3" size="3">
        <?php muestraError("y") ?>
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
        <?php muestraError("color") ?>
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
        <?php muestraError("grosor") ?>
    </form>
    <div>
        <h3>Borrar Punto</h3>
        <select name="punto">
            <?php foreach(Punto::$Puntos as $punto): ?>
                <option><?php echo $punto->toStringSimple() ?></option>
            <?php endforeach ?>
        </select>
        <button type="submit" name="borrar">Borrar</button>
    </div>
    <div>
        <h3>Resumen de puntos</h3>
        <textarea name="" id="" cols="50" rows="10"><?php 
            foreach(Punto::$Puntos as $punto) {
                echo $punto . PHP_EOL;
            } ?>
        </textarea>
    </div>
    <div>
        <h3>Subir fichero de puntos</h3>
        <label>Fichero:</label>
        <input type="file" name="" id="">
        <br>
        <button>Subir</button>
    </div>
    <div>
        <h3>Imagen</h3>
        <img src="" alt="">
        <br>
        <a href="">Descargar Imagen</a>
    </div>
<?php
}

function muestraError(string $campo) {
    if(isset($errores[$campo])) { ?>
            <span class="error"><?php echo $errores[$campo] ?></span>
    <?php }
}

function validarFormulario(array &$datos, array &$errores):bool {
    $x = intval(trim($_POST["x"]));
    $y = intval(trim($_POST["y"]));
    $color = $_POST["color"];
    $grosor = $_POST["grosor"];
    
    //para que no haya negativos, y el 0 es porque si no se puede parsear es lo que devuelve intval(), asi sé que no es un numero
    if($x <= 0) {
        $errores["x"] = "La coordenada x tiene que ser un numero entero positivo";
    }

    if($y <= 0) {
        $errores["y"] = "La coordenada y tiene que ser un numero entero positivo";
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

function creaPunto(array $datos) {
    return new Punto($datos["x"], $datos["y"], $datos["color"], $datos["grosor"]);
}