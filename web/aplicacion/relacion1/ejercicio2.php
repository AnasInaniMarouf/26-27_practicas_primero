<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
function lanzamientoDado6() {
    $array = [];

    for($i = 0; $i < 6; $i++) {
        $array[$i] = mt_rand(1, 6);
    }

    return $array;
}

function mostrarArray($array) {
    $valoresArray = "";

    for($i = 0; $i < count($array); $i++) {
        $valoresArray . "Lanzamiento " . $i + 1 . "del dado: " . $array[$i] . "<br>";
    }

    return $valoresArray;
}

function lanzamientoDado($numLanzamientos) {
    for($i = 1; $i <= $numLanzamientos; $i++) {

    }
}
//dibuja la plantilla de la vista
inicioCabecera("Ejercicio 2");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 2 - Lanzamiento de Dados");
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
?>
    <ul class="barraUbicacion">
        <li><a href="/index.php">Inicio</a></li>
        <li><a href="/aplicacion/relacion1/index.php">Ejercicios</a></li>
        <li><a href="#">Ejercicio 2</a></li>
    </ul>
<?php
    echo mostrarArray(lanzamientoDado6());
}