<?php
/**
 * Interfaz IFabricable que permite indicar el proceso de fabricación y como se recicla
 */
interface IFabricable {

    /**
     * Funcion que devuelve los pasos para fabricar el elemento
     *
     * @return string
     */
    public function metodoFabricacion(): string;

    /**
     * Funcion que devuelve el método de reciclado que se debe
     * aplicar al elemento según su fabricación
     *
     * @return string
     */
    public function metodoReciclado(): string;
}