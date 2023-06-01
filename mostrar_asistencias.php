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
<?php
// Conectar a la base de datos
require "conexion.php";
if (isset($_POST['mostrar_asistencias'])) {
  // El botón "Mostrar asistencias" ha sido presionado
  // Procesar los datos para mostrar asistencias
  $id_materia = $_POST['materia'];
  $fecha_inicio = $_POST['fecha_inicio'];
  $fecha_fin = $_POST['fecha_fin'];

  // Resto de la lógica para mostrar asistencias
} elseif (isset($_POST['parcial_1'])) {
  // El botón "Parcial 1" ha sido presionado
  // Procesar los datos para el parcial 1
  $id_materia = $_POST['materia'];
  $fecha_inicio = '2023-01-31'; // Fecha de inicio preestablecida para el parcial 1
  $fecha_fin = '2023-02-28'; // Fecha de fin preestablecida para el parcial 1

  // Resto de la lógica para el parcial 1
}elseif (isset($_POST['parcial_2'])) {
  // El botón "Parcial 1" ha sido presionado
  // Procesar los datos para el parcial 1
  $id_materia = $_POST['materia'];
  $fecha_inicio = '2023-03-01'; // Fecha de inicio preestablecida para el parcial 1
  $fecha_fin = '2023-04-30'; // Fecha de fin preestablecida para el parcial 1

  // Resto de la lógica para el parcial 1
}elseif (isset($_POST['parcial_3'])) {
  // El botón "Parcial 1" ha sido presionado
  // Procesar los datos para el parcial 1
  $id_materia = $_POST['materia'];
  $fecha_inicio = '2023-05-01'; // Fecha de inicio preestablecida para el parcial 1
  $fecha_fin = '2023-06-30'; // Fecha de fin preestablecida para el parcial 1

  // Resto de la lógica para el parcial 1
}
// Obtener los valores del formulario
$dataPoints = array();
// Obtener la lista de alumnos de la materia
$query = "SELECT * FROM alumno WHERE id_materia = $id_materia";
$resultado = mysqli_query($conexion, $query);

// Mostrar la tabla de asistencias
echo "<table class='table table-hover'>";
echo "<thead>";
echo "<tr>";
echo "<th>Nombre del alumno</th>";
echo "<th>Asistencias</th>";
echo "<th>Ausencias</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody >";
echo "</br>";
while ($fila = mysqli_fetch_assoc($resultado)) {
  $id_alumno = $fila['id_alumno'];
  $nombre_alumno = $fila['nombre_alumno'];

  // Obtener las asistencias del alumno en la materia y entre las fechas seleccionadas
  $query = "SELECT * FROM asistencia WHERE id_alumno = $id_alumno AND id_materia = $id_materia AND fecha >= '$fecha_inicio' AND fecha <= '$fecha_fin'";
  $asistencias = mysqli_query($conexion, $query);

  // Contar las asistencias y las ausencias del alumno
  $asistencias_count = 0;
  $ausencias_count = 0;
  while ($asistencia = mysqli_fetch_assoc($asistencias)) {
    if ($asistencia['estatus'] == "presente") {
      $asistencias_count++;
    } else {
      $ausencias_count++;
    }
   

  }

  $dataPoints[] = array("label"=> $nombre_alumno, "y"=> $asistencias_count);
  echo "<tr>";
  echo "<td>$nombre_alumno</td>";
  echo "<td>$asistencias_count</td>";
  echo "<td>$ausencias_count</td>";
  echo "</tr>";
}
echo "</tbody>";
echo "</table>";
?>
<?php
 
 $dataPointsas = array(
   array("x"=> 10, "y"=> 41),
   array("x"=> 20, "y"=> 35, "indexLabel"=> "Lowest"),
   array("x"=> 30, "y"=> 50),
   array("x"=> 40, "y"=> 45),
   array("x"=> 50, "y"=> 52),
   array("x"=> 60, "y"=> 68),
   array("x"=> 70, "y"=> 38),
   array("x"=> 80, "y"=> 71, "indexLabel"=> "Highest"),
   array("x"=> 90, "y"=> 52),
   array("x"=> 100, "y"=> 60),
   array("x"=> 110, "y"=> 36),
   array("x"=> 120, "y"=> 49),
   array("x"=> 130, "y"=> 41)
 );
   
 ?>
 <!DOCTYPE HTML>
 <html>
 <head>  

 <script>
 window.onload = function () {
  
 var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
	exportEnabled: true,
   theme: "light2", // "light1", "light2", "dark1", "dark2"
   title:{
     text: "Total de asistencias por alumno",
   },
   axisY:{
     includeZero: true
   },
   data: [{
     type: "column", //change type to bar, line, area, pie, etc
     //indexLabel: "{y}", //Shows y value on all Data Points
     indexLabelFontColor: "#5A5757",
     indexLabelPlacement: "outside",   
     dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
   }]
 });
 chart.render();
  
 }
 </script>
 </head>
 <body>
 <form action="filepdf.php" method="post" class="mb-5">
  <!--<label for="materia">Materia:</label><label for="fecha_inicio">Fecha de inicio:</label><label for="fecha_fin">Fecha de fin:</label>-->
  <input type="hidden"name="materia" value="<?php echo $id_materia; ?>">
  <br>
  
  <input type="hidden" name="fecha_inicio" value="<?php echo $fecha_inicio; ?>">
  <br>
  
  <input type="hidden" name="fecha_fin" value="<?php echo $fecha_fin; ?>">
  <br>
    <div class="text-center">
    <input type="submit" value="Generar tabla PDF" class="btn btn-info text-center">
    </div>
</form>

 <div id="chartContainer" style="height: 370px; width: 100%;"></div>
 <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

 </div>
</body>
</html>