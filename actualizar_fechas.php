<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets\dist\bootstrap-5.3.0-alpha3-dist\css\bootstrap.rtl.min.css" rel="stylesheet">
    <link href="css\siderbarazul.css" rel="stylesheet">
    <script src="css\sidebarazul.js"></script>
  <script src="assets\dist\bootstrap-5.3.0-alpha3-dist\js\popper.min.js"></script>
  <script src="assets\dist\bootstrap-5.3.0-alpha3-dist\js\bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/96673f889c.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<button class="openbtn btn" onclick="toggleNav()">&#9776;</button>
<div class="sidebar">
<a href="control_asistencias.php" style="background-color: white;color: #007bff;"><i class="fa-solid fa-house"></i> Home</a>
  <a href="form_agregar_materia.php"><i class="fa-solid fa-file-circle-plus fa-bounce"></i> Agregar una materia</a>
  <a href="form_agregar_alumnos.php"><i class="fa-solid fa-address-book fa-bounce"></i> Agregar alumnos</a>
  <a href="form_asistencias.php"><i class="fa-solid fa-list-check fa-bounce"></i> Revisar asistencias de los alumnos</a>
  <form method="post" action="cerrar_sesion.php">
    <button type="submit" class="buttoncerrarsesion btn btn-danger">Cerrar sesión</button>
  </form>
</div>
<div id="main">
<?php
// Conectar a la base de datos
include "conexion.php";

// Obtener el ID de la materia
$id_materia = $_POST['id_materia'];

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
echo "<form method='post' action='guardar_actualizar_fechas.php'>"; // Formulario para guardar las asistencias modificadas
echo "<input type='hidden' name='id_materia' value='$id_materia'>"; // Campo oculto para enviar el ID de la materia
echo "<table>"; // Iniciar la tabla
echo "<thead><tr><th>Alumno</th>"; // Crear la fila de encabezado de la tabla
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
      $checked = $estatus == 'presente' ? 'checked' : ''; // Marcar el checkbox si la asistencia está como "Presente"
    } else { // Si no hay una asistencia para la fecha y el alumno
      $checked = ''; // Dejar el checkbox sin marcar
    }
    echo "<td><input type='checkbox' name='asistencia[$id_alumno][$fecha]' value='presente' $checked></td>"; // Agregar el checkbox a la fila
  }
  echo "</tr>";
}
echo "</tbody>";
echo "</table>"; // Cerrar la tabla
echo "<button type='submit' class='btn btn-primary'>Guardar asistencias</button>"; // Botón para guardar las asistencias modificadas
echo "</form>";
?>
</div>
</body>
</html>