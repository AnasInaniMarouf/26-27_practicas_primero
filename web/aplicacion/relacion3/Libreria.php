<?php

/**
 * Funcion que mete un valor en un array con la clave que le digamos,
 * pero si la clave es "2daw" o "primera" devuelve false.
 * Ademas cuenta cuantas veces la hemos llamado bien
 * y eso se lo guarda en $num2 (por referencia)
 *
 * @param array $array el array donde se guarda por referencia
 * @param string $posicion la clave donde se mete el numero
 * @param integer $num1 el numero que se guarda
 * @param integer $num2 se devuelve el contador
 * @return boolean
 */

function cuentaVeces(array &$array, string $posicion, int $num1, int &$num2):bool {
    if($posicion == "2daw" || $posicion == "primera")
        return false;

    $array[$posicion] = $num1;

    static $cont = 0;
    $cont++;

    $num2 = $cont;

    return true;
}


/**
 * Funcion que te hace una cadena aleatoria con letras
 * y numeros, de una longuitud determinada, por defecto es 10.
 * Si pides una longitud de 0 o menos, te devuelve false
 *
 * @param integer $longuitud numero de caracteres
 * @return string|boolean
 */

function generarCadena(int $longuitud = 10):string|bool {
    if($longuitud <= 0) return false;
    
    $caracteresValidos = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    $cadena = "";

    for($i = 0; $i < $longuitud; $i++) {
        $cadena .= $caracteresValidos[rand(0, mb_strlen($caracteresValidos) - 1)];
    }

    return $cadena;
}


/**
 * Funcion que hace una operacion con minimo tres numeros y los que
 * se quieran de mas. Segun el tipo de operacion:
 * 1 suma todo, 2 resta todo, 3 multiplica todo y
 * cualquier otro suma los numeros de posicion par
 * y les resta los de posicion impar
 *
 * @param integer $tipoOperacion operacion que se realiza
 * @param integer $num1
 * @param integer $num2
 * @param integer $num3
 * @param integer ...$resto numeros adicionales
 * @return integer
 */

function operaciones(int $tipoOperacion, int $num1, int $num2, int $num3, int ...$resto):int {

    $resultado = 0;

    switch ($tipoOperacion) {
        case 1:
            $resultado = $num1 + $num2 + $num3;
            foreach($resto as $num) {
                $resultado += $num;
            }
            break;

        case 2:
            $resultado = $num1 - $num2 - $num3;
            foreach($resto as $num) {
                $resultado -= $num;
            }
            break;

        case 3:
            $resultado = $num1 * $num2 * $num3;
            foreach($resto as $num) {
                $resultado *= $num;
            }
            break;

        default:
            //pares
            $sumPares = $num2;
            for($i = 0; $i < count($resto); $i += 2) {
                $sumPares += $resto[$i];
            }

            //impares
            $sumImpares = $num1 + $num3;
            for($i = 1; $i < count($resto); $i += 2) {
                $sumImpares += $resto[$i];
            }

            $resultado = $sumPares - $sumImpares;
    }

    return $resultado;
}

/**
 * Funcion que suma a $num1 los otros dos numeros (como va por
 * referencia, el valor de la variable tambien cambia) y devuelve
 * la multiplicacion de los tres. Por defecto $num2 vale 6 y $num3 vale 7
 *
 * @param integer $num1 se pasa por referencia, se modifica
 * @param integer $num2 por defecto 6
 * @param integer $num3 por defecto 7
 * @return integer
 */

function devuelve(int &$num1, int $num2 = 6, int $num3 = 7):int {
    $num1 += $num2 + $num3;
    return $num1 * $num2 * $num3;
}

/**
 * Funcion que suma dos numeros
 *
 * @param integer $num1
 * @param integer $num2
 * @return integer
 */
function suma(int $num1, int $num2):int {
    return $num1 + $num2;
}

/**
 * Funcion que resta dos numeros
 *
 * @param integer $num1
 * @param integer $num2
 * @return integer
 */
function resta(int $num1, int $num2):int {
    return $num1 - $num2;
}

/**
 * Funcion que multiplica dos numeros
 *
 * @param integer $num1
 * @param integer $num2
 * @return integer
 */
function multiplicacion(int $num1, int $num2):int {
    return $num1 * $num2;
}

/**
 * Funcion que recibe el nombre de una operacion ("suma", "resta"
 * o "multiplicacion") y dos numeros, y llama a la funcion con ese nombre.
 * Si el nombre no es valido devuelve false
 *
 * @param string $tipoOperacion nombre de la operacion
 * @param integer $num1
 * @param integer $num2
 * @return integer|boolean
 */
function hacerOperacion(string $tipoOperacion, int $num1, int $num2):int|bool {
    $esValido = false;

    match(strtolower($tipoOperacion)) {
        "suma", "resta", "multiplicacion" => $esValido = true,
        default => $esValido = false
    };

    return ($esValido? ($tipoOperacion($num1, $num2)) : $esValido);
}

/**
 * Funcion que recibe dos numeros y otra funcion,
 * y ejecuta esa funcion con los dos numeros
 *
 * @param integer $num1
 * @param integer $num2
 * @param callable $fn funcion que se ejecuta
 * @return integer
 */
function llamaAFuncion(int $num1, int $num2, callable$fn):int {

    return $fn($num1, $num2);
}

/**
 * Funcion que ordena un array de cadenas de mas larga a mas corta.
 * Al ir por referencia modifica el array original
 *
 * @param array $array se pasa por referencia
 * @return void
 */
function ordenar(array &$array):void {
    usort($array, fn($a, $b) => 
        strlen($b) - strlen($a) //a-b es orden ascendente, b-a orden descendente
    );
}

//Esto no es un ejercicio de la relacion, lo hago aqui simplemente para no tener que hacerla en la vista
function muestraArray(array $array):string {
    $resultado = "(";

    foreach($array as $cadena) {
        $resultado .= $cadena . ", ";
    }

    $resultado = substr($resultado, 0, -2); //para quitarle la coma y el espacio del final

    $resultado .= ")";

    return $resultado;
}

?>