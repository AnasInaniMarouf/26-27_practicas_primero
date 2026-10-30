<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
$barra = [
    [
        "TEXTO" => "Inicio",
        "ENLACE" => "/index.php" //, "ADICIONAL"=>">>"
    ],
    [
        "TEXTO" => "Prueba",
        "ENLACE" => "./index.php"
    ],
    [
        "TEXTO" => "Prueba de Formularios",
        "ENLACE" => ""
    ]
];

$datos = ["nombre" => "Anas", "precio" => 13];
$errores = [];

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION", $barra);
cuerpo($datos, $errores); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo(array $datos, array $errores)
{
    if ($errores) { //mostrar los errores
        echo "<div class='error'>";
        foreach ($errores as $clave => $valor) {
            foreach ($valor as $error)
                echo "$clave => $error<br>" . PHP_EOL;
        }
        echo "</div>";
    }
?>
<main class="contenidoPrincipal">
    <form action="" method="post">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre"
            value="<?php echo $datos["nombre"]; ?>" size=21
            maxlength="20"><br>
        <label for="precio">Precio: </label>
        <input type="text" name="precio" id="precio"
            value="<?php echo $datos["precio"]; ?>" size=4
            maxlength="3"><br>
        <input type="submit" class="boton" value="Crear">
    </form>
</main>
<?php
}
