<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
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
        "ADICIONAL"=> "&copy;&copy;"   */
    ]
];

//dibuja la plantilla de la vista
inicioCabecera("Practica 1");
cabecera();
finCabecera();
inicioCuerpo("EJERCICIOS", $barra);
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
    <ul class="menuOpciones">
        <li>
            <a href="ejercicio1.php">Ejercicio 1</a>
        </li>
        <li>
            <a href="ejercicio2.php">Ejercicio 2</a>
        </li>
        <li>
            <a href="ejercicio3.php">Ejercicio 3</a>
        </li>
        <li>
            <a href="ejercicio4.php">Ejercicio 4</a>
        </li>
        <li>
            <a href="ejercicio5.php">Ejercicio 5</a>
        </li>
        <li>
            <a href="ejercicio6.php">Ejercicio 6</a>
        </li>
        <li>
            <a href="ejercicio7.php">Ejercicio 7</a>
        </li>
    </ul>
    <ul class="barraUbicacion">
        <li><a href="/index.php">Inicio</a></li>
        <li><a href="/aplicacion/relacion1/index.php">Ejercicios</a></li>
    </ul>
<?php
}