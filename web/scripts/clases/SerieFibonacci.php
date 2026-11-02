<?php
/**
 * Clase SerieFibonacci que implementa la interfaz Iterator
 */
class SerieFibonacci implements Iterator {
    private int $_limite, $_claveActual = 0;

    public function __construct(int $limite) {
        $this -> _limite = $limite;
    }

    /**
     * Funcion estatica que calcula la serie de Fibonacci
     * segun el numero ultimo que se le haya pasado,
     * y se usa un generador (yield) para devolver el valor
     * en cada vuelta
     *
     * @param integer $ultimo
     */
    public static function fFibonacci(int $ultimo) {
        $num1 = 0;
        $num2 = 1;
        $aux = 0;

        for($i = 0; $i <= $ultimo; $i++) {
            yield $num1;

            $aux = $num1;
            $num1 = $num2;
            $num2 += $aux;

        }
    }

    /**
     * Devuelve el valor del fibonacci actual, utilizando
     * la formula alternativa
     *
     * @return mixed
     */
    public function current():mixed {
        $raiz5 = sqrt(5);   //creo una variable para que solo se calcule una vez

        return ((1/$raiz5) * pow(((1 + $raiz5)/2), $this -> _claveActual))
                - (1/$raiz5) * pow(((1 - $raiz5)/2), $this -> _claveActual);
    }
    
    /**
     * Funcion que devuelve la clave
     *
     * @return mixed
     */
    public function key():mixed {
        return $this -> _claveActual;
    }

    /**
     * Funcion que aumenta la clave en 1
     *
     * @return void
     */
    public function next():void {
        $this -> _claveActual++;
    }

    /**
     * Funcion que resetea la clave a 0
     *
     * @return void
     */
    public function rewind():void {
        $this -> _claveActual = 0;
    }

    /**
     * Funcion que verifica que la clave
     * sea menor que el limite, si no seria
     * infinito
     *
     * @return boolean
     */
    public function valid():bool {
        return $this -> _claveActual <= $this -> _limite;
    }

    //Deshabilitar la sobrecarga dinámica en la clase
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