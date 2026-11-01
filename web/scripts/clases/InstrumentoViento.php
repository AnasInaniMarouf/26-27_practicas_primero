<?php
/**
 * Clase InstrumentoViento que hereda de InstrumentoBase
 */
class InstrumentoViento extends InstrumentoBase {

    protected string $material; //Material del que esta hecho el instrumento de viento

    public function __construct(string $material = "madera", int $edad = 15) {
        parent::__construct("Instrumento de viento", $edad);

        $this -> material = $material;
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
    public function echoInstrumentoViento(): string {
        return parent::echoInstrumentoBase() . "Instrumento de material " . $this -> material;
    }
}