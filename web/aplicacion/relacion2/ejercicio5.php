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
        "TEXTO" => "Ejercicio 5",
        "ENLACE" => ""
    ]
];

$texto = <<<fin
<h1><p><br>
Hoy es dia 18 de noviembre del 2026
Mi correo personal es inanimarouf@gmail.com, y el corporativo ainamar635@g.educaand.es
fin;

$etiqueta = buscar("/<\/?[a-z][a-z0-9]*>/i", $texto);
$numero = buscar("/\b\d+\b/", $texto);
$email = buscar("/\w+@\w+(\.\w+)+/i", $texto);

//dibuja la plantilla de la vista
inicioCabecera("Ejercicio 5");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 5", $barra);
cuerpo($texto, $etiqueta, $numero, $email); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo(string $texto, string $etiqueta, string $numero, string $email)
{
?>
    <main class="contenidoPrincipal">
<?php
    echo "Texto :" . str_replace("<", "&lt;", $texto) . "<br><br>" . PHP_EOL;
 
    echo "Etiquetas:<br>" . $etiqueta . "<br>" . PHP_EOL;
    echo "Numeros:<br>" . $numero . "<br>" . PHP_EOL;
    echo "Correos electronicos:<br>" . $email . PHP_EOL;
?>
    </main>
<?php
}

/**
 * Funcion que busca en un texto todo lo que coincida con una
 * expresion regular y devuelve el patron y cada cosa que ha
 * encontrado, una por linea
 *
 * @param string $patron la expresion regular que se busca
 * @param string $texto el texto donde se busca
 * @return string $resultado
 */
function buscar(string $patron, string $texto) {
    //cambio el "<" del patron tambien, para que se vea en pantalla
    $resultado = "Patrón: " . str_replace("<", "&lt;", $patron) . "<br>";
 
    //preg_match_all mete todo lo que encuentra en $coincidencias, y en la posicion [0] estan las coincidencias completas
    preg_match_all($patron, $texto, $coincidencias);
 
    foreach ($coincidencias[0] as $coincidencia) {
        $resultado .= str_replace("<", "&lt;", $coincidencia) . "<br>";
    }
 
    return $resultado;
}