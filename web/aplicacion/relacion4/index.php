<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../../scripts/clases/InstrumentoBase.php");
//controlador
$barra=[
    [
        "TEXTO"=> "Inicio",
        "ENLACE" =>"/index.php"
    ],
    [
        "TEXTO" => "Relacion 4",
        "ENLACE" => ""
    ]
];

//dibuja la plantilla de la vista
inicioCabecera("Relacion 4");
cabecera();
finCabecera();
inicioCuerpo("Relacion 4 - Clases", $barra);
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
//Prueba del funcionamiento de la clase InstrumentoBase
// $instrumento1 = new InstrumentoBase("Violin", 2);
// $instrumento2 = new InstrumentoBase("Piano");
// echo $instrumento1 -> echoInstrumentoBase();
// echo $instrumento2 -> echoInstrumentoBase();

//Prueba del funcionamiento de la clase InstrumentoViento
$instrumento1 = new InstrumentoViento("madera");
$instrumento2 = new InstrumentoViento("metal", 20);
$instrumento3 = new InstrumentoViento();

echo "<h3>Instrumentos de Viento (Ejercicio 3)</h3>";

echo $instrumento1 -> echoInstrumentoViento() . "<br><br>";
echo $instrumento2 -> echoInstrumentoViento() . "<br><br>";
echo $instrumento3 -> echoInstrumentoViento() . "<br><br>";

echo "Descripcion del instrumento1: " . $instrumento1->getCadena() . "<br>";
echo "Edad del instrumento1: " . $instrumento1->getEdad() . "<br><br>";

$instrumento1 -> setCadena("Flauta");
$instrumento1->envejecer();
echo "Nueva descripcion del instrumento1: " . $instrumento1->getCadena() . "<br>";
echo "Nueva edad del instrumento1: " . $instrumento1->getEdad() . "<br><br>";

echo "Sonido del instrumento1: " . $instrumento1->sonido() . "<br>";
echo "Afinar del instrumento1: " . $instrumento1->afinar() . "<br>";

?>
</main>
<?php
}