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


<div class="sidebar">
<a href="control_asistencias.php"><i class="fa-solid fa-house"></i> Home</a>
<a href="form_agregar_materia.php" style="background-color: white;color: #007bff;"><i class="fa-solid fa-file-circle-plus fa-beat"></i> Agregar una materia</a>
  <a href="form_agregar_alumnos.php"><i class="fa-solid fa-address-book fa-bounce"></i> Agregar alumnos</a>
  <a href="form_asistencias.php"><i class="fa-solid fa-list-check fa-bounce"></i> Revisar asistencias de los alumnos</a>
  <form method="post" action="cerrar_sesion.php">
    <button type="submit" class="buttoncerrarsesion btn btn-danger">Cerrar sesión</button>
  </form>
</div>

<div id="main">
<h2>Agregar materia</h2>
    <form action="agregar_materia.php" method="post">
        <label for="nombre_materia">Nombre de la Materia:</label>
        <input type="text" id="nombre_materia" name="nombre_materia"><br>
        <!--<h5>Solo se puede el 1 solo hay un profesor</h5>
    <label for="id_profesor">ID del Profesor:</label>
    <input type="number" id="id_profesor" name="id_profesor"><br>
    -->
        <input type="submit" value="Agregar Materia">
    </form>
</div>

<button class="openbtn" onclick="toggleNav()">&#9776;</button>

</body>
</html>