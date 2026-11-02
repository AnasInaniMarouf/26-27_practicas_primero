<?php
/**
 * Tipo enumerado EstadoCivil
 */
enum EstadoCivil: int {

    case Soltero = 10;
    case Casado = 20;
    case Pareja = 30;
    case Viudo = 40;

    /**
     * Funcion que devuelve el nombre del caso concreto
     *
     * @return string
     */
    public function descripcion(): string {
        return $this -> name;
    }

    /**
     * Funcion que devuelve el valor del caso concreto
     *
     * @return integer
     */
    public function valor(): int {
        return $this -> value;
    }

    /**
     * Funcion estatica que devuelve un array con todos los casos
     *
     * @return array
     */
    public static function casos(): array {
        return EstadoCivil::cases();    //El metodo cases() devuelve un array con todos los casos posibles de la enumeración
    }
}