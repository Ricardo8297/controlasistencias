<?php
// Conectamos a la base de datos
include "conexion.php";
// Obtenemos los datos enviados por el formulario
$nombre_materia = $_POST["nombre_materia"];
$id_profesor = $_POST["id_profesor"];

// Creamos la consulta SQL para agregar la nueva materia
$sql = "INSERT INTO materia (nombre_materia, id_profesor) VALUES ('$nombre_materia', $id_profesor)";

// Ejecutamos la consulta
if (mysqli_query($conexion, $sql)) {
    echo "La materia se ha agregado correctamente";
} else {
    echo "Error al agregar la materia: " . mysqli_error($conexion);
}

// Cerramos la conexión a la base de datos
mysqli_close($conexion);
?>
