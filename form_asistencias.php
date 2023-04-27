<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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


</body>
</html>