<?php
// Conectamos a la base de datos
include "conexion.php";

// Obtenemos los datos enviados por el formulario
$nombre_materia = $_POST["nombre_materia"];
session_start();
$id_profesor = $_SESSION['id_profesor'];

// Creamos la consulta SQL para verificar si la materia ya existe
$sql_verificar = "SELECT * FROM materia WHERE nombre_materia = '$nombre_materia' AND id_profesor = $id_profesor";
$resultado = mysqli_query($conexion, $sql_verificar);

// Verificamos si se encontraron resultados en la consulta
if (mysqli_num_rows($resultado) > 0) {
    // La materia ya existe, mostramos el mensaje de error
    $_SESSION['form_error_message'] = "La materia ya existe.";
    header('Location: form_agregar_materia.php');
    exit();
} else {
    // La materia no existe, procedemos a insertarla en la base de datos
    $sql_insertar = "INSERT INTO materia (nombre_materia, id_profesor) VALUES ('$nombre_materia', $id_profesor)";

    // Ejecutamos la consulta de inserción
    if (mysqli_query($conexion, $sql_insertar)) {
        $_SESSION['form_error_message'] = "La materia se ha agregado correctamente.";
        header('Location: form_agregar_materia.php');
        exit();
    } else {
        $_SESSION['form_error_message'] = "Error al agregar la materia.";
        header('Location: form_agregar_materia.php');
        exit();
    }
}

// Cerramos la conexión a la base de datos
mysqli_close($conexion);
?>
