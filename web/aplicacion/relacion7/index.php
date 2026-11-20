<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
$barra=[
    [
        "TEXTO"=> "Inicio",
        "ENLACE" =>"/index.php"
    ],
    [
        "TEXTO" => "Relacion 7",
        "ENLACE" => ""
    ]
];



//dibuja la plantilla de la vista
inicioCabecera("Relacion 7");
cabecera();
finCabecera();
inicioCuerpo("Relacion 7 - Ficheros", $barra);
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
<main class="contenidoPrincipal">
<?php
formulario();
?>
</main>
<?php
}

function formulario() {
?> 
    <h3>Formulario</h3>
    <p>Coordenada X: <input type="number" name=""></p>
    <p>Coordenada Y: <input type="number" name=""></p>
    <p>Color:
        <select name="colores">
            <?php
                foreach(Punto::COLORES as $claveColor => $nombreColor) {
                    ?><option value="<?php $claveColor ?>"><?php echo $nombreColor["nombre"] ?></option><?php
                }
            ?>
        </select>
        <br>
        <p>Grosor:<br>
        <?php
            foreach(Punto::GROSORES as $claveGrosor => $nombreGrosor) {
                ?><input type="radio" name="grosor" value="<?php $claveGrosor ?>"><?php echo $nombreGrosor ?><br><?php
            }
        ?>
        </p>
    </p>
<?php
}

function escribirAFichero(string $nombre, array $puntos) {

}