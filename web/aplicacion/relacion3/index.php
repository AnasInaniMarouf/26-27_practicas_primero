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

//dibuja la plantilla de la vista
inicioCabecera("Relacion 3");
cabecera();
finCabecera();
inicioCuerpo("Relacion 3 - Funciones", $barra);
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
    //Ejercicio 1
    $array = [];
    $num2 = 0;

    echo "Llamada a la funcion cuentaVeces():  " . (cuentaVeces($array, "segunda", 12, $num2)? "true" : "false") . "<br>" . PHP_EOL;

    cuentaVeces($array, "tercera", 6, $num2);
    cuentaVeces($array, "primera", 1, $num2);

    foreach ($array as $posicion => $valor) {
        echo "&nbsp&nbspPosicion: " . $posicion . ", valor: " . $valor . "<br>" . PHP_EOL;
    }

    echo "Funcion cuentaVeces() llamada " . $num2 . " veces" . PHP_EOL;

    echo "<br><br>" . PHP_EOL;

    //Ejercicio 2
    $cadena = generarCadena(-7);
    echo "Llamada 1 a la funcion generarCadena(): " . (!$cadena? "false" : $cadena) . "<br>" . PHP_EOL;

    $cadena = generarCadena(7);
    echo "Llamada 1 a la funcion generarCadena(): " . (!$cadena? "false" : $cadena) . "<br>" . PHP_EOL;

    $cadena = generarCadena();
    echo "Llamada 2 a la funcion generarCadena(): " . (!$cadena? "false" : $cadena) . PHP_EOL;

    echo "<br><br>" . PHP_EOL;
    
    //Ejercicio 3
    echo "Llamada 1 a la funcion operaciones(): " . operaciones(1, 2, 3, 4, 5) . "<br>" . PHP_EOL;
    echo "Llamada 2 a la funcion operaciones(): " . operaciones(2, 10, 2, 3, 4) . "<br>" . PHP_EOL;
    echo "Llamada 3 a la funcion operaciones(): " . operaciones(3, 3, 2, 4, 2) . "<br>" . PHP_EOL;
    echo "Llamada 4 a la funcion operaciones(): " . operaciones(-1, 3, 10, 4, 10, 2, 5, 1) . "<br>" . PHP_EOL;
?>
</main>
<?php
}