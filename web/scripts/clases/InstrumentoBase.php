<?php
/**
 * Clase abstracta InstrumentoBase
 */
abstract class InstrumentoBase {
    
    private string $_descripcion;   //Descripcion del instrumento
    protected int $_edad;    //Edad del instrumento (por defecto sera 10)

    //Propiedad de clase protegida para contar el numero de instrumentos creados
    protected static int $_instrumentosCreados = 0;
    
    //Propiedad de instancia para indicar el orden del instrumento creado
    private int $_ordenCreacion;

    /**
     * Funcion a la que se le pasan dos parametros, y crea un objeto en
     * base a esos parametros, y ademas los iguala a las propiedades de la clase
     *
     * @param string $desc
     * @param integer $_edad
     */
    public function __construct(string $desc, int $_edad = 10) {
        $this -> _descripcion = $desc;
        $this -> _edad = $_edad;

        
        $this -> _aumentarInstrumentos();
    }

    /**
     * Funcion para aumentar el contador del numero de instrumentos creados,
     * y ademas asignarle el orden al instrumento, he tenido que hacer este metodo
     * para utilizarlo despues en la clase Flauta para cuando quiera clonar una flauta
     *
     * @return void
     */
    protected function _aumentarInstrumentos(): void {
        self::$_instrumentosCreados++;
        
        //Como la variable de clase va aumentando cada vez que se cree un instrumento,
        //he igualado el orden de creacion para que cada objeto tenga su propio orden y siempre sea distinto
        $this->_ordenCreacion = self::$_instrumentosCreados;
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
        $this -> _edad++;
    }

    /**
     * Funcion que devuelve una cadena con los datos del instrumento base
     *
     * @return string
     */
    public function __toString(): string {
        return "Instrumento con descripción " . $this -> _descripcion . ", instancia " . $this -> _ordenCreacion .
                " de un total de " . self::$_instrumentosCreados . ". Tiene " . $this -> _edad . " años. La clase es " . get_class($this) . ". ";
    }

    //Getters
    public function getDescripcion(): string {
        return $this -> _descripcion;
    }

    public function getEdad(): int {
        return $this -> _edad;
    }

    //Setters
    public function setDescripcion(string $cadena): void {
        $this -> _descripcion = $cadena;
    }

    //Deshabilitar la sobrecarga dinámica en la clase
    /*Como las demas clases heredan de esta, no hace falta escribirlas otra vez
    porque estos metodos tambien se heredan*/
    public function __get(string $nombre): mixed {
        throw new Exception("No existe la propiedad " . $nombre);
    }

    public function __set(string $nombre, mixed $valor): void {
        throw new Exception("No existe la propiedad " . $nombre);
    }

    public function __isset(string $nombre): bool {
        throw new Exception("No existe la propiedad " . $nombre);
    }

    public function __unset(string $nombre): void {
        throw new Exception("No existe la propiedad " . $nombre);
    }
}