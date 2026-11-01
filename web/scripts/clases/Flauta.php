<?php
/**
 * Clase Flauta que es un instrumento de viento que es fabricable y de la que no se puede
heredar ninguna otra subclase
 */
final class Flauta extends InstrumentoViento implements IFabricable {

    /**
     * El constructor es privado porque para crear el objeto Flauta
     * desde otra clase se usara el metodo CrearDesdeArray, metodo
     * que llamara a este constructor y ahi se creara el objeto
     *
     * @param string $material
     * @param integer $edad
     */
    private function __construct(string $material, int $edad) {
        parent::__construct($material, $edad);
    }

    /**
     * Funcion que devuelve una instancia de Flauta con los
     * valores indicados
     *
     * @param array $array
     * @return Flauta
     */
    public static function CrearDesdeArray(array $array = []): Flauta {
        $material = $array["material"] ?? "madera"; 
        $edad = $array["edad"] ?? 15;

        return new Flauta($material, $edad);
    }

    /**
     * Funcion que clona una flauta de forma que el nuevo objeto tenga los
     * mismos valores, salvo la edad que será 0, y las instancias que se resetearan
     *
     * @return void
     */
    public function __clone(): void {
        $this -> _edad = 0;
        $this -> _aumentarInstrumentos();
    }
    
    /**
     * Funcion que devuelve los pasos para fabricar la Flauta
     *
     * @return string
     */
    public function metodoFabricacion(): string {
        return "Se puede utilizar un tubo de PVC o una pajita";
    }

    /**
     * Funcion que devuelve el método de reciclado que se debe
     * aplicar a la Flauta según su fabricación
     *
     * @return string
     */
    public function metodoReciclado(): string {
        return "Tirar al cubo correspondiente segun su material";
    }

}