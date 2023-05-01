<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Registro de profesor</h1>
  <form action="guardar_profesor.php" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required><br><br>
    <label for="matricula">Matrícula:</label>
    <input type="text" name="matricula" id="matricula" required><br><br>
    <label for="contrasena">Contraseña:</label>
    <input type="password" name="contrasena" id="contrasena" required><br><br>
    <input type="submit" value="Registrar">
  </form>
</body>
</html>