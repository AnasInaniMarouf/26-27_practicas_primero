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
        "TEXTO" => "Ejercicio 5",
        "ENLACE" => ""
    ]
];

//---//
function crearVector() {
    $vector=array();
    $vector[1]="esto es una cadena";
    $vector["posi1"]=25.67;
    $vector[]=false;
    $vector["ultima"]=array(2,5,96);
    $vector[56]=23;

    return $vector;
}

function muestraVector(array $vector) {

    $resultado = "";

    foreach ($vector as $posicion => $valor) {

        $resultado .= "posicion " . $posicion . " contenido (tipo ";

        if (is_array($valor)) {

            $resultado .= "array):<br>";

            foreach ($valor as $valordeArray) {
                $resultado .= "&nbsp&nbsp&nbsp&nbsp&nbsp<strong>·</strong>" . $valordeArray . "<br>";
            }

        } else {

            if (is_int($valor)) {
                $resultado .= "Entero) Entero con valor " . $valor . ", en binario " . decbin($valor);

            } else if(is_float($valor)){
                $resultado .= "Real) " . $valor . ", que al cuadrado es " . pow($valor, 2);

            } else if (is_string($valor)) {
                $resultado .= "Cadena) -" . $valor . "-";

            } else if (is_bool($valor)) {
                $resultado .= "Booleano) " . ($valor? "true" : "false") . ", y su opuesto " . (!$valor? "true" : "false");
            }

            $resultado .= "<br>";
        }
    }

    return $resultado;
}
//dibuja la plantilla de la vista
inicioCabecera("Ejercicio 5");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 5", $barra);
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

    echo muestraVector(crearVector());

?>  
    </main>
<?php
}