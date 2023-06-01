<?php
// Conectar a la base de datos
require "conexion.php";

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$matricula = $_POST['matricula'];
$contrasena_hash = $_POST['contrasena'];
session_start();
// Encriptar la contraseña utilizando password_hash()
//$contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
$sql_verificar = "SELECT * FROM profesor WHERE matricula = '$matricula'";
$resultado = mysqli_query($conexion, $sql_verificar);

// Verificamos si se encontraron resultados en la consulta
if (mysqli_num_rows($resultado) > 0) {
    // La materia ya existe, mostramos el mensaje de error
    $_SESSION['form_error_message'] = "La matricula ya existe revise porfavor.";
    header('Location: registro_form.php');
    exit();
} else {
  // Insertar los datos del profesor en la tabla
  $query = "INSERT INTO profesor (nombre_profesor, matricula, contraseña) VALUES ('$nombre', '$matricula', '$contrasena_hash')";
  $resultado = mysqli_query($conexion, $query);

  if ($resultado) { // Si se insertaron los datos correctamente
    $_SESSION['form_error_message'] = "Registro exitoso";
    header('Location: index.php');
    exit();
  } else { // Si ocurrió un error al insertar los datos
    $_SESSION['form_error_message'] = "Error al registrar";
    header('Location: registro_form.php');
    exit();
  }
}
// Cerrar la conexión a la base de datos
mysqli_close($conexion);

?>
