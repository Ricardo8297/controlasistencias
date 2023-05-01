<?php
// Conectar a la base de datos
require "conexion.php";

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$matricula = $_POST['matricula'];
$contrasena_hash = $_POST['contrasena'];

// Encriptar la contraseña utilizando password_hash()
//$contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

// Insertar los datos del profesor en la tabla
$query = "INSERT INTO profesor (nombre_profesor, matricula, contraseña) VALUES ('$nombre', '$matricula', '$contrasena_hash')";
$resultado = mysqli_query($conexion, $query);

if ($resultado) { // Si se insertaron los datos correctamente
  echo "Registro exitoso.";
} else { // Si ocurrió un error al insertar los datos
  echo "Error al registrar.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
