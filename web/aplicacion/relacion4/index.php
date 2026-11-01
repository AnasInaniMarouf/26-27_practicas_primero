<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
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

echo "<h3>Instrumentos de Viento (Ejercicio 3)</h3>" . PHP_EOL;

echo $instrumento1 -> __toString() . "<br><br>" . PHP_EOL;    //Es lo mismo poner el __toString() que no ponerlo
echo $instrumento2 . "<br><br>" . PHP_EOL;
echo $instrumento3 . "<br><br>" . PHP_EOL;

echo "Descripcion del instrumento1: " . $instrumento1->getCadena() . "<br>" . PHP_EOL;
echo "Edad del instrumento1: " . $instrumento1->getEdad() . "<br><br>" . PHP_EOL;

$instrumento1 -> setCadena("Flauta");
$instrumento1->envejecer();
echo "Nueva descripcion del instrumento1: " . $instrumento1->getCadena() . "<br>" . PHP_EOL;
echo "Nueva edad del instrumento1: " . $instrumento1->getEdad() . "<br><br>" . PHP_EOL;

echo "Sonido del instrumento1: " . $instrumento1->sonido() . "<br>" . PHP_EOL;
echo "Afinar del instrumento1: " . $instrumento1->afinar() . "<br>" . PHP_EOL;

//Prueba del funcionamiento de la clase Flauta
$flauta1 = Flauta::CrearDesdeArray([
    "material" => "metal",
    "edad" => 8
]);

$flauta2 = clone $flauta1;

echo "<h3>Flauta (Ejercicio 4)</h3>";

echo $flauta1 . "<br><br>" . PHP_EOL;
echo $flauta2;
?>
</main>
<?php
}