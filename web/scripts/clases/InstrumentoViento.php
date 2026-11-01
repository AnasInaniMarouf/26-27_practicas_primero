<?php
/**
 * Clase InstrumentoViento que hereda de InstrumentoBase
 */
class InstrumentoViento extends InstrumentoBase {

    protected string $_material; //Material del que esta hecho el instrumento de viento

    public function __construct(string $_material = "madera", int $_edad = 15) {
        parent::__construct("Instrumento de viento", $_edad);

        $this -> _material = $_material;
    }

    /**
     * Funcion que devuelve una frase que representa el sonido de 
     * un instrumento de viento
     *
     * @return string
     */
    public function sonido(): string {
        return "Produce un sonido al soplar";
    }

    /**
     * Funcion que devuelve una cadena con los pasos
     * necesarios para afinar un instrumento de viento
     *
     * @return string
     */
    final public function afinar(): string {
        return "Ajustar la embocadura y cambiar la longuitud del tubo";
    }

    /**
     * Funcion que devuelve una cadena con los datos del instrumento base
     * y ademas el material del instrumento de viento
     *
     * @return string
     */
    public function __toString(): string {
        return parent::__toString() . "Instrumento de material " . $this -> _material;
    }
}