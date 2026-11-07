<?php

use function VALNORMAL\validaFecha;

include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../../scripts/librerias/val_normal.php");
//controlador
$barra=[
    [
        "TEXTO"=> "Inicio",
        "ENLACE" =>"/index.php"
    ],
    [
        "TEXTO" => "Relacion 5",
        "ENLACE" => ""
    ]
];

//dibuja la plantilla de la vista
inicioCabecera("Relacion 5");
cabecera();
finCabecera();
inicioCuerpo("Relacion 5 - Informacion", $barra);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera()
{}
//vista
function cuerpo()
{
?>
<main class="contenidoPrincipal">
<?php
$fecha = "6/7/2026";
validaFecha($fecha, "01/01/2026");
echo $fecha . PHP_EOL;
?>
</main>
<?php
}