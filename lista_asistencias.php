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

// Crear un arreglo con los datos de asistencia de los alumnos
$datos_asistencia = array();
while ($fila = mysqli_fetch_assoc($resultado)) {
  $id_alumno = $fila['id_alumno'];
  $nombre_alumno = $fila['nombre_alumno'];
  $asistencias = array();
  foreach ($fechas as $fecha) {
    // Obtener el estatus de la asistencia del alumno en la fecha
    $query_asistencia = "SELECT * FROM asistencia WHERE id_alumno = $id_alumno AND id_materia = $id_materia AND fecha = '$fecha'";
    $resultado_asistencia = mysqli_query($conexion, $query_asistencia);
    if ($fila_asistencia = mysqli_fetch_assoc($resultado_asistencia)) {
      $estatus = $fila_asistencia['estatus'];
    } else {
      $estatus = "";
    }
    $asistencias[] = $estatus;
  }
  $datos_asistencia[] = array(
    "nombre" => $nombre_alumno,
    "asistencias" => $asistencias
  );
}
$asistencias = array();
foreach ($fechas as $fecha) {
  $query_asistencias = "SELECT COUNT(*) AS num_asistencias FROM asistencia WHERE id_materia = $id_materia AND fecha = '$fecha' AND estatus = 'presente'";
  //$query_asistencias = "SELECT COUNT(*) AS num_asistencias FROM asistencia WHERE id_materia = $id_materia AND fecha BETWEEN '$fecha_inicio' AND '$fecha_fin' AND estatus = 'presente'";
  $resultado_asistencias = mysqli_query($conexion, $query_asistencias);
  $fila_asistencias = mysqli_fetch_assoc($resultado_asistencias);
  $num_asistencias = $fila_asistencias['num_asistencias'];
  $asistencias[] = $num_asistencias;
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>

<!-- Mostrar la tabla de asistencias -->
<table>
  <thead>
    <tr>
      <th>Nombre del alumno</th>
      <?php foreach ($fechas as $fecha) { ?>
        <th><?php echo $fecha; ?></th>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($datos_asistencia as $datos_alumno) { ?>
      <tr>
        <td><?php echo $datos_alumno["nombre"]; ?></td>
        <?php foreach ($datos_alumno["asistencias"] as $asistencia) { ?>
          <td><?php echo $asistencia; ?></td>
        <?php } ?>
      </tr>
    <?php } ?>
  </tbody>
</table>

<canvas id="grafica-asistencias"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  var ctx = document.getElementById('grafica-asistencias').getContext('2d');
  var chart = new Chart(ctx, {
    animationEnabled: true,
   exportEnabled: true,
    type: 'bar',
    data: {
      labels: <?php echo json_encode($fechas); ?>,
      datasets: [
        {
          label: 'Asistencias',
          backgroundColor: 'rgba(54, 162, 235, 0.5)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1,
          data: <?php echo json_encode($asistencias); ?>,
        }
      ]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            stepSize: 1
          }
        }]
      },
      legend: {
        display: false
      }
    }
  });
</script>
