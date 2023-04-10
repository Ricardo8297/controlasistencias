<?php
// Conectar a la base de datos
require "conexion.php";

// Obtener los valores del formulario
$id_materia = $_POST['materia'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

// Obtener la lista de alumnos de la materia
$query = "SELECT * FROM alumno WHERE id_materia = $id_materia";
$resultado = mysqli_query($conexion, $query);

// Mostrar la tabla de asistencias
echo "<table>";
echo "<thead>";
echo "<tr>";
echo "<th>Nombre del alumno</th>";
echo "<th>Asistencias</th>";
echo "<th>Ausencias</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
while ($fila = mysqli_fetch_assoc($resultado)) {
  $id_alumno = $fila['id_alumno'];
  $nombre_alumno = $fila['nombre_alumno'];

  // Obtener las asistencias del alumno en la materia y entre las fechas seleccionadas
  $query = "SELECT * FROM asistencia WHERE id_alumno = $id_alumno AND id_materia = $id_materia AND fecha >= '$fecha_inicio' AND fecha <= '$fecha_fin'";
  $asistencias = mysqli_query($conexion, $query);

  // Contar las asistencias y las ausencias del alumno
  $asistencias_count = 0;
  $ausencias_count = 0;
  while ($asistencia = mysqli_fetch_assoc($asistencias)) {
    if ($asistencia['estatus'] == "presente") {
      $asistencias_count++;
    } else {
      $ausencias_count++;
    }
  }

  echo "<tr>";
  echo "<td>$nombre_alumno</td>";
  echo "<td>$asistencias_count</td>";
  echo "<td>$ausencias_count</td>";
  echo "</tr>";
}
echo "</tbody>";
echo "</table>";
?>
