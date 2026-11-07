<?php

namespace VALNORMAL;    //espacio de nombre para la libreria val_normal

/**
 * Funcion que comprueba que $var contiene un entero cuyo valor está entre $min y $max
 *
 * @param integer $var se devuelve el entero saneado (si es correcto se deja como esta, si no se le asigna $defecto)
 * @param integer $min  el minimo que tiene que cumplir $var
 * @param integer $max el maximo que tiene que cumplir $var
 * @param integer $defecto el valor por defecto que tomara $var si no se cumple la condicion
 * @return boolean true si todo esta correcto, false si no
 */
function validaEntero(int &$var, int $min, int $max, int $defecto):bool {

    //Comprueba que el entero sea valido
    if(is_int($var) && $var >= $min && $var <= $max) {
        return true;

    } else {
        $var = $defecto;
        return false;
    }
}


function validaReal(float &$var, float $min, float $max, float $defecto):bool {
    return false;
}