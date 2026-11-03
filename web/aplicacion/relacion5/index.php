<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
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

?>
</main>
<?php
}