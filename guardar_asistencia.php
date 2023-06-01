<?php
// Conexión a la base de datos
include('conexion.php');

// Obtener los valores enviados por el formulario
$id_materia = $_POST['materia'];
$asistencias = $_POST['asistencia'];
date_default_timezone_set('America/Mexico_City');
// Obtener la fecha actual
$fecha_actual = date('Y-m-d');
session_start();
if (!empty($id_materia) && !empty($asistencias)) {
// Consultar la lista de alumnos de la materia seleccionada
$query = "SELECT id_alumno FROM alumno WHERE id_materia = $id_materia";
$resultado = mysqli_query($conexion, $query);

// Crear un array con los ID de los alumnos
$id_alumnos = array();
while ($fila = mysqli_fetch_assoc($resultado)) {
    $id_alumnos[] = $fila['id_alumno'];
}

// Recorrer todos los alumnos y guardar su asistencia en la base de datos
foreach ($id_alumnos as $id_alumno) {
    // Verificar si el alumno asistió o no
    if (in_array($id_alumno, $asistencias)) {
        $estatus = 'presente';
    } else {
        $estatus = 'no asistió';
    }
    
    // Insertar la asistencia del alumno en la base de datos
    $query = "INSERT INTO asistencia (fecha, id_alumno, id_materia, estatus) VALUES ('$fecha_actual', $id_alumno, $id_materia, '$estatus')";
    mysqli_query($conexion, $query);
    $_SESSION['form_error_message'] = "Asistencia tomada.";
    header('Location: control_asistencias.php');
    exit();
}
} else {
    // Alguno de los campos está vacío
    $_SESSION['form_error_message'] = "No puede pasar asistencia si no hubo nadie.";
    header('Location: control_asistencias.php');
    exit();
}
// Cerrar conexión a la base de datos
mysqli_close($conexion);

// Redirigir al usuario a la página de lista de alumnos
?>
