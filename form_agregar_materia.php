<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
</body>
</html>