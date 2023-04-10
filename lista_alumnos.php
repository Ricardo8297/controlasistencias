<!DOCTYPE html>
<html>
<head>
	<title>Lista de alumnos</title>
</head>
<body>
<?php
    // Conexión a la base de datos
	include('conexion.php');
    $fecha_actual = date('Y-m-d');
    $id_materia = $_GET['id_materia'];
    $query = "SELECT alumno.nombre_alumno, asistencia.estatus
    FROM alumno
    LEFT JOIN asistencia ON alumno.id_alumno = asistencia.id_alumno
    WHERE alumno.id_materia = $id_materia
    AND asistencia.fecha = '$fecha_actual'";
    $resultado = mysqli_query($conexion, $query);
?>
	<h2>Lista de alumnos</h2>
<table>
  <thead>
    <tr>
      <th>Nombre del alumno</th>
      <th>Asistencia de hoy</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($fila = mysqli_fetch_assoc($resultado)) {
      echo "<tr>";
      echo "<td>" . $fila['nombre_alumno'] . "</td>";
      echo "<td>" . $fila['estatus'] . "</td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>
	
</body>
</html>
