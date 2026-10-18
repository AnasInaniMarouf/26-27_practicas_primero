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
        "TEXTO" => "Ejercicio 2",
        "ENLACE" => ""
    ]
];

$texto = "Está la niña en casa";

$cadena1 = muestraCadena($texto);
$cadena2 = muestraCadenaInversa($texto);
$cadena3 = separaPorA($texto);
$cadena4 = cambiaDespuesDeNinia($texto);

//dibuja la plantilla de la vista
inicioCabecera("Ejercicio 2");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 2", $barra);
cuerpo($cadena1, $cadena2, $cadena3, $cadena4); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo(string $cadena1, string $cadena2, string $cadena3, string $cadena4)
{
?>
    <main class="contenidoPrincipal">
<?php
    echo $cadena1;
    echo $cadena2;
    echo $cadena3;
    echo $cadena4;
?>
    </main>
<?php
}

/**
 * Funcion que va letra por letra y pone cada una en una linea,
 * moviendola un espacio mas a la derecha que la anterior
 * (queda como una escalera)
 *
 * @param string $cadena
 * @return string $resultado
 */
function muestraCadena(string $cadena) {
    $resultado = "";
 
    //No funciona, salen los caracteres especiales con un simbolo negro con una interrogacion
    // for($i = 0; $i < strlen($cadena); $i++) {
 
    //     for($j = 0; $j < $i; $j++) {
    //         $resultado .= "&nbsp";
    //     }
 
    //     $resultado .= $cadena[$i] . "<br>" . PHP_EOL; 
    // }
 
    //No funciona tampoco, salen tambien los caracteres especiales con el simbolo ese negro
    // for($i = 0; $i < strlen($cadena); $i++) {
 
    //     for($j = 0; $j < $i; $j++) {
    //         $resultado .= "&nbsp";
    //     }
 
    //     $resultado .= mb_substr($cadena, $i, 1) . "<br>" . PHP_EOL; 
    // }
 
    for ($i = 0; $i < strlen($cadena); $i++) {
 
        //este bucle mete tantos espacios como el numero de la letra
        for($j = 0; $j < $i; $j++) {
            $resultado .= "&nbsp";
         }
 
        //mb_substr coge una letra de la posicion $i (vale tambien para las letras con tilde y la enie)
        $resultado .= mb_substr($cadena, $i, 1) . "<br>" . PHP_EOL;
    }
 
 
    return $resultado;
}
 
/**
 * Funcion que lee la frase de atras para adelante y saca
 * cada letra en mayuscula, en una linea, con un espacio mas
 * a la derecha cada vez
 *
 * @param string $cadena
 * @return string $resultado
 */
function muestraCadenaInversa(string $cadena) {
    $resultado = "";
 
    for ($i = 0; $i < strlen($cadena); $i++) {
        //con numeros negativos se empieza por el final (-1 es la ultima letra)
        $caracter = mb_substr($cadena, -($i + 1), 1);
 
        //mira si la posicion es par o impar
        if ($i % 2 == 0) {
            $caracter = strtoupper($caracter);
        } else {
            $caracter = strtoupper($caracter);
        }
        //El metodo str_repeat es lo mismo que el bucle de la funcion anterior, solo que mas corto y mejor
        $resultado .= str_repeat("&nbsp;", $i) . $caracter . "<br>" . PHP_EOL;
    }
 
    return $resultado;
}
 
/**
 * Funcion que corta la frase cada vez que sale una "a"
 * (con explode) y pone cada trozo en una linea
 *
 * @param string $cadena
 * @return string $resultado
 */
function separaPorA(string $cadena) {
    $resultado = "";
    //explode me da un array con los trozos que quedan entre las "a"
    $partesCadena = explode("a", $cadena);
 
    foreach ($partesCadena as $parte) {
        $resultado .= $parte     . "<br>" . PHP_EOL;
    }
 
    return $resultado;
}
 
 
/**
 * Funcion que busca la palabra "ninia" y lo que hay detras
 * lo cambia por "/mujer ", lo demas se queda igual
 *
 * @param string $cadena
 * @return string $resultado
 */
function cambiaDespuesDeNinia(string $cadena) {
    $resultado = "";
    $palabra = "niña";
 
    //El metodo mb_strpos encuentra la palabra de la cadena, y devuelve la posicion en la que esta
    //copio hasta donde acaba "ninia", pongo "/mujer " y sigo con lo que quedaba (el +1 es para saltarme el espacio)
    $resultado = mb_substr($cadena, 0, mb_strpos($cadena, $palabra) + mb_strlen($palabra)) .
                "/mujer " . mb_substr($cadena, mb_strpos($cadena, $palabra) + mb_strlen($palabra) + 1) . "<br>" . PHP_EOL;
 
    return $resultado;
}
 
