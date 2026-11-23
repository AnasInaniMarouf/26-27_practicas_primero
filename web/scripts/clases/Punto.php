<?php

class Punto {
    public const COLORES = ["black"=>["nombre"=>"negro", "rgb" =>[0,0,0]],
                            "white"=>["nombre"=>"blanco", "rgb" =>[255,255,255]],
                            "green"=>["nombre"=>"verde", "rgb" =>[0,255,0]],
                            "blue"=>["nombre"=>"azul", "rgb" =>[0,0,255]],
                            "purple"=>["nombre"=>"morado", "rgb" =>[128,0,128]]];

    public const GROSORES = [1 =>"fino", 2 => "medio", 3 => "grueso"];

    private int $_x, $_y;
    private string $_color;
    private int $_grosor;

    public static array $Puntos = [];   //variable para guardar todos los puntos que se creen

    public function __construct(int $x, int $y, string $color, int $grosor) {
        if(!$this->setX($x)) throw new Error("Error. El valor de X no es valido");  //si todo es correcto se asigna y ya esta, pero si no salta el error
        if(!$this->setY($y)) throw new Error("Error. El valor de Y no es valido");
        if(!$this->setColor($color))  throw new Error("Error. El valor del color no es valido");
        if(!$this->setGrosor($grosor))  throw new Error("Error. El valor del grosor no es valido");

        //self::$Puntos[] = $this;
        array_push(self::$Puntos, $this);   //añade el objeto creado al array de puntos
    }

    public function toStringSimple():string {
        return $this->getX() . ";" . $this->getY() . ";" . $this->getColor() . ";" . $this->getGrosor();
    }

    public function __toString():string {
        return "Punto-> X:" . $this->getX() . ", Y:" . $this->getY() . ", color: " . $this->getColor() . ", grosor: " . $this->getGrosor();
    }

    /*Getters y Setters*/
    //x
    public function getX(): int {
        return $this -> _x;
    }

    public function setX(int $x): bool {
        if ($x < 0 || $x > 20000) return false;

        $this -> _x = $x;
        return true;
    }

    //y
    public function getY(): int {
        return $this -> _y;
    }

    public function setY(int $y): bool {
        if ($y < 0 || $y > 20000) return false;

        $this -> _y = $y;
        return true;
    }

    //color
    public function getColor(): string {
        return $this -> _color;
    }

    public function setColor(string $color): bool {
        if (!isset(self::COLORES[$color])) return false;   //si no existe el color en la constante

        $this -> _color = $color;
        return true;
    }

    //grosor
    public function getGrosor(): int {
        return $this -> _grosor;
    }

    public function setGrosor(int $grosor): bool {
        if (!isset(self::GROSORES[$grosor])) return false;   //si no existe el grosor en la constante

        $this -> _grosor = $grosor;
        return true;
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