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
        "TEXTO" => "Ejercicio 4",
        "ENLACE" => ""
    ]
];

$valor1 = 17.5;
$valor2 = 379987.24;
 
$var1 = formatearNumero($valor1, 1, "0", 15);
$var2 = formatearNumero($valor2, 2, " ", 15);

//dibuja la plantilla de la vista
inicioCabecera("Ejercicio 4");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 4", $barra);
cuerpo($var1, $var2); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo(string $var1, string $var2)
{
?>
    <main class="contenidoPrincipal">
<?php
    echo "el primer valor -" . $var1 . "-, el segundo valor -" . $var2 . "-" . PHP_EOL;
?>
    </main>
<?php
}

/**
 * Funcion que le da formato a un numero (punto para los miles y
 * coma para los decimales) y le pone relleno por la izquierda
 * hasta que tenga el tamano que se pide
 *
 * @param float $numero el numero que se formatea
 * @param integer $decimales cuantos decimales se muestran
 * @param string $ceros con que se rellena ("0" o " ", por ejemplo)
 * @param integer $tamaño cuantos caracteres tiene que tener al final
 * @return string
 */
function formatearNumero(float $numero, int $decimales, string $ceros, int $tamaño) {
    //number_format redondea los decimales y pone los puntos y las comas
    $texto = number_format($numero, $decimales, ",", ".");
 
    //str_repeat repite el relleno las veces que falten para llegar al tamano
    return str_repeat($ceros, $tamaño - strlen($texto)) . $texto;
}
 
