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
    ]
];

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $barra);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
?>
    <ul class="menuOpciones">
        <li>
            <a href="basicas.php">Funcionamiento básico</a>
        </li>
        <li>
            <a href="array.php">Prueba de arrays</a>
        </li>
    </ul>
    <main class="contenidoPrincipal">
        Elemento de pruebas
    </main>

<?php
}
