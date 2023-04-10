<?php
// Incluye el archivo de conexión a la base de datos
include 'conexion.php';

    // Obtener los valores del formulario
    $nombre_alumno = $_POST['nombre'];
    $matricula_alumno = $_POST['matricula'];
    $correo_alumno = $_POST['correo'];
    $id_materia = $_POST['materia'];

// Insertar el nuevo alumno en la tabla Alumno
$query = "INSERT INTO alumno (nombre_alumno, matricula_alumno, correo_alumno, id_materia) VALUES ('$nombre_alumno', '$matricula_alumno', '$correo_alumno', $id_materia)";
mysqli_query($conexion, $query);

// Obtener las asistencias de la materia
$query = "SELECT * FROM asistencia WHERE id_materia = $id_materia GROUP BY fecha";
$asistencias = mysqli_query($conexion, $query);

// Agregar una asistencia "No asistió" para el nuevo alumno en todas las fechas en las que no haya asistido antes
while ($asistencia = mysqli_fetch_assoc($asistencias)) {
  $fecha = $asistencia['fecha'];

  $query = "SELECT * FROM asistencia WHERE id_alumno = (SELECT id_alumno FROM alumno WHERE nombre_alumno = '$nombre_alumno' AND id_materia = $id_materia) AND fecha = '$fecha'";
  $result = mysqli_query($conexion, $query);

  if (mysqli_num_rows($result) == 0) {
    $query = "INSERT INTO asistencia (fecha, estatus, id_alumno, id_materia) VALUES ('$fecha', 'no asistió', (SELECT id_alumno FROM alumno WHERE nombre_alumno = '$nombre_alumno' AND id_materia = $id_materia), $id_materia)";
    mysqli_query($conexion, $query);
  }
}
    // Cierra la conexión a la base de datos
    mysqli_close($conexion);

?>
