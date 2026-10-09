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
        "TEXTO" => "Ejercicio 6",
        "ENLACE" => ""
    ]
];

function crearVector() {
    return array("primera" =>12.56, 24=>true, 67 =>23.76);
}

function muestraVector(array $vector) {

    $resultado = "";

    foreach ($vector as $indice => $valor) {
        $resultado .= "Valor del indice '" . $indice . "' del vector: " . $valor . "<br>";
    }

    return $resultado;
}

function muestraVectorConFunciones(array $vector) {

    $resultado = "";
    $indicesArray = array_keys($vector);
    $valoresArray = array_values($vector);

    for ($i=0; $i < count($vector); $i++) {
        $resultado .= "Valor del indice '" . $indicesArray[$i] . "' del vector: " . $valoresArray[$i] . "<br>";
    }

    return $resultado;
}

//dibuja la plantilla de la vista
inicioCabecera("Ejercicio 6");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 6", $barra);
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

    $vector = crearVector();

    echo muestraVector($vector);
    echo "<br>" . muestraVectorConFunciones($vector);

?>
    </main>
<?php
}