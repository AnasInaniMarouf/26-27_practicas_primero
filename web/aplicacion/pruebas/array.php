<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("pruebas basicas");
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
    $miArray[3] = "valor";
    $miArray[7] = 1234;
    $miArray[] = "nueva";

    $total = 0;
    $final = count($miArray);

    for ($i=0; $i < $final; $i++) { 

        if (isset($miArray)) {

            //$total += $miArray[$i];
        
        } else {
            
            $final++;
        }
    }
}
