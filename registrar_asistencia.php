<!DOCTYPE html>
<html>
<head>
	<title>Registrar asistencia</title>
</head>
<body>
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
</body>
</html>
