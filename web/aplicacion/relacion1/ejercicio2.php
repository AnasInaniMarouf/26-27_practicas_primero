<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
function lanzamientoDado6() {
    
    $array = [];

    for($i = 0; $i < 6; $i++) {
        $array[$i] = mt_rand(1, 6);
    }

    return $array;
}

function mostrarArray6($array) {

    $valoresArray = "";

    for($i = 0; $i < count($array); $i++) {
        $valoresArray = $valoresArray . "Lanzamiento " . $i + 1 . " del dado: " . $array[$i] . "<br>";
    }

    return $valoresArray;
}

function mostrarArray($array) {

    $numElementosArray = count($array); //variable para 

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

function lanzamientoDado($numLanzamientos) {

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
inicioCuerpo("Ejercicio 2 - Lanzamiento de Dados");
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
?>
    <ul class="barraUbicacion">
        <li><a href="/index.php">Inicio</a></li>
        <li><a href="/aplicacion/relacion1/index.php">Ejercicios</a></li>
        <li><a href="#">Ejercicio 2</a></li>
    </ul>

    <main class="contenidoPrincipal">
<?php
    echo mostrarArray6(lanzamientoDado6());

    echo "<br><br>" . mostrarArray(lanzamientoDado(1000));
?>
    </main>
<?php
}