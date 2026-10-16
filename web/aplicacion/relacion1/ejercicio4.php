<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
$barra=[
    [
        "TEXTO"=> "Inicio",
        "ENLACE" =>"/index.php"//, "ADICIONAL"=>">>"
    ],
    [
        "TEXTO" => "Ejercicios",
        "ENLACE" => "./index.php"
    ],
    [
        "TEXTO" => "Ejercicio 4",
        "ENLACE" => ""
    ]
];

const FILAS = 5;    //Constante para el numero de filas de la matriz

/**
 * Metodo que crea una matriz, recorriendola y añadiendole
 * numeros a cada fila, con la constante FILAS
 *
 * @return array $matriz
 */
function creaMatriz() {

    $matriz = array();

    for ($i=0; $i < FILAS; $i++) { 
        for ($j=0; $j <= $i; $j++) { 
            $matriz[$i][$j] = $i + 1;
        }
    }
    return $matriz;
}

/**
 * Metodo que dado una matriz, la recorre y
 * va guardando en una variable de tipo cadena
 * su contenido
 *
 * @param array $matriz
 * @return string $resultado
 */
function muestraMatriz(array $matriz) {

    $resultado = "";

    foreach ($matriz as $fila) {

        foreach ($fila as $elemento) {
            $resultado .= $elemento . " ";
        }

        $resultado .= "<br>";
    }

    return $resultado;
}

//dibuja la plantilla de la vista
inicioCabecera("Ejercicio 4");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 4", $barra);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
?>
    <main class="contenidoPrincipal">
<?php
    echo muestraMatriz(creaMatriz());
?>
    </main>
<?php
}