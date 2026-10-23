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
    echo "Llamada 4 a la funcion operaciones(): " . operaciones(-1, 3, 10, 4, 10, 2, 5, 1) . PHP_EOL;

    echo "<br><br>" . PHP_EOL;

    //Ejercicio 4
    $valor = 3;

    echo "Llamada 1 a la funcion devuelve(): " . devuelve($valor, 2, 3) . ", y el nuevo valor de \$valor es: $valor" . "<br>" . PHP_EOL;
    echo "Llamada 2 a la funcion devuelve(): " . devuelve($valor) . ", y el nuevo valor de \$valor es: $valor" . "<br>" . PHP_EOL;
    echo "Llamada 3 a la funcion devuelve(): " . devuelve($valor, 5) . ", y el nuevo valor de \$valor es: $valor" . "<br>" . PHP_EOL;
    echo "Llamada 4 a la funcion devuelve(): " . devuelve($valor, num3: 10) . ", y el nuevo valor de \$valor es: $valor" . PHP_EOL;

    echo "<br><br>" . PHP_EOL;

    //Ejercicio 5
    echo "Llamada 1 a la funcion hacerOperacion(): " . hacerOperacion("suma", 10, 12) . "<br>" . PHP_EOL;
    echo "Llamada 2 a la funcion hacerOperacion(): " . hacerOperacion("resta", 15, 4) . "<br>" . PHP_EOL;
    echo "Llamada 3 a la funcion hacerOperacion(): " . hacerOperacion("multiplicacion", 5, 5) . "<br>" . PHP_EOL;

    $operacion = hacerOperacion("division", 7, 16);
    echo "Llamada 4 a la funcion hacerOperacion(): " . ($operacion? $operacion : "false") . PHP_EOL;

    echo "<br><br>" . PHP_EOL;

    //Ejercicio 6
    $fnSuma = llamaAFuncion(4, 5, fn($a, $b) => $a + $b);
    echo "Llamada 1 a la funcion llamaAFuncion(): " . $fnSuma . "<br>" . PHP_EOL;

    $fnResta = llamaAFuncion(22, 12, fn($a, $b) => $a - $b);
    echo "Llamada 2 a la funcion llamaAFuncion(): " . $fnResta . "<br>" . PHP_EOL;

    $fnMultiplicacion = llamaAFuncion(6, 7, fn($a, $b) => $a * $b);
    echo "Llamada 3 a la funcion llamaAFuncion(): " . $fnMultiplicacion . PHP_EOL;

    echo "<br><br>" . PHP_EOL;

    //Ejercicio 7
    $vector=array("uno","grande","caminos","a");
    echo "Array sin ordenar: " . muestraArray($vector) . "<br>" . PHP_EOL;
    
    ordenar($vector);
    echo "Array ordenado: " . muestraArray($vector) . PHP_EOL;
?>
</main>
<?php
}