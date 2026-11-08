<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../../scripts/librerias/val_filter.php");

//codigos validos con su texto
const ESTADOS = [1 => "Estudiante", 2 => "En paro", 3 => "Trabajando", 4 => "Jubilado"];
const ESTUDIOS = [0 => "Sin estudios", 1 => "Primaria", 2 => "Secundaria", 3 => "Bachillerato", 4 => "Ciclo formativo", 5 => "Universitarios"];

//contraseña
const REGEX_CLAVE = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$_\-;<>@])[A-Za-z\d$_\-;<>@]{8,15}$/';

//controlador
$barra = [
    [
        "TEXTO" => "Inicio",
        "ENLACE" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion 5",
        "ENLACE" => ""
    ]
];

//valores iniciales del formulario, para no tener que estar escribiendolos todo el rato
$datos = [
    "nombre" => "anas",
    "clave" => "12345678_Anas",
    "fechaNacimiento" => "29/12/2006",
    "diaCarnet" => "19",
    "mesCarnet" => "07",
    "anioCarnet" => "2029",
    "horaLevantarse" => "7:30:00",
    "estado" => 0,
    "estudios" => [],
    "hermanos" => 2,
    "sueldo" => 1001
];
$errores = [];
$correcto = false;

//si se ha enviado el formulario se validan los datos
if (isset($_POST["enviar"])) {
    $correcto = validarFormulario($datos, $errores);
}

//Valida todos los datos enviados en el formulario. Los datos validados
function validarFormulario(array &$datos, array &$errores): bool {
    //nombre
    $nombre = trim($_POST["nombre"] ?? "");
    if (!VALFILTER\validaCadena($nombre, 25, "")) {
        $errores["nombre"] = "El nombre no puede tener más de 25 caracteres.";
    } elseif (mb_strlen($nombre) == 0) {
        $errores["nombre"] = "El nombre no puede estar vacío.";
    } elseif (mb_strtoupper(mb_substr($nombre, 0, 1)) == "H") {
        $errores["nombre"] = "El nombre no puede empezar por H.";
    } else {
        $nombre = mb_strtoupper($nombre);
    }
    $datos["nombre"] = $nombre;

    //contraseña
    $clave = $_POST["clave"] ?? "";
    if (!VALFILTER\validaCadena($clave, 15, "")) {
        $errores["clave"] = "La contraseña no puede tener más de 15 caracteres.";
    } elseif (!VALFILTER\validaExpresion($clave, REGEX_CLAVE, "")) {
        $errores["clave"] = "La contraseña debe tener entre 8 y 15 caracteres e incluir al menos una mayúscula, una minúscula, una cifra y un carácter especial (\$_-;<>@).";
    }
    $datos["clave"] = $clave;

    //fecha de nacimiento
    $fechaNacimiento = trim($_POST["fechaNacimiento"] ?? "");
    if (!VALFILTER\validaFecha($fechaNacimiento, "")) {
        $errores["fechaNacimiento"] = "La fecha de nacimiento no es válida (formato dd/mm/aaaa).";
    }
    $datos["fechaNacimiento"] = $fechaNacimiento;

    //fecha del carnet
    $fechaCarnet = trim($_POST["diaCarnet"] ?? "") . "/" . trim($_POST["mesCarnet"] ?? "") . "/" . trim($_POST["anioCarnet"] ?? "");
    if (!VALFILTER\validaFecha($fechaCarnet, "")) {
        $errores["fechaCarnet"] = "La fecha del carnet no es válida.";
    } elseif (!isset($errores["fechaNacimiento"])) {
        //si las dos fechas son validas se comprueba que cuando se saco el carnet ya era mayor de edad
        $nacimiento = DateTime::createFromFormat("d/m/Y", $fechaNacimiento);
        $nacimiento->setTime(0, 0);
        $carnet = DateTime::createFromFormat("d/m/Y", $fechaCarnet);
        $carnet->setTime(0, 0);

        //a la fecha del carnet se le restan 18 años no puede ser anterior al nacimiento
        $carnet->sub(new DateInterval("P18Y"));
        $intervalo = $nacimiento->diff($carnet);
        if ($intervalo->format("%R") == "-") {
            $errores["fechaCarnet"] = "La fecha del carnet no puede ser anterior a la fecha de nacimiento + 18 años.";
        }
    }
    //se separa la fecha ya saneada en dia, mes y año para volver a mostrarla
    if ($fechaCarnet != "") {
        $partes = explode("/", $fechaCarnet);
        $datos["diaCarnet"] = $partes[0];
        $datos["mesCarnet"] = $partes[1];
        $datos["anioCarnet"] = $partes[2];
    } else {
        $datos["diaCarnet"] = "";
        $datos["mesCarnet"] = "";
        $datos["anioCarnet"] = "";
    }

    //hora 
    $hora = trim($_POST["horaLevantarse"] ?? "");
    if (!VALFILTER\validaHora($hora, "")) {
        $errores["horaLevantarse"] = "La hora no es válida (formato hh:mm:ss).";
    }
    $datos["horaLevantarse"] = $hora;

    //estado
    $texto = trim($_POST["estado"] ?? "");
    $estado = 0;
    if ($texto == "") {
        $errores["estado"] = "Debe indicar un estado.";
    } else {
        if (preg_match('/^\d{1,9}$/', $texto)) {
            $estado = intval($texto);
        }
        //se comprueba contra las claves del array de estados (tipo 2)
        if (!VALFILTER\validaRango($estado, ESTADOS, 2)) {
            $estado = 0;
            $errores["estado"] = "El estado seleccionado no es correcto.";
        }
    }
    $datos["estado"] = $estado;

    //estudios
    $bruto = $_POST["estudios"] ?? [];
    if (!is_array($bruto)) {
        $bruto = [];
    }
    $estudios = [];
    $hayIncorrectos = false;
    foreach ($bruto as $valor) {
        $codigo = -1;   //-1 no esta en ESTUDIOS, asi que sera incorrecto
        if (is_string($valor) && preg_match('/^\d{1,9}$/', $valor)) {
            $codigo = intval($valor);
        }
        if (VALFILTER\validaRango($codigo, ESTUDIOS, 2)) {
            $estudios[] = $codigo;
        } else {
            $hayIncorrectos = true;
        }
    }
    $estudios = array_values(array_unique($estudios));

    if ($hayIncorrectos) {
        $errores["estudios"] = "Ha marcado algún estudio que no es correcto.";
    } elseif (count($estudios) == 0) {
        $errores["estudios"] = "Debe seleccionar al menos un estudio.";
    }
    //si esta marcado "sin estudios" se desmarcan los demas
    if (in_array(0, $estudios, true)) {
        $estudios = [0];
    }
    $datos["estudios"] = $estudios;

    //hermanos
    $texto = trim($_POST["hermanos"] ?? "");
    $hermanos = 0;
    if (!preg_match('/^-?\d{1,9}$/', $texto)) {
        $errores["hermanos"] = "El número de hermanos debe ser un entero entre 0 y 20.";
    } else {
        $hermanos = intval($texto);
        if (!VALFILTER\validaEntero($hermanos, 0, 20, 0)) {
            $errores["hermanos"] = "El número de hermanos debe estar entre 0 y 20.";
        }
    }
    $datos["hermanos"] = $hermanos;

    //sueldo
    $texto = trim($_POST["sueldo"] ?? "");
    $sueldo = 1100.0;
    if (!preg_match('/^-?\d{1,9}(\.\d+)?$/', $texto)) {
        $errores["sueldo"] = "El sueldo debe ser un número (con punto decimal) entre 1000 y 150000.";
    } else {
        $sueldo = floatval($texto);
        if (!VALFILTER\validaReal($sueldo, 1000.0, 150000.0, 1100.0)) {
            $errores["sueldo"] = "El sueldo debe estar entre 1000 y 150000.";
        }
    }
    $datos["sueldo"] = $sueldo;

    return count($errores) == 0;
}

//dibuja la plantilla de la vista
inicioCabecera("Relacion 5");
cabecera();
finCabecera();
inicioCuerpo("Relacion 5 - Introduccion de informacion", $barra);
cuerpo($datos, $errores, $correcto); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera()
{}

//vista
function cuerpo(array $datos, array $errores, bool $correcto)
{
?>
<main class="contenidoPrincipal">
<?php
    if ($correcto) {
        resumen($datos);
    } else {
        formulario($datos, $errores);
    }
?>
</main>
<?php
}

function formulario(array $datos, array $errores) {
    //para probar la validacion se añade una opcion incorrecta en estado y en estudios
    $estados = ESTADOS;
    $estados[5] = "Incorrecta";
    $estudios = ESTUDIOS;
    $estudios[6] = "Incorrecta";
?>
    <form action="index.php" method="post">
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $datos["nombre"]; ?>"><br>
            <?php if (isset($errores["nombre"])) { ?><span class="error" style="color:red"><?php echo $errores["nombre"]; ?></span><br><?php } ?>
        </p>
        <p>
            <label for="clave">Contraseña:</label>
            <input type="password" id="clave" name="clave" value="<?php echo $datos["clave"]; ?>"><br>
            <?php if (isset($errores["clave"])) { ?><span class="error" style="color:red"><?php echo $errores["clave"]; ?></span><br><?php } ?>
        </p>
        <p>
            <label for="fechaNacimiento">Fecha de nacimiento (dd/mm/aaaa):</label>
            <input type="text" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $datos["fechaNacimiento"]; ?>"><br>
            <?php if (isset($errores["fechaNacimiento"])) { ?><span class="error" style="color:red"><?php echo $errores["fechaNacimiento"]; ?></span><br><?php } ?>
        </p>
        <p>
            Fecha de carnet:
            <input type="text" name="diaCarnet" size="2" placeholder="dd" value="<?php echo $datos["diaCarnet"]; ?>"> /
            <input type="text" name="mesCarnet" size="2" placeholder="mm" value="<?php echo $datos["mesCarnet"]; ?>"> /
            <input type="text" name="anioCarnet" size="4" placeholder="aaaa" value="<?php echo $datos["anioCarnet"]; ?>"><br>
            <?php if (isset($errores["fechaCarnet"])) { ?><span class="error" style="color:red"><?php echo $errores["fechaCarnet"]; ?></span><br><?php } ?>
        </p>
        <p>
            <label for="horaLevantarse">Hora de levantarse (hh:mm:ss):</label>
            <input type="text" id="horaLevantarse" name="horaLevantarse" value="<?php echo $datos["horaLevantarse"]; ?>"><br>
            <?php if (isset($errores["horaLevantarse"])) { ?><span class="error" style="color:red"><?php echo $errores["horaLevantarse"]; ?></span><br><?php } ?>
        </p>
        <p>
            Estado:<br>
<?php
    foreach ($estados as $codigo => $texto) {
        $marcado = ($datos["estado"] === $codigo) ? " checked" : "";
        echo "            <label><input type=\"radio\" name=\"estado\" value=\"" . $codigo . "\"" . $marcado . "> "
            . $codigo . " - " . $texto . "</label><br>" . PHP_EOL;
    }
?>
            <?php if (isset($errores["estado"])) { ?><span class="error" style="color:red"><?php echo $errores["estado"]; ?></span><br><?php } ?>
        </p>
        <p>
            Estudios:<br>
<?php
    foreach ($estudios as $codigo => $texto) {
        $marcado = in_array($codigo, $datos["estudios"], true) ? " checked" : "";
        echo "            <label><input type=\"checkbox\" name=\"estudios[]\" value=\"" . $codigo . "\"" . $marcado . "> "
            . $codigo . " - " . $texto . "</label><br>" . PHP_EOL;
    }
?>
            <?php if (isset($errores["estudios"])) { ?><span class="error" style="color:red"><?php echo $errores["estudios"]; ?></span><br><?php } ?>
        </p>
        <p>
            <label for="hermanos">Hermanos (0-20):</label>
            <input type="text" id="hermanos" name="hermanos" value="<?php echo $datos["hermanos"]; ?>"><br>
            <?php if (isset($errores["hermanos"])) { ?><span class="error" style="color:red"><?php echo $errores["hermanos"]; ?></span><br><?php } ?>
        </p>
        <p>
            <label for="sueldo">Sueldo (1000-150000 €):</label>
            <input type="text" id="sueldo" name="sueldo" value="<?php echo $datos["sueldo"]; ?>"><br>
            <?php if (isset($errores["sueldo"])) { ?><span class="error" style="color:red"><?php echo $errores["sueldo"]; ?></span><br><?php } ?>
        </p>
        <p>
            <input type="submit" name="enviar" value="Enviar">
        </p>
    </form>
<?php
}

//muestra el resumen de los datos introducidos
function resumen(array $datos) {
    //texto de cada uno de los estudios marcados
    $textoEstudios = [];
    foreach ($datos["estudios"] as $codigo) {
        $textoEstudios[] = ESTUDIOS[$codigo];
    }
?>
    <h2>Datos introducidos</h2>
    <ul>
        <li>Nombre: <?php echo $datos["nombre"]; ?></li>
        <li>Contraseña: <?php echo str_repeat("*", mb_strlen($datos["clave"])); ?></li>
        <li>Fecha de nacimiento: <?php echo $datos["fechaNacimiento"]; ?></li>
        <li>Fecha de carnet: <?php echo $datos["diaCarnet"] . "/" . $datos["mesCarnet"] . "/" . $datos["anioCarnet"]; ?></li>
        <li>Hora de levantarse: <?php echo $datos["horaLevantarse"]; ?></li>
        <li>Estado: <?php echo ESTADOS[$datos["estado"]]; ?></li>
        <li>Estudios: <?php echo implode(", ", $textoEstudios); ?></li>
        <li>Hermanos: <?php echo $datos["hermanos"]; ?></li>
        <li>Sueldo: <?php echo number_format($datos["sueldo"], 2, ",", "."); ?> €</li>
    </ul>
    <button><a href="index.php">Volver al formulario</a></button>
<?php
}