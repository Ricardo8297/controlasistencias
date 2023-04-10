<?php
// Incluye el archivo de conexión a la base de datos
include 'conexion.php';

// Obtener los valores del formulario
$id_materia = $_POST['materia'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

// Obtener la lista de alumnos de la materia
$query = "SELECT * FROM alumno WHERE id_materia = $id_materia";
$resultado = mysqli_query($conexion, $query);

// Obtener la lista de fechas de asistencia de la materia y entre las fechas seleccionadas
$query_fechas = "SELECT DISTINCT fecha FROM asistencia WHERE id_materia = $id_materia AND fecha >= '$fecha_inicio' AND fecha <= '$fecha_fin'";
$resultado_fechas = mysqli_query($conexion, $query_fechas);
$fechas = array();
while ($fila_fecha = mysqli_fetch_assoc($resultado_fechas)) {
  $fechas[] = $fila_fecha['fecha'];
}

// Mostrar la tabla de asistencias
echo "<table>";
echo "<thead>";
echo "<tr>";
echo "<th>Nombre del alumno</th>";
foreach ($fechas as $fecha) {
  echo "<th>$fecha</th>";
}
echo "</tr>";
echo "</thead>";
echo "<tbody>";
while ($fila = mysqli_fetch_assoc($resultado)) {
  $id_alumno = $fila['id_alumno'];
  $nombre_alumno = $fila['nombre_alumno'];

  echo "<tr>";
  echo "<td>$nombre_alumno</td>";
  foreach ($fechas as $fecha) {
    // Obtener el estatus de la asistencia del alumno en la fecha
    $query_asistencia = "SELECT * FROM asistencia WHERE id_alumno = $id_alumno AND id_materia = $id_materia AND fecha = '$fecha'";
    $resultado_asistencia = mysqli_query($conexion, $query_asistencia);
    if ($fila_asistencia = mysqli_fetch_assoc($resultado_asistencia)) {
      $estatus = $fila_asistencia['estatus'];
    } else {
      $estatus = "";
    }
    echo "<td>$estatus</td>";
  }
  echo "</tr>";
}
echo "</tbody>";
echo "</table>";

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>
