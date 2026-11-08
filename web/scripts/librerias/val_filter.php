<?php

namespace VALFILTER;    //espacio de nombre para la libreria val_filter

/**
 * Funcion que comprueba (con FILTER) que $var contiene un entero cuyo valor está entre $min y $max
 *
 * @param integer $var se devuelve el entero saneado (si es correcto se deja como esta, si no se le asigna $defecto)
 * @param integer $min  el minimo que tiene que cumplir $var
 * @param integer $max el maximo que tiene que cumplir $var
 * @param integer $defecto el valor por defecto que tomara $var si no se cumple la condicion
 * @return boolean true si todo esta correcto, false si no
 */
function validaEntero(int &$var, int $min, int $max, int $defecto):bool {

    $opciones = ["options" => ["min_range" => $min, "max_range" => $max]];
    $resultado = filter_var($var, FILTER_VALIDATE_INT, $opciones);

    //filter_var devuelve false si no es valido (el 0 es un entero valido, por eso se compara con !==)
    if ($resultado !== false) {
        $var = $resultado;
        return true;
    }

    $var = $defecto;
    return false;
}

/**
 * Funcion que comprueba (con FILTER) que $var contiene un real cuyo valor está entre $min y $max
 *
 * @param float $var se devuelve el real saneado (si es correcto se deja como esta, si no se le asigna $defecto)
 * @param float $min  el minimo que tiene que cumplir $var
 * @param float $max el maximo que tiene que cumplir $var
 * @param float $defecto el valor por defecto que tomara $var si no se cumple la condicion
 * @return boolean true si todo esta correcto, false si no
 */
function validaReal(float &$var, float $min, float $max, float $defecto):bool {

    $resultado = filter_var($var, FILTER_VALIDATE_FLOAT);

    if ($resultado !== false && $resultado >= $min && $resultado <= $max) {
        $var = $resultado;
        return true;
    }

    $var = $defecto;
    return false;
}

/**
 * Funcion que comprueba que $var contiene una fecha correcta en el formato dd/mm/aaaa
 * (FILTER no tiene validacion para fechas, se copia la version de val_normal)
 *
 * @param string $var la fecha que se pasa, se devuelve la fecha saneada (si esta mal se le asigna $defecto)
 * @param string $defecto la fecha por defecto que tomara $var en caso de estar mal
 * @return boolean
 */
function validaFecha(string &$var, string $defecto):bool {

    $partes = [];

    //comprueba que el formato de la fecha sea valida
    if (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $var, $partes)) {

        $dia = intval($partes[1]);
        $mes = intval($partes[2]);
        $año = intval($partes[3]);

        //Comprueba que la fecha sea valida
        if (checkdate($mes, $dia, $año)) {
            $var = ($dia < 10? "0" . $dia : $dia)
                    . "/" . ($mes < 10? "0" . $mes : $mes)
                    . "/" . $año;
            return true;
        }
    }

    $var = $defecto;
    return false;
}

/**
 * Funcion que comprueba que $var contiene una hora correcta en el formato hh:mm:ss
 * (FILTER no tiene validacion para horas, se copia la version de val_normal)
 *
 * @param string $var la hora que se pasa, se devuelve la hora saneada (si esta mal se le asigna $defecto)
 * @param string $defecto la hora por defecto que tomara $var en caso de estar mal
 * @return boolean
 */
function validaHora(string &$var, string $defecto):bool {
    $partes = [];

    //comprueba que el formato de la hora sea valida
    if (preg_match('/^(\d{1,2}):(\d{1,2}):(\d{1,2})$/', $var, $partes)) {

        $horas = intval($partes[1]);
        $minutos = intval($partes[2]);
        $segundos = intval($partes[3]);

        //Comprueba que la hora sea valida
        if ($horas < 24 && $minutos < 60 && $segundos < 60) {
            $var = ($horas < 10? "0" . $horas : $horas)
                    . ":" . ($minutos < 10? "0" . $minutos : $minutos)
                    . ":" . ($segundos < 10? "0" . $segundos : $segundos);
            return true;
        }
    }

    $var = $defecto;
    return false;
}

/**
 * Funcion que comprueba (con FILTER) que $var contiene un email correcto
 *
 * @param string $var el email que se pasa, se devuelve el email saneado (se eliminan los caracteres
 *                    no permitidos en un email; si esta mal se le asigna $defecto)
 * @param string $defecto el email por defecto que tomara $var en caso de estar mal
 * @return boolean true si todo esta correcto, false si no
 */
function validaEmail(string &$var, string $defecto):bool {

    //saneo: se eliminan los caracteres que no pueden aparecer en un email
    $saneado = filter_var(trim($var), FILTER_SANITIZE_EMAIL);

    //se valida el email ya saneado
    if (filter_var($saneado, FILTER_VALIDATE_EMAIL) !== false) {
        $var = $saneado;
        return true;
    }

    $var = $defecto;
    return false;
}

/**
 * Funcion que comprueba que $var contiene una cadena de longitud maxima $longitud
 * (FILTER no tiene validacion de longitud, se copia la version de val_normal)
 *
 * @param string $var la cadena que se pasa (si no cumple la condicion se le asigna $defecto)
 * @param integer $longitud la longitud maxima (en caracteres) que puede tener $var
 * @param string $defecto el valor por defecto que tomara $var en caso de estar mal
 * @return boolean true si todo esta correcto, false si no
 */
function validaCadena(string &$var, int $longitud, string $defecto):bool {

    if (mb_strlen($var) <= $longitud) {
        return true;
    }

    $var = $defecto;
    return false;
}

/**
 * Funcion que comprueba (con FILTER_VALIDATE_REGEXP) que $var cumple con la expresion regular $expresion
 *
 * @param string $var la cadena que se comprueba (si no cumple la condicion se le asigna $defecto)
 * @param string $expresion la expresion regular (con sus delimitadores) que tiene que cumplir $var
 * @param string $defecto el valor por defecto que tomara $var en caso de estar mal
 * @return boolean true si todo esta correcto, false si no
 */
function validaExpresion(string &$var, string $expresion, string $defecto):bool {

    $opciones = ["options" => ["regexp" => $expresion]];

    //devuelve el propio valor si cumple la expresion y false si no (la cadena vacia es un valor valido)
    if (filter_var($var, FILTER_VALIDATE_REGEXP, $opciones) !== false) {
        return true;
    }

    $var = $defecto;
    return false;
}

/**
 * Funcion que comprueba que $var es igual a uno de los elementos de $posibles ($tipo=1)
 * o a una de las claves de $posibles ($tipo=2)
 * (FILTER no tiene validacion para rangos de un array, se copia la version de val_normal)
 *
 * @param mixed $var el valor que se comprueba
 * @param array $posibles array con los valores (o las claves) permitidos
 * @param integer $tipo 1 se busca entre los valores, 2 se busca entre las claves
 * @return boolean true si esta en el rango, false si no
 */
function validaRango(mixed $var, array $posibles, int $tipo=1):bool {

    if ($tipo == 2) {
        return (is_int($var) || is_string($var)) && array_key_exists($var, $posibles);
    }

    return in_array($var, $posibles, true);
}