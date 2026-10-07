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

//---//
function creaMatriz() {
    // $matriz[0][0] = 1;

    // $matriz[1][0] = 2;
    // $matriz[1][1] = 2; 

    // $matriz[2][0] = 3;
    // $matriz[2][1] = 3;
    // $matriz[2][2] = 3;

    // $matriz[3][0] = 4;
    // $matriz[3][1] = 4;
    // $matriz[3][2] = 4;
    // $matriz[3][3] = 4;

    // $matriz[4][0] = 5;
    // $matriz[4][1] = 5;
    // $matriz[4][2] = 5;
    // $matriz[4][3] = 5;
    // $matriz[4][4] = 5;

    $matriz = array();

    for ($i=0; $i <= 4; $i++) { 
        for ($j=0; $j <= $i; $j++) { 
            $matriz[$i][$j] = $i + 1;
        }
    }
    return $matriz;
}

function muestraMatriz(array $matriz) {
    $resultado = "";

    foreach ($matriz as $fila => $fila1) {

        foreach ($fila1 as $columna => $valor) {
            $resultado .= $valor . " ";
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