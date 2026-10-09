<?php
/**
 * Metodo que dado un numero lo redondea al alza,
 * solo si los decimales son mayor a 50
 * 
 * ej: 4.4 -> 4
 *     4.5 -> 5
 *
 * @param integer $numero
 */
function redondeoRound(float $numero) {
    return round($numero);
}

/**
 * Metodo que dado un numero lo redondea,
 * siempre a la baja
 * 
 * ej: 4.4 -> 4
 *     4.5 -> 4
 *
 * @param integer $numero
 */
function redondeoFloor(float $numero) {
    return floor($numero);
}

/**
 * Metodo que dado un numero y su potencia,
 * eleva el numero a la potencia dada
 * 
 * ej: 2^3 -> 8
 *
 * @param float $numero
 * @param integer $potencia
 */
function potencia(float $numero, int $potencia) {
    return pow($numero, $potencia);
}

/**
 * Metodo que dado un numero, hace su
 * raiz cuadrada
 * 
 * ej: raiz de 25 -> 5
 *
 * @param integer $numero
 */
function raiz(int $numero) {
    return sqrt($numero);
}

/**
 * Metodo que dado un numero, lo pasa a hexadecimal
 * 
 * ej: 14 -> E
 *
 * @param integer $numero
 */
function enteroAHex(int $numero) {
    return dechex($numero);
}

/**
 * Metodo que dado un numero, lo convierte
 * de base cuatro a base ocho
 * 
 * ej: 22 -> 12
 *
 * @param integer $numero
 */
function base4ABase8(int $numero) {
    return base_convert($numero, 4, 8);
}

/**
 * Metodo que dado un numero y una base,
 * aplica el logaritmo de ese numero, segun
 * su base
 * 
 * ej: log10 100 -> 10
 *
 * @param integer $numero
 * @param integer $base
 */
function logartimo(int $numero, int $base) {
    return log($numero, $base);
}

/**
 * Metodo que dado dos numeros,
 * calcula la hipotenusa de ambos
 * 
 * ej: hipotenusa de 3 y 4 -> 5
 *
 * @param float $num1
 * @param float $num2
 */
function hipotenusa(float $num1, float $num2) {
    return hypot($num1, $num2);
}

?>