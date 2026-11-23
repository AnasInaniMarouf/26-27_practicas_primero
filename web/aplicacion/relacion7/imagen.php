<?php
/**
 * Este archivo se encargara de crear una imagen con la extension .jpg
 * a partir de los puntos de la clase Puntos (Punto::$Puntos)
 */
include_once(dirname(__FILE__) . "/funciones.php");
leerFicheroPuntos(nombreFicheroFormateado(".dat", "puntos_"));

$imagen = imagecreatetruecolor(400, 400);   //crea una imagen de 400x400

imagefill($imagen, 0, 0, imagecolorallocate($imagen, 255, 255, 255));  //rellena la imagen de blanco
imagerectangle($imagen, 0, 0, 399, 399, imagecolorallocate($imagen, 0, 128, 128));    //399x399 para que el borde tenga tamaño 1 (400 de la imagen menos 399)

foreach(Punto::$Puntos as $punto) {
    $rgbPunto = Punto::COLORES[$punto->getColor()]["rgb"];  //array de rgb del color
    $color = imagecolorallocate($imagen, $rgbPunto[0], $rgbPunto[1], $rgbPunto[2]); //crea el color para la imagen
    imagefilledellipse($imagen, $punto->getX(), $punto->getY(), $punto->getGrosor() * 10, $punto->getGrosor() * 10, $color);  //añade el punto a la imagen, con sus coordenadas y su grosor (los he multiplicado por 10 para que se vean mejor)
}

header('Content-Type: image/jpeg');  //tipo mime para imagenes jpg
header('Content-Disposition: attachment; filename="imagenPuntos.jpg"');

imagejpeg($imagen);

exit;