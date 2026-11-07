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

/**
 * Funcion que comprueba que $var contiene un numero real cuyo valor está entre $min y $max
 *
 * @param float $var se devuelve el numero real saneado (si es correcto se deja como esta, si no se le asigna $defecto)
 * @param float $min  el minimo que tiene que cumplir $var
 * @param float $max el maximo que tiene que cumplir $var
 * @param float $defecto el valor por defecto que tomara $var si no se cumple la condicion
 * @return boolean true si todo esta correcto, false si no
 */
function validaReal(float &$var, float $min, float $max, float $defecto):bool {

    //Comprueba que el real sea valido
    if(is_float($var) && $var >= $min && $var <= $max) {
        return true;

    } else {
        $var = $defecto;
        return false;
    }
}

/**
 * Funcion que comprueba que $var contiene una fecha correcta en el formato dd/mm/aaaa
 *
 * @param string $var la fecha que se pasa, se devuelve la fecha saneada (si esta mal se le asigna $defecto)
 * @param string $defecto la fecha por defecto que tomara $var en caso de estar mal 
 * @return boolean
 */
function validaFecha(string &$var, string $defecto):bool {
    
    $partes = [];
    $texto = trim($var);

    //comprueba que el formato de la fecha sea valida
    if (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $texto, $partes) === 1) {
        $dia = intval($partes[1]);
        $mes = intval($partes[2]);
        $anio = intval($partes[3]);

        //Comprueba que la fecha sea valida
        if (checkdate($mes, $dia, $anio)) {
            $var = ($dia < 10? "0" . $dia : $dia)   //si el dia es menor que diez, se le pone un 0 delante
                    . "/" . ($mes < 10? "0" . $mes : $mes)  //y con el mes igual que el dia
                    . "/" . $partes[3];
            return true;
        }
    }
    $var = $defecto;
    return false;
}