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
        "TEXTO" => "Ejercicio 2",
        "ENLACE" => ""
    ]
];

/**
 * Metodo que recorre un bucle y rellena un array
 * con un numero aleatorio entre el 1 y el 6
 *
 * @return array $array
 */
function lanzamientoDado6() {
    
    $array = [];

    for($i = 0; $i < 6; $i++) {
        $array[$i] = mt_rand(1, 6);
    }

    return $array;
}

/**
 * Metodo que devuelve una cadena mostrando
 * los elementos del array anterior
 *
 * @param array $array
 * @return string $valoresArray
 */
function mostrarArray6(array $array) {

    $valoresArray = "";

    for($i = 0; $i < count($array); $i++) {
        $valoresArray = $valoresArray . "Lanzamiento " . $i + 1 . " del dado: " . $array[$i] . "<br>";
    }

    return $valoresArray;
}

/**
 * Metodo que muestra los elementos del array
 * de lanzamientos de 1000 
 *
 * @param array $array
 * @return string $valoresArray
 */
function mostrarArray(array $array) {

    $numElementosArray = count($array); //variable para saber el numero de elementos que contiene el array

    $valoresArray = "Lanzado el dado " . $numElementosArray . " veces<br>";

    $arrayDadosLanzados = [];

    //Bucle para meter en el array las veces que ha salido un determinado numero
    for ($i=0, $contador = 0; $i < 6; $i++) { 

        for ($j=0; $j < $numElementosArray; $j++) { 

            if ($array[$j] == $i + 1) {
                $contador++;
            }
        }

        $arrayDadosLanzados[$i] = $contador;
        $contador = 0;
    }

    //Buvle para guardar en una variable todos los numeros que han salido
    for($i = 0; $i < 6; $i++) {
        $valoresArray = $valoresArray . " El " . $i + 1 . " ha salido " . $arrayDadosLanzados[$i] . " veces, con un porcentaje de " . fdiv($arrayDadosLanzados[$i], $numElementosArray) * 100 . "%<br>";
    }

    return $valoresArray;
}

/**
 * Metodo que crea un array y con un bucle while,
 * va metiendo un numero aleatorio entre el 1 y el 6,
 * dependiendo del numero de elementos que se le pase
 *
 * @param integer $numLanzamientos
 * @return array $array
 */
function lanzamientoDado(int $numLanzamientos) {

    $array = [];

    $i = 0;
    while($i < $numLanzamientos) {

        $array[$i] = mt_rand() % 6 + 1;

        $i++;
    }

    return $array;
}

//dibuja la plantilla de la vista
inicioCabecera("Ejercicio 2");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 2 - Lanzamiento de Dados", $barra);
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
    echo mostrarArray6(lanzamientoDado6());

    echo "<br><br>" . mostrarArray(lanzamientoDado(1000));
?>
    </main>
<?php
}