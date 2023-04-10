<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Version de prueba control de asitencias "Solo Existe el Profesor Juan Perez con ID 1"</h1>    

<h2>Agregar materia</h2>
<form action="agregar_materia.php" method="post">
    <label for="nombre_materia">Nombre de la Materia:</label>
    <input type="text" id="nombre_materia" name="nombre_materia"><br>
    <h5>Solo se puede el 1 solo hay un profesor</h5>
    <label for="id_profesor">ID del Profesor:</label>
    <input type="number" id="id_profesor" name="id_profesor"><br>

    <input type="submit" value="Agregar Materia">
</form>


<h2>Agregar Alumno a  una Materia</h2>
    <form action="agregar_alumno.php" method="POST">
      <label for="nombre">Nombre del Alumno:</label>
      <input type="text" id="nombre" name="nombre" required><br>

      <label for="matricula">Matrícula del Alumno:</label>
      <input type="text" id="matricula" name="matricula" required><br>

      <label for="correo">Correo del Alumno:</label>
      <input type="email" id="correo" name="correo" required><br>

      <label for="materia">Materia:</label>
      <select id="materia" name="materia" required>
        <?php
          // Obtener las materias existentes en la base de datos
          require "conexion.php";
          $query = "SELECT id_materia, nombre_materia FROM materia";
          $result = mysqli_query($conexion, $query);

          // Mostrar cada materia en una opción del select
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['id_materia'] . '">' . $row['nombre_materia'] . '</option>';
          }

          // Cerrar la conexión a la base de datos
          mysqli_close($conexion);
        ?>
      </select><br>

      <input type="submit" value="Agregar">
    </form>




<h2>Registrar la asitencia de hoy</h2>
<body>
	<form method="POST" action="registrar_asistencia.php">
		<label for="materia">Selecciona una materia:</label>
		<select name="materia" id="materia">
			<option value="">Selecciona una materia</option>
			<?php
				// Conexión a la base de datos
				include "conexion.php";

				// Consulta para obtener las materias del profesor logueado
				$id_profesor = 1;
				$query = "SELECT id_materia, nombre_materia FROM materia WHERE id_profesor = $id_profesor";
				$resultado = mysqli_query($conexion, $query);

				// Mostrar opciones en el select
				while ($fila = mysqli_fetch_assoc($resultado)) {
					echo "<option value='" . $fila['id_materia'] . "'>" . $fila['nombre_materia'] . "</option>";
				}

				// Cerrar conexión a la base de datos
				mysqli_close($conexion);
			?>
		</select>
		<button type="submit">Continuar</button>
	</form>
<h2>Asistencias de los alumnos por numero</h2>
<form action="mostrar_asistencias.php" method="POST">
  <label for="materia">Materia:</label>
  <select name="materia" id="materia">
    <?php
    // Obtener la lista de materias del profesor actual
    //$id_profesor = $_SESSION['id_profesor'];
    include "conexion.php";
    $id_profesor = 1;
    $query = "SELECT * FROM materia WHERE id_profesor = $id_profesor";
    $resultado = mysqli_query($conexion, $query);
    
    // Crear las opciones del select
    while ($fila = mysqli_fetch_assoc($resultado)) {
      echo "<option value='" . $fila['id_materia'] . "'>" . $fila['nombre_materia'] . "</option>";
    }
    ?>
  </select>

  <br>

  <label for="fecha_inicio">Fecha de inicio:</label>
  <input type="date" name="fecha_inicio" id="fecha_inicio">

  <br>

  <label for="fecha_fin">Fecha de fin:</label>
  <input type="date" name="fecha_fin" id="fecha_fin">

  <br>

  <input type="submit" value="Mostrar asistencias">
</form>

<h2>Asistencias de los alumnos por fechas</h2>
	<form method="POST" action="lista_asistencias.php">
		<label for="materia">Materia:</label>
		<select name="materia" id="materia">
			<?php
			// Conectar a la base de datos
			require 'conexion.php';

			// Obtener la lista de materias
			$query = "SELECT id_materia, nombre_materia FROM materia";
			$resultado = mysqli_query($conexion, $query);

			// Mostrar las opciones en el select
			while ($fila = mysqli_fetch_assoc($resultado)) {
				echo "<option value=\"{$fila['id_materia']}\">{$fila['nombre_materia']}</option>";
			}

			// Cerrar la conexión a la base de datos
			mysqli_close($conexion);
			?>
		</select>
		<br>
		<label for="fecha_inicio">Fecha de inicio:</label>
		<input type="date" name="fecha_inicio" id="fecha_inicio">
		<br>
		<label for="fecha_fin">Fecha de fin:</label>
		<input type="date" name="fecha_fin" id="fecha_fin">
		<br>
		<input type="submit" value="Consultar">
	</form>


    <h2>Modificar las asistencias</h2>
  <form action="actualizar_fechas.php" method="post">
    <label for="materia">Selecciona la materia:</label>
    <select name="id_materia" id="id_materia">
      <?php
        // Conectar a la base de datos
        require 'conexion.php';

        // Obtener la lista de materias
        $query = "SELECT * FROM materia";
        $resultado = mysqli_query($conexion, $query);

        // Mostrar las opciones en el select
        while ($fila = mysqli_fetch_assoc($resultado)) {
          echo "<option value='" . $fila['id_materia'] . "'>" . $fila['nombre_materia'] . "</option>";
        }
      ?>
    </select>
    <br>
    <input type="submit" value="Consultar">
  </form>

</body>
</html>