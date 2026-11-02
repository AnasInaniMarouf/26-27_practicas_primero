<?php
/**
 * Clase Persona
 */
class Persona {
    private string $_nombre, $_fechaNacimiento, $_domicilio, $_localidad;
    private EstadoCivil $_estado;

    /**
     * Constructor privado que iguala las propiedades a valores por defecto
     */
    private function __construct() {
        $this -> _nombre = "prueba";
        $this -> _fechaNacimiento = "01/01/2000";
        $this -> _domicilio = "carrera 12";
        $this -> _localidad = "antequera";
        $this -> _estado = EstadoCivil::Soltero;
    }

    /**
     * Funcion que crea y devuelve una persona con las propiedades dadas
     *
     * @param string $nombre
     * @param string $fechaNacimiento
     * @param string $domicilio
     * @param string $localidad
     * @param EstadoCivil $estado
     * @return Persona
     */
    public static function registrarPersona(string $nombre, string $fechaNacimiento, string $domicilio, string $localidad, EstadoCivil $estado): Persona {
        $persona = new Persona();

        $persona -> setNombre($nombre);
        $persona -> setFechaNacimiento($fechaNacimiento);
        $persona -> setDomicilio($domicilio);
        $persona -> setLocalidad($localidad);
        $persona -> setEstado($estado);

        return $persona;
    }

    public function __toString() {
        return $this -> _nombre . " es una persona " . $this -> _estado -> descripcion() .
                " nacida en " . $this -> _fechaNacimiento . " y que vive en " . $this -> _localidad;
    }

    //Getters
    public function getNombre(): string {
        return $this -> _nombre;
    }

    public function getFechaNacimiento(): string {
        return $this -> _fechaNacimiento;
    }

    public function getDomicilio(): string {
        return $this -> _domicilio;
    }

    public function getLocalidad(): string {
        return $this -> _localidad;
    }

    public function getEstado(): EstadoCivil {
        return $this -> _estado;
    }

    //Setters
    public function setNombre(string $nombre): void {
        $this -> _nombre = $nombre;
    }

    public function setFechaNacimiento(string $fechaNacimiento): void {
        $this -> _fechaNacimiento = $fechaNacimiento;
    }

    public function setDomicilio(string $domicilio): void {
        $this -> _domicilio = $domicilio;
    }

    public function setLocalidad(string $localidad): void {
        $this -> _localidad = $localidad;
    }

    public function setEstado(EstadoCivil $estado): void {
        $this -> _estado = $estado;
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