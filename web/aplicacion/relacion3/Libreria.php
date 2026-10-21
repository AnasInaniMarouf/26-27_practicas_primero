<?php

function cuentaVeces(array &$array, string $posicion, int $num1, int &$num2):bool {
    if($posicion == "2daw" || $posicion == "primera")
        return false;

    $array[$posicion] = $num1;

    static $cont = 0;
    $cont++;

    $num2 = $cont;

    return true;
}

?>