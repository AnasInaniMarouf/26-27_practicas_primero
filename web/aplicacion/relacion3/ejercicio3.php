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
        "TEXTO" => "Ejercicio 3",
        "ENLACE" => ""
    ]
];

$array = cadenaAleatoriaArray(20);
$ascii = cadenaAleatoriaAscii(20);

//dibuja la plantilla de la vista
inicioCabecera("Ejercicio 3");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 3", $barra);
cuerpo($array, $ascii); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo(string $array, string $ascii)
{
?>
    <main class="contenidoPrincipal">
<?php
    echo "Con array: " . $array . "<br>";
    echo "Con ascii: " . $ascii;
?>
    </main>
<?php
}

/**
 * Funcion que hace una cadena aleatoria de letras y numeros,
 * cogiendo caracteres al azar de un array donde estan todos
 * los que se pueden usar
 *
 * @param integer $tamaño cuantos caracteres tiene que tener
 * @return string $resultado
 */
function cadenaAleatoriaArray(int $tamaño) {
    //str_split convierte el texto en un array con un caracter en cada posicion
    $caracteres = str_split("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789");
    $resultado = "";
 
    for ($i = 0; $i < $tamaño; $i++) {
        //saco una posicion al azar entre la 0 y la ultima del array
        $resultado .= $caracteres[rand(0, count($caracteres) - 1)];
    }
 
    return $resultado;
}
 
/**
 * Funcion que hace una cadena aleatoria de letras y numeros
 * sacando codigos ascii al azar, y solo se queda con los que
 * son letras o numeros
 *
 * @param integer $tamaño cuantos caracteres tiene que tener
 * @return string $resultado
 */
function cadenaAleatoriaAscii(int $tamaño) {
    $resultado = "";
 
    //se repite hasta llegar al tamano, porque hay codigos que se tiran
    while (strlen($resultado) < $tamaño) {
        //del 48 (el '0') al 122 (la 'z') hay numeros, letras y tambien simbolos raros
        $caracter = chr(rand(48, 122));
 
        //solo lo guardo si es letra o numero, los simbolos no
        if (preg_match("/^[a-zA-Z0-9]$/", $caracter)) {
            $resultado .= $caracter;
        }
 
    }
 
    return $resultado;
}
 
