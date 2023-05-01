<?php
// Datos para la conexión a la base de datos
$servidor = "containers-us-west-138.railway.app";
$usuario = "root";
$password = "vhLqwnvYX1wZIvimSfBQ";
$base_de_datos = "railway";

// Creamos la conexión a la base de datos
$conexion = mysqli_connect($servidor, $usuario, $password, $base_de_datos);

// Verificamos si la conexión fue exitosa
if (!$conexion) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}
?>
