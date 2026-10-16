<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//Para incluir las funciones de la libreria Matematica
include_once(dirname(__FILE__) . "/../../aplicacion/librerias/libreriaMatematica.php");
//require_once "/../../aplicacion/librerias/libreriaMatematica.php";
//controlador
$barra=[
    [
        "TEXTO"=> "Inicio",
        "ENLACE" =>"/index.php"//, "ADICIONAL"=>">>"
    ],
    [
        "TEXTO" => "Relacion 2",
        "ENLACE" => "./index.php"
    ],
    [
        "TEXTO" => "Ejercicio 1",
        "ENLACE" => ""
    ]
];

//dibuja la plantilla de la vista
inicioCabecera("Ejercicio 1");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 1", $barra);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
?>
    <main class="contenidoPrincipal">
<?php

    $var = "cadena";

    $texto1 =<<<fin
        Esta es una cadena <br>
        Esta es otra $var
    fin;

    $var2 = "NowDoc";

    $texto2=<<<'fin'
        Esta es una cadena con NowDoc
        Esta es otra cadena con
    fin;


    echo $texto1;
?>
    </main>
<?php
}