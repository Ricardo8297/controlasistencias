<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
</body>
</html>