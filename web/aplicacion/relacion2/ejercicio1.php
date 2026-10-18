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

    $textoComillas1 = "Esta es una $var con comillas dobles<br>" . PHP_EOL .
                        "Esta es una cadena con una ñ y una etiqueta < br><br>" . PHP_EOL;

    $textoComillas2 = 'Esta es una ' . $var . ' con comillas dobles<br>' . PHP_EOL . //Con comillas simples no se puede poner variables dentro
                        'Esta es una cadena con una ñ y una etiqueta < br><br>' . PHP_EOL;

    $var1 = "HEREDOC";

    $texto1 =<<<fin
        Esta es una cadena con 'HEREDOC' <br>
        Esta es otra cadena con "$var1" <br>
        Esta es una cadena con una tílde á<br>
        Esta es una cadena con una etiqueta < br><br>
        fin . PHP_EOL;

    //Con nowdoc no se pueden mostrar las variables
    $var2 = "NOWDOC";

    $texto2=<<<'fin'
        Esta es una cadena con 'NOWDOC' <br>
        Esta es otra cadena con "$var2" <br>
        Esta es una cadena con una tílde á<br>
        Esta es una cadena con una etiqueta < br><br>
        fin . PHP_EOL;

    echo $textoComillas1;
    echo $textoComillas2;
    echo $texto1;
    echo $texto2;
?>
</main>
<?php
}