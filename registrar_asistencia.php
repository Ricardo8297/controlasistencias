<?php
session_start();

// Verificar si hay un mensaje de error almacenado en $_SESSION
$error_message = isset($_SESSION['form_error_message']) ? $_SESSION['form_error_message'] : "";
unset($_SESSION['form_error_message']); // Limpiar el mensaje de error de $_SESSION
?>
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
<a href="control_asistencias.php" ><i class="fa-solid fa-house"></i> Home</a>
  <a href="form_agregar_materia.php"><i class="fa-solid fa-file-circle-plus fa-bounce"></i> Agregar una materia</a>
  <a href="form_agregar_alumnos.php" style="background-color: white;color: #007bff;"><i class="fa-solid fa-address-book fa-beat" ></i> Agregar alumnos</a>
  <a href="form_asistencias.php"><i class="fa-solid fa-list-check fa-bounce"></i> Revisar asistencias de los alumnos</a>
  <form method="post" action="cerrar_sesion.php">
    <button type="submit" class="buttoncerrarsesion btn btn-danger">Cerrar sesión</button>
  </form>
</div>
<div id="main">
	
	<?php if (!empty($error_message)): ?>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>
	<?php
// Incluye el archivo de conexión a la base de datos
include 'conexion.php';

// Obtén la fecha actual
$fecha_actual = date('Y-m-d');

// Obtén el valor seleccionado del formulario
$id_materia = $_POST['materia'];

// Verifica si ya se ha tomado asistencia para esta materia hoy
$query = "SELECT * FROM asistencia WHERE id_materia = $id_materia AND fecha = '$fecha_actual'";
$resultado = mysqli_query($conexion, $query);

if (mysqli_num_rows($resultado) > 0) {
    // Ya se ha tomado asistencia para esta materia hoy
    echo "Ya se ha tomado asistencia para esta materia hoy.";
	echo "<br><a href='control_asistencias.php' class='btn btn-primary'>Regresar</a>";
} else {
    // Mostrar el formulario normalmente
    ?>
	<form method="POST" action="guardar_asistencia.php">
		<h2>Lista de alumnos:</h2>
		<table>
			<thead>
				<tr>
					<th>Nombre del alumno</th>
					<th>Asistencia</th>
				</tr>
			</thead>
			<tbody>
				<?php
					// Conexión a la base de datos
					include('conexion.php');

					// Obtener el id_materia seleccionado en el formulario anterior
					$id_materia = $_POST['materia'];

					// Consulta para obtener los alumnos de la materia seleccionada
					$query = "SELECT id_alumno, nombre_alumno FROM alumno WHERE id_materia = $id_materia";
					$resultado = mysqli_query($conexion, $query);
					
					// Mostrar una fila por cada alumno, con un checkbox para indicar su asistencia
					while ($fila = mysqli_fetch_assoc($resultado)) {
						echo "<tr>";
						echo "<td>" . $fila['nombre_alumno'] . "</td>";
						echo "<td><input type='checkbox' name='asistencia[]' value='" . $fila['id_alumno'] . "'></td>";
						echo "</tr>";
					}

					// Cerrar conexión a la base de datos
					mysqli_close($conexion);
				?>
			</tbody>
		</table>
		<input type="hidden" name="materia" value="<?php echo $id_materia; ?>">
		<button type="submit">Guardar</button>
	</form>
    <?php
}


?>
    </div>
</body>
</html>

