<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
$barra=[
    [
        "TEXTO"=> "Inicio",
        "ENLACE" =>"/index.php"//, "ADICIONAL"=>">>"
    ],
    [
        "TEXTO" => "Ejercicios",
        "ENLACE" => "./index.php"
    ],
    [
        "TEXTO" => "Ejercicio 7",
        "ENLACE" => ""
    ]
];

//dibuja la plantilla de la vista
inicioCabecera("Ejercicio 7");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 7", $barra);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
?>
    <main class="contenidoPrincipal">
<?php

    /*Fecha actual*/
    echo "Fecha corta: " . date("d/m/Y", time()) . "<br>";
    echo "Fecha larga: " . "Día " . date("d") . " de " . date("M") . " de " . date("Y") . "<br>";
    echo "Hora: " . date("H:i:s", time()) . "<br><br>";

    /*Lo mismo que lo anterior pero para la fecha 29/3/2024 a 12:45*/
    $dia = mktime(12,45,00,3,29,2024);

    echo "Fecha corta: " . date("d/m/Y", $dia) . "<br>";
    echo "Fecha larga: " . "Día " . date("d", $dia) . " de " . date("M", $dia) . " de " . date("Y", $dia) . "<br>";
    echo "Hora: " . date("H:i:s", $dia) . "<br><br>";

    //Lo mismo que el primero pero para la fecha actual menos 12 días y 4 horas*/
    $dia -= 60*60*24*12;    //multiplicar 60 segundos por 60 minutos por 24 horas, para obtener los segundos totales que hay en un dia, y despues multiplicarlo por 12 porque son los dias que hay que restar
    $dia -= 60*60*4;        //multiplicar 60 segundos por 60 minutos para obtener los segundos totales que hay en una hora, y despues multiplicarlo por 4 porque es lo que hay que restar

    echo "Fecha corta: " . date("d/m/Y", $dia) . "<br>";
    echo "Fecha larga: " . "Día " . date("d", $dia) . " de " . date("M", $dia) . " de " . date("Y", $dia) . "<br>";
    echo "Hora: " . date("H:i:s", $dia);
?>
    </main>
<?php
}