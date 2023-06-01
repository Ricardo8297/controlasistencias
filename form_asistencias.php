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
<div id="main" class="mb-5 text-center card">
<h2 class="mb-3">Asistencias de los alumnos</h2>
<form action="mostrar_asistencias.php" method="POST">
    <label for="materia" class="mb-3">Materia:</label>
    <br>
    <select name="materia" id="materia" class="mb-3">
        <?php
        include "conexion.php";
        session_start();
        $id_profesor = $_SESSION['id_profesor'];
        $query = "SELECT * FROM materia WHERE id_profesor = $id_profesor";
        $resultado = mysqli_query($conexion, $query);

        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<option value='" . $fila['id_materia'] . "'>" . $fila['nombre_materia'] . "</option>";
        }
        ?>
    </select>

    <br>

    <label for="fecha_inicio" class="mb-3">Fecha de inicio:</label>
    <br>
    <input type="date" name="fecha_inicio" id="fecha_inicio" value="2023-01-01" class="mb-3">

    <br>

    <label for="fecha_fin" class="mb-3">Fecha de fin:</label>
    <br>
    <input type="date" name="fecha_fin" id="fecha_fin" value="2023-12-31" class="mb-3">

    <br>

    <input type="submit" name="mostrar_asistencias" value="Mostrar asistencias personalizadas" class="btn btn-info">
    <br>
    <input type="submit" name="parcial_1" value="Parcial 1" class="btn btn-success mt-5">
    <input type="submit" name="parcial_2" value="Parcial 2" class="btn btn-success mt-5">
    <input type="submit" name="parcial_3" value="Parcial 3" class="btn btn-success mt-5">
</form>

</div>
</body>
</html>