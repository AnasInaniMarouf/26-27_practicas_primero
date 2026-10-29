<?php
Class InstrumentoBase {
    private string $_descripcion;
    protected int $edad = 10;

    //Propiedad de clase protegida para contar el numero de instrumentos creados
    protected static int $instrumentosCreados = 0;
    private int $_ordenCreacion;

    public function __construct(string $desc, int $edad) {
        $this -> _descripcion = $desc;
    }

    /*abstract*/ public function sonido() {
        return "frase que representa el sonido";
    }

    /*abstract*/ public function afinar() {
        return "pasos necesarios para afinar el instrumento";
    }

    public function envejecer() {
        $this -> edad++;
    }
}