<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
//dibuja la plantilla de la vista
inicioCabecera("Ejercicio 2");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 2");
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
?>
    <ul class="barraUbicacion">
        <li><a href="/aplicacion/relacion1/index.php">Ejercicios</a></li>
        <li><a href="#">Ejercicio 2</a></li>
    </ul>
<?php
}