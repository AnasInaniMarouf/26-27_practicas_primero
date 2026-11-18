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

//dibuja la plantilla de la vista
inicioCabecera("Relacion 7");
cabecera();
finCabecera();
inicioCuerpo("Relacion 7 - Ficheros", $barra);
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

?>
</main>
<?php
}