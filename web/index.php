<?php
include_once(dirname(__FILE__) . "/cabecera.php");
//controlador
$barra=[
    [
        "TEXTO"=> "Inicio",
        "ENLACE" =>"/index.php"//, "ADICIONAL"=>">>"
    ]/*,
    [ 
        "TEXTO"=> "otro"   
    ],
    [ 
        "TEXTO"=> "Index"/*,
        "ADICIONAL"=> "&copy;&copy;"
    ]*/
];

//dibuja la plantilla de la vista
inicioCabecera("Practica 1");
cabecera();
finCabecera();
inicioCuerpo("INICIO", $barra);
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
            <a href="./aplicacion/relacion1/index.php">Relacion 1</a>
        </li>
        <li>
            <a href="./aplicacion/relacion2/index.php">Relacion 2</a>
        </li>
        <li>
            <a href="./aplicacion/relacion3/index.php">Relacion 3</a>
        </li>
        <li>
            <a href="./aplicacion/relacion4/index.php">Relacion 4</a>
        </li>
    </ul>
<?php
}