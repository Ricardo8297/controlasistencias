<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="form_agregar_materia.php">
        <button>Agregar una materia</button>
    </a>

    <a href="form_agregar_alumnos.php">
        <button>Agregar Alumnos</button>
    </a>
    <a href="form_asistencias.php">
        <button>Revisar las asistencias de los alumnos </button>
    </a>

    <h2>Registrar la asitencia de hoy</h2>


    <form method="POST" action="registrar_asistencia.php">
        <label for="materia">Selecciona una materia:</label>
        <select name="materia" id="materia">
            <option value="">Selecciona una materia</option>
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
        <button type="submit">Continuar</button>
    </form>

    <h2>Modificar las asistencias</h2>
    <form action="actualizar_fechas.php" method="post">
        <label for="materia">Selecciona la materia:</label>
        <select name="id_materia" id="id_materia">
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
        <br>
        <input type="submit" value="Consultar">
    </form>
    <br>
    <br>

    <form method="post" action="cerrar_sesion.php">
        <button type="submit">Cerrar sesión</button>
    </form>


</body>

</html>