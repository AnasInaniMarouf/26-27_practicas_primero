<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
function muestraArray($array) {

    $arrayToString = "";

    foreach ($array as $indice => $valor) {
        if(is_array($valor)) {
            $arrayToString = $arrayToString . "<br>Array de la posicion " . $indice . ": <br>" . muestraArray($valor);

        } else {
            $arrayToString = $arrayToString . "Elemento de la posicion " . $indice . " del array: " . $valor . "<br>";
        }
            
    }

    return $arrayToString;
}
//dibuja la plantilla de la vista
inicioCabecera("Ejercicio 3");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 3");
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
        <li><a href="#">Ejercicio 3</a></li>
    </ul>

    <main class="contenidoPrincipal">
<?php

    //Crear y rellenar el array en varias sentencias
    $array[1] = 23;
    $array[16] = "saludos";
    $array[54] = true;
    
    $array[] = 34;  //añadir el valor al final

    $array["uno"] = "cadena";
    $array["dos"] = true;
    $array["tres"] = 1.345;
    $array["ultima"] = [1.34, "nueva"];

    $tope = count($array); 

    echo muestraArray($array);
    
    //Crear y rellenar el array en una sola sentencia
    

?>
    </main>
<?php
}