
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
  header('Location: control_asistencias.php'); // Redirigir al formulario para elegir la materia
} else { // Si no se encontró un profesor con esa matrícula y contraseña
  echo "Matrícula o contraseña incorrecta.";
}
?>
