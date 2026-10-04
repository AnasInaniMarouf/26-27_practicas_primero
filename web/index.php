<?php
include_once(dirname(__FILE__) . "/cabecera.php");
//controlador
//dibuja la plantilla de la vista
inicioCabecera("Practica 1");
cabecera();
finCabecera();
inicioCuerpo("INICIO");
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera()
{}
//vista
function cuerpo()
{
?>
    <ul class="menuOpciones">
        <li>
            <a href="./aplicacion/relacion1/index.php">Ejercicios</a>
        </li>
    </ul>
<?php
}