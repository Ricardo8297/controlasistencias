<?php
// Incluye el archivo de conexión a la base de datos
include 'conexion.php';

// Obtener los valores del formulario
$nombre_alumno = $_POST['nombre'];
$matricula_alumno = $_POST['matricula'];
$correo_alumno = $_POST['correo'];
$id_materia = $_POST['materia'];
session_start();
// Verificar si el alumno ya está registrado en la materia
$query_verificar = "SELECT * FROM alumno WHERE matricula_alumno = '$matricula_alumno' AND id_materia = $id_materia";
$resultado_verificar = mysqli_query($conexion, $query_verificar);

if (mysqli_num_rows($resultado_verificar) > 0) {
  // El alumno ya está registrado en la materia
  $_SESSION['form_error_message'] = "El alumno ya está registrado en esta materia.";
    header('Location: form_agregar_alumnos.php');
    exit();
} else {
  // Insertar el nuevo alumno en la tabla Alumno
  $query_insertar = "INSERT INTO alumno (nombre_alumno, matricula_alumno, correo_alumno, id_materia) VALUES ('$nombre_alumno', '$matricula_alumno', '$correo_alumno', $id_materia)";
  mysqli_query($conexion, $query_insertar);

  // Obtener las asistencias de la materia
  $query_asistencias = "SELECT * FROM asistencia WHERE id_materia = $id_materia GROUP BY fecha";
  $asistencias = mysqli_query($conexion, $query_asistencias);

  // Agregar una asistencia "No asistió" para el nuevo alumno en todas las fechas en las que no haya asistido antes
  while ($asistencia = mysqli_fetch_assoc($asistencias)) {
    $fecha = $asistencia['fecha'];

    $query_asistencia_existente = "SELECT * FROM asistencia WHERE id_alumno = (SELECT id_alumno FROM alumno WHERE matricula_alumno = '$matricula_alumno' AND id_materia = $id_materia) AND fecha = '$fecha'";
    $resultado_asistencia_existente = mysqli_query($conexion, $query_asistencia_existente);

    if (mysqli_num_rows($resultado_asistencia_existente) == 0) {
      $query_insertar_asistencia = "INSERT INTO asistencia (fecha, estatus, id_alumno, id_materia) VALUES ('$fecha', 'no asistió', (SELECT id_alumno FROM alumno WHERE matricula_alumno = '$matricula_alumno' AND id_materia = $id_materia), $id_materia)";
      mysqli_query($conexion, $query_insertar_asistencia);
    }
    $_SESSION['form_error_message'] = "Registro exitoso.";
    header('Location: form_agregar_alumnos.php');
    exit();
  }

  // Cierra la conexión a la base de datos
  mysqli_close($conexion);

  header('Location: control_asistencias.php');
}

?>
