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
        "TEXTO" => "Ejercicio 3",
        "ENLACE" => ""
    ]
];

/**
 * Metodo que crea un array en varias
 * sentencias, y lo devuelve
 *
 * @return array $array
 */
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

/**
 * Metodo que crea un array en una
 * sola sentencia, y lo devuelve
 *
 * @return array $array
 */
function arrayUnaSentencia() {
    $array = array(1 => 23, 16 => "saludos", 54 => true, 34,
                    "uno" => "cadena", "dos" => true, "tres" => 1.345,
                    "ultima" => array(1.34, "nueva")
    );

    return $array;
}

/**
 * Metodo que crea y devuelve un array en una sola
 * sentencia y con corchetes
 *
 * @return array $array
 */
function arrayUnaSentenciaCorchetes() {
    $array = [1 => 23, 16 => "saludos", 54 => true, 34,
                "uno" => "cadena", "dos" => true, "tres" => 1.345,
                "ultima" => [1.34, "nueva"]
    ];

    return $array;
}

/**
 * Metodo que recorre un array y va guardando sus elementos
 * en una variable de tipo cadena, para despues devolverla
 *
 * @param array $array
 * @return string $resultado
 */
function muestraArray(array $array) {

    $resultado = "";

    foreach ($array as $indice => $valor) {
        if(is_array($valor)) {
            $resultado = $resultado . "Array de la posicion " . $indice . ": <br>" . muestraArray($valor);

        } else {
            $resultado = $resultado . "Elemento de la posicion " . $indice . " del array: " . $valor . "<br>";
        }
    }

    return $resultado;
}

//dibuja la plantilla de la vista
inicioCabecera("Ejercicio 3");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 3", $barra);
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
    echo "<strong>Array de varias sentencias</strong><br>" . muestraArray(arrayVariasSentencias()) . "<br>";
    echo "<strong>Array de una sola sentencia</strong><br>" . muestraArray(arrayUnaSentencia()) . "<br>";
    echo "<strong>Array de una sola sentencia con corchetes</strong><br>" . muestraArray(arrayUnaSentenciaCorchetes()) . "<br>";
?>
    </main>
<?php
}