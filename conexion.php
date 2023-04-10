<?php
// Datos para la conexión a la base de datos
$servidor = "localhost";
$usuario = "Ricardo";
$password = "123";
$base_de_datos = "control_de_asistencias";

// Creamos la conexión a la base de datos
$conexion = mysqli_connect($servidor, $usuario, $password, $base_de_datos);

// Verificamos si la conexión fue exitosa
if (!$conexion) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}
?>
