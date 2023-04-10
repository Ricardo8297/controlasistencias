<?php
// Conexión a la base de datos
include('conexion.php');

// Obtener los valores enviados por el formulario
$id_materia = $_POST['materia'];
$asistencias = $_POST['asistencia'];

// Obtener la fecha actual
$fecha_actual = date('Y-m-d');

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
}

// Cerrar conexión a la base de datos
mysqli_close($conexion);

// Redirigir al usuario a la página de lista de alumnos
header('Location: lista_alumnos.php?id_materia=' . $id_materia);
?>
