<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
function arrayVariasSentencias() {
    //Crear y rellenar el array en varias sentencias
    $array[1] = 23;
    $array[16] = "saludos";
    $array[54] = true;
    
    $array[] = 34;  //añadir el valor al final (que es el 55)

    $array["uno"] = "cadena";
    $array["dos"] = true;
    $array["tres"] = 1.345;
    $array["ultima"] = [1.34, "nueva"];

    return $array;
}

function arrayUnaSentencia() {
    $array = array(1 => 23, 16 => "saludos", 54 => true, 34,
                    "uno" => "cadena", "dos" => true, "tres" => 1.345,
                    "ultima" => array(1.34, "nueva")
    );

    return $array;
}

function arrayUnaSentenciaCorchetes() {
    $array = [1 => 23, 16 => "saludos", 54 => true, 34,
                "uno" => "cadena", "dos" => true, "tres" => 1.345,
                "ultima" => [1.34, "nueva"]
    ];

    return $array;
}

function muestraArray(array $array) {

    $arrayToString = "";

    foreach ($array as $indice => $valor) {
        if(is_array($valor)) {
            $arrayToString = $arrayToString . "Array de la posicion " . $indice . ": <br>" . muestraArray($valor);

        } else {
            $arrayToString = $arrayToString . "Elemento de la posicion " . $indice . " del array: " . $valor . "<br>";
        }
    }

    return $arrayToString;
}

//dibuja la plantilla de la vista
inicioCabecera("Ejercicio 3");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 3");
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
        <li><a href="#">Ejercicio 3</a></li>
    </ul>

    <main class="contenidoPrincipal">
<?php
    echo muestraArray(arrayVariasSentencias()) . "<br>";
    echo muestraArray(arrayUnaSentencia()) . "<br>";
    echo muestraArray(arrayUnaSentenciaCorchetes()) . "<br>";
?>
    </main>
<?php
}