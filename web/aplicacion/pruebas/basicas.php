<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
$barra=[
    [
        "TEXTO"=> "Inicio",
        "ENLACE" =>"/index.php"//, "ADICIONAL"=>">>"
    ],
    [
        "TEXTO" => "Pruebas",
        "ENLACE" => "./index.php"
    ],
    [
        "TEXTO" => "Prueba Basica",
        "ENLACE" => ""
    ]
];

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("pruebas basicas", $barra);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
?>
    <br><br>esto es html
    <?php 
        echo "klñfffdj";
    ?>

<?php
}
