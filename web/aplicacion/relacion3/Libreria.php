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

function generarCadena(int $longuitud = 10):string|bool {
    if($longuitud <= 0) return false;
    
    $caracteresValidos = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    $cadena = "";

    for($i = 0; $i < $longuitud; $i++) {
        $cadena .= $caracteresValidos[rand(0, mb_strlen($caracteresValidos) - 1)];
    }

    return $cadena;
}

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

function devuelve(int &$num1, int $num2 = 6, int $num3 = 7):int {
    $num1 += $num2 + $num3;
    return $num1 * $num2 * $num3;
}

function suma(int $num1, int $num2):int {
    return $num1 + $num2;
}

function resta(int $num1, int $num2):int {
    return $num1 - $num2;
}

function multiplicacion(int $num1, int $num2):int {
    return $num1 * $num2;
}

function hacerOperacion(string $tipoOperacion, int $num1, int $num2):int|bool {
    $esValido = false;

    match(strtolower($tipoOperacion)) {
        "suma", "resta", "multiplicacion" => $esValido = true,
        default => $esValido = false
    };

    return ($esValido? ($tipoOperacion($num1, $num2)) : $esValido);
}

function llamaAFuncion(int $num1, int $num2) {
    
}

?>