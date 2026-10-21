<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
$barra=[
    [
        "TEXTO"=> "Inicio",
        "ENLACE" =>"/index.php"//, "ADICIONAL"=>">>"
    ],
    [
        "TEXTO" => "Relacion 2",
        "ENLACE" => ""
    ]
];

//dibuja la plantilla de la vista
inicioCabecera("Relacion 2");
cabecera();
finCabecera();
inicioCuerpo("Relacion 2 - Cadenas", $barra);
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
    </ul>
<?php
}