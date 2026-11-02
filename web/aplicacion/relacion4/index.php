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

echo "Descripcion del instrumento1: " . $instrumento1->getDescripcion() . "<br>" . PHP_EOL;
echo "Edad del instrumento1: " . $instrumento1->getEdad() . "<br><br>" . PHP_EOL;

$instrumento1 -> setDescripcion("Flauta");
$instrumento1->envejecer();
echo "Nueva descripcion del instrumento1: " . $instrumento1->getDescripcion() . "<br>" . PHP_EOL;
echo "Nueva edad del instrumento1: " . $instrumento1->getEdad() . "<br><br>" . PHP_EOL;

echo "Sonido del instrumento1: " . $instrumento1->sonido() . "<br>" . PHP_EOL;
echo "Afinar del instrumento1: " . $instrumento1->afinar() . "<br>" . PHP_EOL;

//Prueba del funcionamiento de la clase Flauta
$flauta1 = Flauta::CrearDesdeArray([
    "material" => "metal",
    "edad" => 8
]);

$flauta2 = clone $flauta1;

echo "<h3>Flauta (Ejercicio 4)</h3>" . PHP_EOL;

echo $flauta1 . "<br><br>" . PHP_EOL;
echo $flauta2 . PHP_EOL;

//Prueba del funcionamiento de la clase Persona
$estadoAleatorio = EstadoCivil::cases()[array_rand(EstadoCivil::cases())];  //el metodo array_rand devuelve un indice aleatorio del array que esta dentro

$persona = Persona::registrarPersona("Juan", "15/05/1995", "Calle Carrera 10", "Antequera", $estadoAleatorio);
//$persona1 = new Persona();    //da error porque el constructor es privado

echo "<h3>Persona (Ejercicio 5)</h3>" . PHP_EOL;
echo $persona . PHP_EOL;

//Prueba del funcionamiento de la clase SerieFibonacci
echo "<h3>SerieFibonacci (Ejercicio 6)</h3>" . PHP_EOL;

$num = 10;


//Usando la clase SerieFibonacci
echo "Fibonacci de $num (con clase SerieFibonacci): ";

foreach(new SerieFibonacci($num) as $valor) {
    echo "$valor &nbsp;";
}

//Usando el metodo estatico fFibonacci()
echo "<br>Fibonacci de $num (con metodo fFibonacci()): ";

foreach (SerieFibonacci::fFibonacci($num) as $valor) {
    echo "$valor &nbsp;";
}

//Prueba del funcionamiento de la clase ClaseMisPropiedades
echo "<h3>ClaseMisPropiedades (Ejercicio 7)</h3>" . PHP_EOL;

$Objeto= new ClaseMisPropiedades();
$Objeto->propPublica="publica";
//$Objeto->_propPrivada="privada"; //no es valida al ser privada
$Objeto->propiedad1=25;
$Objeto->propiedad2="cadena de texto";
echo "la propiedad 1 vale ".$Objeto->propiedad1."<br>";
//echo $Objeto->propiedad3; // esto debería dar un error al no haber asignado previamente la propiedad

foreach ($Objeto as $clave => $valor) {
    echo $clave . " = " . $valor . "<br>";
}

?>
</main>
<?php
}