<?php
// Conectar a la base de datos
require "conexion.php";

// Obtener el ID de la materia
$id_materia = $_GET['id_materia'];

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

// Crear la tabla de asistencias
echo "<table>";
echo "<thead><tr><th>Alumno</th>";
foreach ($fechas as $fecha) { // Iterar por las fechas
  echo "<th>$fecha</th>"; // Agregar la fecha a la fila de encabezado
}
echo "</tr></thead>";
echo "<tbody>";
while ($alumno = mysqli_fetch_assoc($alumnos)) { // Iterar por los alumnos
  $id_alumno = $alumno['id_alumno'];
  $nombre_alumno = $alumno['nombre_alumno'];
  echo "<tr><td>$nombre_alumno</td>"; // Agregar el nombre del alumno a la fila
  foreach ($fechas as $fecha) { // Iterar por las fechas
    $query = "SELECT * FROM asistencia WHERE id_alumno = $id_alumno AND fecha = '$fecha'";
    $result = mysqli_query($conexion, $query);
    if (mysqli_num_rows($result) > 0) { // Si hay una asistencia para la fecha y el alumno
      $asistencia = mysqli_fetch_assoc($result);
      $estatus = $asistencia['estatus'];
    } else { // Si no hay una asistencia para la fecha y el alumno
      $estatus = ''; // Dejar el estatus vacío
    }
    echo "<td>$estatus</td>"; // Agregar el estatus a la fila
  }
  echo "</tr>";
}
echo "</tbody>";
echo "</table>"; // Cerrar la tabla
?>
