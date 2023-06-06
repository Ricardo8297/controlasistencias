<?php
// Conectar a la base de datos
include "conexion.php";
// Obtener los datos del formulario
$matricula = $_POST['matricula'];
$contrasena = $_POST['contrasena'];

// Consultar la tabla de profesores
$query = "SELECT * FROM profesor WHERE matricula = '$matricula' AND contraseña = '$contrasena'";
$resultado = mysqli_query($conexion, $query);

if (mysqli_num_rows($resultado) > 0) { // Si se encontró un profesor con esa matrícula y contraseña
    $profesor = mysqli_fetch_assoc($resultado);
    session_start(); // Iniciar sesión
    $_SESSION['id_profesor'] = $profesor['id_profesor']; // Guardar el ID del profesor en la sesión
    
    // Consultar el nombre del profesor
    $query_nombre = "SELECT nombre_profesor FROM profesor WHERE id_profesor = '" . $profesor['id_profesor'] . "'";
    $resultado_nombre = mysqli_query($conexion, $query_nombre);
    $nombre_profesor = mysqli_fetch_assoc($resultado_nombre)['nombre_profesor'];
    $_SESSION['nombre_profesor'] = $nombre_profesor; // Guardar el nombre del profesor en la sesión

    header('Location: control_asistencias.php'); // Redirigir al formulario para elegir la materia
} else { // Si no se encontró un profesor con esa matrícula y contraseña
    session_start();
    $_SESSION['form_error_message'] = "Matricula o contraseña incorrecta.";
    header('Location: index.php');
    exit();
}

mysqli_close($conexion);
?>
