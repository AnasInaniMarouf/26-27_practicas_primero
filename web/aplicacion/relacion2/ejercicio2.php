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
        "TEXTO" => "Ejercicio 2",
        "ENLACE" => ""
    ]
];

//dibuja la plantilla de la vista
inicioCabecera("Ejercicio 2");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 2", $barra);
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
?>
    </main>
<?php
}