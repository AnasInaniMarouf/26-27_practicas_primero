<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
function crearVector() {
    $vector=array();
    $vector[1]="esto es una cadena";
    $vector["posi1"]=25.67;
    $vector[]=false;
    $vector["ultima"]=array(2,5,96);
    $vector[56]=23;

    return $vector;
}

function muestraVector($variable) {

    /*- posicion XXX contenido (tipo) YYYYY
    - Según el tipo del contenido
    o Si es un array mostrarlo mediante un foreach.
    o Si es un entero poner Entero con valor DDD, en binario BBB
    o Si es un real DDD que al cuadrado es DDD
    o Si es una cadena -CCCCo Si es un booleano BBB y su opuesto XXX
    Las palabras en mayúscula representan un valor concreto de lo pedido
    */

    $resultado = "";
    $tipo = "";

    if(is_array($variable)) {
        foreach ($variable as $clave => $valor) {
            $resultado .= "posicion " . $clave . "contenido(tipo) " . $valor . "<br>";
        }
    } else {

        if(is_int($variable) || is_float($variable)) {
            $tipo = "DDD";
        } else if(is_bool($variable)) {

        }

        if(is_string($variable)) {
            $tipo = "CCCC";
        }

        //$resultado .= "posicion " . $clave . "contenido(tipo) " . $valor . "<br>";
    }

    return $resultado;
}
//dibuja la plantilla de la vista
inicioCabecera("Ejercicio 5");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 5");
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
        <li><a href="#">Ejercicio 5</a></li>
    </ul>
    <main class="contenidoPrincipal">
<?php

    echo muestraVector(crearVector());

?>
    </main>
<?php
}