<?php
/**
 * Clase abstracta InstrumentoBase
 */
abstract class InstrumentoBase {
    
    private string $_descripcion;   //Descripcion del instrumento
    protected int $edad;    //Edad del instrumento (por defecto sera 10)

    //Propiedad de clase protegida para contar el numero de instrumentos creados
    protected static int $instrumentosCreados = 0;
    
    //Propiedad de instancia para indicar el orden del instrumento creado
    private int $_ordenCreacion;

    /**
     * Funcion a la que se le pasan dos parametros, y crea un objeto en
     * base a esos parametros, y ademas los iguala a las propiedades de la clase
     *
     * @param string $desc
     * @param integer $edad
     */
    public function __construct(string $desc, int $edad = 10) {
        $this -> _descripcion = $desc;
        $this -> edad = $edad;

        self::$instrumentosCreados++;
        //Como la variable de clase va aumentando cada vez que se cree un instrumento,
        //he igualado el orden de creacion para que cada objeto tenga su propio orden y siempre sea distinto
        $this -> _ordenCreacion = self::$instrumentosCreados;
    }

    /**
     * Funcion abstracta que devuelve una frase que representa el sonido
     *
     * @return string
     */
    abstract public function sonido(): string;

    /**
     * Funcion abstracta que devuelve una cadena con los pasos
     * necesarios para afinar el instrumento
     *
     * @return string
     */
    abstract public function afinar(): string;

    /**
     * Funcion que aumenta en 1 la edad del instrumento
     *
     * @return void
     */
    public function envejecer(): void {
        $this -> edad++;
    }

    /**
     * Funcion que devuelve una cadena con los datos del instrumento base
     *
     * @return string
     */
    public function echoInstrumentoBase(): string {
        return "Instrumento con descripción " . $this -> _descripcion . ", instancia " . $this -> _ordenCreacion .
                " de un total de " . self::$instrumentosCreados . ". Tiene " . $this -> edad . " años. La clase es " . get_class($this) . ". ";
    }

    //Getters
    public function getCadena(): string {
        return $this -> _descripcion;
    }

    public function getEdad(): int {
        return $this -> edad;
    }

    //Setters
    public function setCadena(string $cadena): void {
        $this -> _descripcion = $cadena;
    }
}