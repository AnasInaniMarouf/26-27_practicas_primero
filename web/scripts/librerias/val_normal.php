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

    //comprueba que el formato de la fecha sea valida
    if (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $var, $partes)) {

        $dia = intval($partes[1]);
        $mes = intval($partes[2]);
        $año = intval($partes[3]);

        //Comprueba que la fecha sea valida
        if (checkdate($mes, $dia, $año)) {
            $var = ($dia < 10? "0" . $dia : $dia)   //si el dia es menor que diez, se le pone un 0 delante
                    . "/" . ($mes < 10? "0" . $mes : $mes)  //y con el mes igual que el dia
                    . "/" . $año;
            return true;
        }
    }

    //si el formato de la fecha no es valida o la fecha no esta bien se le asigna el valor de $defecto
    $var = $defecto;
    return false;
}

/**
 * Funcion que comprueba que $var contiene una hora correcta en el formato hh:mm:ss
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
            $var = ($horas < 10? "0" . $horas : $horas)   //si la hora es menor que diez, se le pone un 0 delante
                    . ":" . ($minutos < 10? "0" . $minutos : $minutos)  //lo mismo con los minutos
                    . ":" . ($segundos < 10? "0" . $segundos : $segundos); //y lo mismo con los segundos
            return true;
        }
    }

    //si el formato de la hora no es valida o no esta bien se le asigna el valor de $defecto
    $var = $defecto;
    return false;
}


/**
 * Funcion que comprueba que $var contiene un email correcto en el formato aaaaa@bbbb.ccc
 *
 * @param string $var el email que se pasa, se devuelve el email saneado (se le quitan los espacios
 *                    del principio y del final; si esta mal se le asigna $defecto)
 * @param string $defecto el email por defecto que tomara $var en caso de estar mal
 * @return boolean true si todo esta correcto, false si no
 */
function validaEmail(string &$var, string $defecto):bool {
 
    //saneo: quito los espacios del principio y del final
    $var = trim($var);
 
    //comprueba el formato: caracteres@dominio(.subdominio)*.extension (extension de 2 o mas letras)
    if (preg_match('/^[\w.+-]+@[A-Za-z0-9-]+(\.[A-Za-z0-9-]+)*\.[A-Za-z]{2,}$/', $var)) {
        return true;
    }
 
    //si el formato no es valido se le asigna el valor de $defecto
    $var = $defecto;
    return false;
}
 
/**
 * Funcion que comprueba que $var contiene una cadena de longitud maxima $longitud
 *
 * @param string $var la cadena que se pasa (si no cumple la condicion se le asigna $defecto)
 * @param integer $longitud la longitud maxima (en caracteres) que puede tener $var
 * @param string $defecto el valor por defecto que tomara $var en caso de estar mal
 * @return boolean true si todo esta correcto, false si no
 */
function validaCadena(string &$var, int $longitud, string $defecto):bool {
 
    //se usa mb_strlen para contar caracteres y no bytes (ñ, tildes, etc.)
    if (mb_strlen($var) <= $longitud) {
        return true;
    }
 
    $var = $defecto;
    return false;
}
 
/**
 * Funcion que comprueba que $var cumple con la expresion regular $expresion
 *
 * @param string $var la cadena que se comprueba (si no cumple la condicion se le asigna $defecto)
 * @param string $expresion la expresion regular (con sus delimitadores) que tiene que cumplir $var
 * @param string $defecto el valor por defecto que tomara $var en caso de estar mal
 * @return boolean true si todo esta correcto, false si no
 */
function validaExpresion(string &$var, string $expresion, string $defecto):bool {
 
    if (preg_match($expresion, $var)) {
        return true;
    }
 
    $var = $defecto;
    return false;
}
 
/**
 * Funcion que comprueba que $var es igual a uno de los elementos de $posibles ($tipo=1)
 * o a una de las claves de $posibles ($tipo=2)
 *
 * @param mixed $var el valor que se comprueba
 * @param array $posibles array con los valores (o las claves) permitidos
 * @param integer $tipo 1 se busca entre los valores, 2 se busca entre las claves
 * @return boolean true si esta en el rango, false si no
 */
function validaRango(mixed $var, array $posibles, int $tipo=1):bool {
 
    if ($tipo == 2) {
        //las claves de un array solo pueden ser enteros o cadenas
        return (is_int($var) || is_string($var)) && array_key_exists($var, $posibles);
    }
 
    //comparacion estricta (mismo valor y mismo tipo)
    return in_array($var, $posibles, true);
}
