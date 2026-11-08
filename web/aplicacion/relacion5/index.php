<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../../scripts/librerias/val_normal.php");    //el formulario tambien funciona con VALNORMAL/
include_once(dirname(__FILE__) . "/../../scripts/librerias/val_filter.php");

const ESTADOS = [1 => "Estudiante", 2 => "En paro", 3 => "Trabajando", 4 => "Jubilado"];
const ESTUDIOS = [0 => "Sin estudios", 1 => "Primaria", 2 => "Secundaria", 3 => "Bachillerato", 4 => "Ciclo formativo", 5 => "Universitarios"];

//contraseña
const contraseña = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@!%*?&\-_+])[A-Za-z\d$@!%*?&\-_+]{8,15}$/';

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

//valores por defecto del formulario, para no tener que estar escribiendolos todo el rato
$datos = [
    "nombre" => "anas",
    "clave" => "12345678_Anas",
    "fechaNacimiento" => "29/12/2006",
    "diaCarnet" => "12",
    "mesCarnet" => "8",
    "añoCarnet" => "2026",
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

/**
 * Valida todos los datos enviados en el formulario
 *
 * @param array $datos array con los valores a mostrar
 * @param array $errores errores si es que los hay
 * @return boolean
 */
function validarFormulario(array &$datos, array &$errores): bool {
    //nombre
    $nombre = trim($_POST["nombre"] ?? "");
    if (!VALFILTER\validaCadena($nombre, 25, "")) { //si la funcion devuelve false devuelve un error
        $errores["nombre"] = "El nombre no puede tener más de 25 caracteres.";
    } else if (mb_strlen($nombre) == 0) {   //si la cadena esta vacia
        $errores["nombre"] = "El nombre no puede estar vacío.";
    } else if (mb_strtoupper(mb_substr($nombre, 0, 1)) == "H") {    //si empieza por H
        $errores["nombre"] = "El nombre no puede empezar por H.";
    } else {    //todo esta bien
        $nombre = mb_strtolower($nombre);
    }

    $datos["nombre"] = $nombre;

    //contraseña
    $clave = $_POST["clave"] ?? "";
    if (!VALFILTER\validaCadena($clave, 15, "")) {
        $errores["clave"] = "La contraseña no puede tener más de 15 caracteres.";
    } elseif (!VALFILTER\validaExpresion($clave, contraseña, "")) {
        $errores["clave"] = "La contraseña debe tener entre 8 y 15 caracteres e incluir al menos una mayúscula, una minúscula, una cifra y un carácter especial.";
    }

    $datos["clave"] = $clave;

    //fecha de nacimiento
    $fechaNacimiento = trim($_POST["fechaNacimiento"] ?? "");
    if (!VALFILTER\validaFecha($fechaNacimiento, "")) {
        $errores["fechaNacimiento"] = "La fecha de nacimiento no es válida (formato dd/mm/aaaa).";
    }

    $datos["fechaNacimiento"] = $fechaNacimiento;

    //fecha del carnet
    $fechaCarnet = trim($_POST["diaCarnet"] ?? "") . "/" . trim($_POST["mesCarnet"] ?? "") . "/" . trim($_POST["añoCarnet"] ?? "");

    if (!VALFILTER\validaFecha($fechaCarnet, "")) {
        $errores["fechaCarnet"] = "La fecha del carnet no es válida.";

    } elseif (!isset($errores["fechaNacimiento"])) {
        //si las dos fechas son validas se comprueba que la fecha del carnetes mayor a la fecha de nacimiento mas 18 años
        $nacimiento = DateTime::createFromFormat("d/m/Y", $fechaNacimiento);
        $nacimiento->setTime(0, 0);

        $carnet = DateTime::createFromFormat("d/m/Y", $fechaCarnet);
        $carnet->setTime(0, 0);

        //a la fecha del carnet se le restan 18 años porquew no puede ser anterior al nacimiento
        $carnet->sub(new DateInterval("P18Y"));
        $intervalo = $nacimiento->diff($carnet);

        if ($intervalo->format("%R") == "-") {
            $errores["fechaCarnet"] = "La fecha del carnet no puede ser anterior a la fecha de nacimiento + 18 años.";
        }
    }

    //se separa la fecha ya saneada en dia, mes y año para mostrarla otra vez
    if ($fechaCarnet != "") {
        $partes = explode("/", $fechaCarnet);
        $datos["diaCarnet"] = $partes[0];
        $datos["mesCarnet"] = $partes[1];
        $datos["añoCarnet"] = $partes[2];
    } else {
        $datos["diaCarnet"] = "";
        $datos["mesCarnet"] = "";
        $datos["añoCarnet"] = "";
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
    $estudiosAux = $_POST["estudios"] ?? [];

    $estudios = [];
    $hayIncorrectos = false;
    foreach ($estudiosAux as $valor) {
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

    return count($errores) == 0;    //si es 0 no hay ningun error, por lo que devuelve true, si no devuelve false 
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

/**
 * Funcion para mostrar el formulario a la que se le pasan como 
 * parámetros un array con los valores a mostrar y un array con los errores
 *
 * @param array $datos
 * @param array $errores
 * @return void
 */
function formulario(array $datos, array $errores) {
    //estado y estudio incorrecto para probar la validacion
    $estados = ESTADOS;
    $estados[5] = "Incorrecta";

    $estudios = ESTUDIOS;
    $estudios[6] = "Incorrecta";
?>
    <form action="index.php" method="post">
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $datos["nombre"]; ?>"><br>
            <?php if (isset($errores["nombre"])) {?>
            <span class="error">
                <?php echo $errores["nombre"]; ?>
            </span><br>
            <?php } ?>
        </p>
        <p>
            <label for="clave">Contraseña:</label>
            <input type="password" id="clave" name="clave" value="<?php echo $datos["clave"]; ?>"><br>
            <?php if (isset($errores["clave"])) {?>
            <span class="error">
                <?php echo $errores["clave"]; ?>
            </span><br>
            <?php } ?>
        </p>
        <p>
            <label for="fechaNacimiento">Fecha de nacimiento (dd/mm/aaaa):</label>
            <input type="text" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $datos["fechaNacimiento"]; ?>"><br>
            <?php if (isset($errores["fechaNacimiento"])) {?>
            <span class="error">
                <?php echo $errores["fechaNacimiento"]; ?>
            </span><br>
            <?php } ?>
        </p>
        <p>
            Fecha de carnet:
            <input type="text" name="diaCarnet" size="2" value="<?php echo $datos["diaCarnet"]; ?>"> /
            <input type="text" name="mesCarnet" size="2" value="<?php echo $datos["mesCarnet"]; ?>"> /
            <input type="text" name="añoCarnet" size="4" value="<?php echo $datos["añoCarnet"]; ?>"><br>
            <?php if (isset($errores["fechaCarnet"])) { ?>
            <span class="error">
                <?php echo $errores["fechaCarnet"]; ?>
            </span>
            <br>
            <?php } ?>
        </p>
        <p>
            <label for="horaLevantarse">Hora de levantarse (hh:mm:ss):</label>
            <input type="text" id="horaLevantarse" name="horaLevantarse" value="<?php echo $datos["horaLevantarse"]; ?>"><br>
            <?php if (isset($errores["horaLevantarse"])) {?>
            <span class="error">
                <?php echo $errores["horaLevantarse"]; ?>
            </span><br>
            <?php } ?>
        </p>
        <p>
            Estado:<br>
            <?php foreach ($estados as $codigo => $texto) { //Bucle que recorre todos los estados y los muestra en la vista?> 
                <label>
                    <input type="radio" name="estado" value="<?php echo $codigo; ?>"
                    <?php if ($datos["estado"] == $codigo) echo "checked"; ?>>
                    <?php echo $codigo . " - " . $texto; ?>
                </label><br>
            <?php } ?>

            <?php if (isset($errores["estado"])) { ?>
                <span class="error"><?php echo $errores["estado"]; ?></span><br>
            <?php } ?>
        </p>
        <p>
            Estudios:<br>
            <?php foreach ($estudios as $codigo => $texto) { //Bucle que recorre todos los estudios y los muestra en la vista?>
                <label>
                    <input type="checkbox" name="estudios[]" value="<?php echo $codigo; ?>"
                    <?php if (in_array($codigo, $datos["estudios"])) echo "checked"; ?>>
                    <?php echo $codigo . " - " . $texto; ?>
                </label><br>
            <?php } ?>

            <?php if (isset($errores["estudios"])) { ?>
                <span class="error"><?php echo $errores["estudios"]; ?></span><br>
            <?php } ?>
        </p>
        <p>
            <label for="hermanos">Hermanos (0-20):</label>
            <input type="text" id="hermanos" name="hermanos" value="<?php echo $datos["hermanos"]; ?>">
            <?php if (isset($errores["hermanos"])) { ?>
                <span class="error"><?php echo $errores["hermanos"]; ?></span>
            <?php } ?>
        </p>
        <p>
            <label for="sueldo">Sueldo (1000-150000 €):</label>
            <input type="text" id="sueldo" name="sueldo" value="<?php echo $datos["sueldo"]; ?>">
            <?php if (isset($errores["sueldo"])) { ?>
                <span class="error"><?php echo $errores["sueldo"]; ?></span>
            <?php } ?>
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
        <li>Fecha de carnet: <?php echo $datos["diaCarnet"] . "/" . $datos["mesCarnet"] . "/" . $datos["añoCarnet"]; ?></li>
        <li>Hora de levantarse: <?php echo $datos["horaLevantarse"]; ?></li>
        <li>Estado: <?php echo ESTADOS[$datos["estado"]]; ?></li>
        <li>Estudios: <?php echo implode(", ", $textoEstudios); ?></li>
        <li>Hermanos: <?php echo $datos["hermanos"]; ?></li>
        <li>Sueldo: <?php echo number_format($datos["sueldo"], 2, ",", "."); ?> €</li>
    </ul>
    <button><a href="index.php">Volver al formulario</a></button>
<?php
}