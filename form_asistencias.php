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
  <a href="form_agregar_alumnos.php"><i class="fa-solid fa-address-book fa-bounce" ></i> Agregar alumnos</a>
  <a href="form_asistencias.php" style="background-color: white;color: #007bff;"><i class="fa-solid fa-list-check fa-beat"></i> Revisar asistencias de los alumnos</a>
  <form method="post" action="cerrar_sesion.php">
    <button type="submit" class="buttoncerrarsesion btn btn-danger">Cerrar sesión</button>
  </form>
</div>
<div id="main">
<h2>Asistencias de los alumnos por numero</h2>
    <form action="mostrar_asistencias.php" method="POST">
        <label for="materia">Materia:</label>
        <select name="materia" id="materia">
            <?php
            include "conexion.php";
            //$id_profesor = 1;
            session_start();
            $id_profesor = $_SESSION['id_profesor'];
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
            session_start();
            $id_profesor = $_SESSION['id_profesor'];
            // Obtener la lista de materias
            $query = "SELECT id_materia, nombre_materia FROM materia WHERE id_profesor = $id_profesor";
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
</div>
</body>
</html>