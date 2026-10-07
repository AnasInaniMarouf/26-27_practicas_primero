<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../../aplicacion/librerias/libreriaMatematica.php");
//require_once "/../../aplicacion/librerias/libreriaMatematica.php";
//controlador
$barra=[
    [
        "TEXTO"=> "Inicio",
        "ENLACE" =>"/index.php"//, "ADICIONAL"=>">>"
    ],
    /*[ 
        "TEXTO"=> "otro"   
    ],*/  
    [ 
        "TEXTO"=> "Index"/*,
        "ADICIONAL"=> "&copy;&copy;"*/
    ]
];
//dibuja la plantilla de la vista
inicioCabecera("Ejercicio 1");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 1 - Funciones Matematicas",);
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
        <li><a href="#">Ejercicio 1</a></li>
    </ul>
    <main class="contenidoPrincipal">
<?php

    echo "Redondeo(Round) del numero 5.67: " . redondeoRound(5.67);
    echo "<br><br>Redondeo(Floor) del numero 5.67: " . redondeoFloor(5.67);
    echo "<br><br>Potencia en base 3 de 5: " . potencia(3, 5);
    echo "<br><br>Raiz cuadrada de 121: " . raiz(121);
    echo "<br><br>Numero 30 a hexadecimal: " . enteroAHex(30);
    echo "<br><br>Numero 12 en base 4 a base 8: " . base4ABase8(12);
    echo "<br><br>Logaritmo en base 100 de 10000: " . logartimo(10000, 100);
    echo "<br><br>Hipotenusa del triangulo de lados 5 y 6: " . hipotenusa(5, 6);
?>
    </main>
<?php
}