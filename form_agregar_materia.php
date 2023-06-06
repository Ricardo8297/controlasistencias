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
<?php if (!empty($error_message)): ?>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center">Agregar materia</h2>
                    <form action="agregar_materia.php" method="post">
                        <div class="form-group">
                            <label for="nombre_materia">Nombre de la Materia:</label>
                            <input type="text" id="nombre_materia" name="nombre_materia" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Ingresa solo letras" class="form-control" required>
                        </div>
                        <div class="text-center">
                            <input type="submit" value="Agregar Materia" class="btn btn-info mt-5">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<button class="openbtn" onclick="toggleNav()">&#9776;</button>

</body>
</html>