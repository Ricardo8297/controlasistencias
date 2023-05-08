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
          session_start();
          $id_profesor = $_SESSION['id_profesor'];
          $query = "SELECT id_materia, nombre_materia FROM materia WHERE id_profesor = $id_profesor";
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

    </div>
</body>
</html>
