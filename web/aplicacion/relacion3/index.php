<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/Libreria.php");
//controlador
$barra=[
    [
        "TEXTO"=> "Inicio",
        "ENLACE" =>"/index.php"//, "ADICIONAL"=>">>"
    ],
    [
        "TEXTO" => "Relacion 3",
        "ENLACE" => ""
    ]
];

$array = [];
$posicion = "segunda";
$num1 = 3;
$num2 = 2;

cuentaVeces($array, $posicion, $num1, $num2);
cuentaVeces($array, $posicion, $num1, $num2);
cuentaVeces($array, $posicion, $num1, $num2);
cuentaVeces($array, $posicion, $num1, $num2);
cuentaVeces($array, $posicion, $num1, $num2);

//dibuja la plantilla de la vista
inicioCabecera("Relacion 3");
cabecera();
finCabecera();
inicioCuerpo("Relacion 3 - Funciones", $barra);
cuerpo($array, $posicion, $num1, $num2); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera()
{}
//vista
function cuerpo(array $array, string $posicion, int $num1, int $num2)
{
?>
<main class="contenidoPrincipal">
<?php
    echo "Funcion cuentaVeces() llamada  " . $num2 . " veces: " . PHP_EOL;
?>
</main>
<?php
}
?>