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
<a href="control_asistencias.php" style="background-color: white;color: #007bff;"><i class="fa-solid fa-house"></i> Home</a>
  <a href="form_agregar_materia.php"><i class="fa-solid fa-file-circle-plus fa-bounce"></i> Agregar una materia</a>
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

<div class="container">
<div class="row">
        <div class="col-md-12 mb-5" >
            <h2 class="text-center  fs-1 text mb-5 fst-italic">Bienvenid@ <?php echo $_SESSION['nombre_profesor']; ?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title mb-5">Pasar lista</h2>
                    <form method="POST" action="registrar_asistencia.php">
                        <div class="form-group">
                            <label for="materia">Selecciona una materia</label>
                            <select name="materia" id="materia" class="form-control">
                                <?php
                                // Conexión a la base de datos
                                include "conexion.php";

                                // Consulta para obtener las materias del profesor logueado
                                session_start();
                                $id_profesor = $_SESSION['id_profesor'];
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
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-info mt-5">Continuar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title mb-5">Modificar las asistencias</h2>
                    <form action="actualizar_fechas.php" method="post">
                        <div class="form-group">
                            <label for="materia">Selecciona la materia:</label>
                            <select name="id_materia" id="id_materia" class="form-control">
                                <?php
                                // Conectar a la base de datos
                                require 'conexion.php';

                                // Obtener la lista de materias
                                session_start();
                                $id_profesor = $_SESSION['id_profesor'];
                                $query = "SELECT * FROM materia WHERE id_profesor = $id_profesor";
                                $resultado = mysqli_query($conexion, $query);

                                // Mostrar las opciones en el select
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    echo "<option value='" . $fila['id_materia'] . "'>" . $fila['nombre_materia'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="text-center">
                            <input type="submit" value="Consultar" class="btn btn-info mt-5">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

</body>

</html>