<?php
require "conexion.php";

// Obtener el ID de la materia
$id_materia = $_POST['id_materia'];
session_start();
// Obtener las asistencias de la materia
$query = "SELECT asistencia.*, alumno.nombre_alumno FROM asistencia INNER JOIN alumno ON asistencia.id_alumno = alumno.id_alumno WHERE alumno.id_materia = $id_materia ORDER BY asistencia.fecha ASC, alumno.nombre_alumno ASC";
$asistencias = mysqli_query($conexion, $query);

// Obtener las fechas únicas de las asistencias
$fechas = array();
while ($asistencia = mysqli_fetch_assoc($asistencias)) {
  $fecha = $asistencia['fecha'];
  if (!in_array($fecha, $fechas)) {
    $fechas[] = $fecha;
  }
}

// Obtener los alumnos de la materia
$query = "SELECT * FROM alumno WHERE id_materia = $id_materia ORDER BY nombre_alumno ASC";
$alumnos = mysqli_query($conexion, $query);

// Actualizar las asistencias modificadas
while ($alumno = mysqli_fetch_assoc($alumnos)) { // Iterar por los alumnos
  $id_alumno = $alumno['id_alumno'];
  foreach ($fechas as $fecha) { // Iterar por las fechas
    $estatus = isset($_POST['asistencia'][$id_alumno][$fecha]) ? 'presente' : 'no asistió'; // Obtener el estatus de la asistencia
    $query = "SELECT * FROM asistencia WHERE id_alumno = $id_alumno AND fecha = '$fecha'";
    $result = mysqli_query($conexion, $query);
    if (mysqli_num_rows($result) > 0) { // Si hay una asistencia para la fecha y el alumno
      $query = "UPDATE asistencia SET estatus = '$estatus' WHERE id_alumno = $id_alumno AND fecha = '$fecha'";
      mysqli_query($conexion, $query);
    } else { // Si no hay una asistencia para la fecha y el alumno
      $query = "INSERT INTO asistencia (fecha, estatus, id_alumno, id_materia) VALUES ('$fecha', '$estatus', $id_alumno, $id_materia)";
      mysqli_query($conexion, $query);
    }
  }
}
$_SESSION['form_error_message'] = "Asistencias actualizadas correctamente.";
header('Location: control_asistencias.php');
exit();
// Redirigir de regreso a la página de asistencias
//header("Location: asistencias.php?id_materia=$id_materia");
?>