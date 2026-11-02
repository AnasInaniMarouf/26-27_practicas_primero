<?php
/**
 * clase ClaseMisPropiedades que implementa a la interfaz Iterator
 */
class ClaseMisPropiedades implements Iterator{
    private array $_propiedades = [];

    private int $_claveActual = 0;  //Clave del Iterator

    public mixed $propPublica;
    private mixed $_propPrivada = 25;

    public function __construct() {}

    /**
     * Devuelve todas las propiedades con oi_ antes, y
     * propPublica y _propPrivada son los ultimos elementos
     *
     * @return array
     */
    private function obtenerPropiedades(): array {

        $propiedades = [];

        foreach ($this->_propiedades as $clave => $valor) {
            $propiedades["oi_" . $clave] = $valor;
        }

        //Propiedades del final
        $propiedades["oi_propPublica"] = $this -> propPublica;
        $propiedades["oi_propPrivada"] = $this -> _propPrivada;

        return $propiedades;
    }

    /**
     * Metodo magico que devuelve una propiedad segun
     * el nombre que se haya pasado
     *
     * @param string $nombre
     * @return mixed
     */
    public function __get(string $nombre): mixed {

        //Valida antes que exista la clave en el array
        if (!array_key_exists($nombre, $this -> _propiedades)) throw new Exception("A la propiedad $nombre no se le ha asignado ningun valor");

        return $this -> _propiedades[$nombre];
    }

    /**
     * Metodo magico que añade una propiedad con un nombre y un valor
     *
     * @param string $nombre
     * @param mixed $valor
     * @return void
     */
    public function __set(string $nombre, mixed $valor): void {

        if ($nombre == "_propPrivada") throw new Exception("No se pueden crear propiedades privadas");

        $this -> _propiedades[$nombre] = $valor;
    }
    
    /**
     * Metodo magico que comprueba si existe una propiedad con el nombre dado
     *
     * @param string $nombre
     * @return boolean
     */
    public function __isset(string $nombre): bool {
        return isset($this -> _propiedades[$nombre]);
    }

    /**
     * Metodo magico que elimina una propiedad segun el nombre
     *
     * @param string $nombre
     * @return void
     */
    public function __unset(string $nombre): void {
        unset($this -> _propiedades[$nombre]);
    }

    //Metodos del Iterator
    public function current(): mixed {
        $propiedades = array_values($this->obtenerPropiedades());   //El metodo array_values() devuelve un array escalar en el que están los valores del array

        return $propiedades[$this->_claveActual];
    }

    public function key(): mixed {
        $propiedades = array_keys($this->obtenerPropiedades()); //El metodo array_keys() evuelve un array escalar que contiene todas las claves del array

        return $propiedades[$this->_claveActual];
    }

    public function next(): void {
        $this->_claveActual++;
    }

    public function rewind(): void {
        $this->_claveActual = 0;
    }

    public function valid(): bool {
        return $this->_claveActual < count($this->obtenerPropiedades());
    }
}
