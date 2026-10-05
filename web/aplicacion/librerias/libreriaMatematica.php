<?php

function redondeoRound($numero) {
    return round($numero);
}

function redondeoFloor($numero) {
    return floor($numero);
}

function potencia($numero, $potencia) {
    return pow($numero, $potencia);
}

function raiz($numero) {
    return sqrt($numero);
}

function enteroAHex($numero) {
    return dechex($numero);
}

function base4ABase8($numero) {
    return base_convert($numero, 4, 8);
}

function logartimo($numero, $base) {
    return log($numero, $base);
}

function hipotenusa($num1, $num2) {
    return hypot($num1, $num2);
}

?>