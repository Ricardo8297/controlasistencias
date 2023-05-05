<?php
// Conectar a la base de datos
require "conexion.php";

// Obtener los valores del formulario
$id_materia = $_POST['materia'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

// Obtener la lista de alumnos de la materia
$query = "SELECT * FROM alumno WHERE id_materia = $id_materia";
$resultado = mysqli_query($conexion, $query);

// Mostrar la tabla de asistencias
echo "<table>";
echo "<thead>";
echo "<tr>";
echo "<th>Nombre del alumno</th>";
echo "<th>Asistencias</th>";
echo "<th>Ausencias</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
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
 
 $dataPoints = array(
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
   theme: "light1", // "light1", "light2", "dark1", "dark2"
   title:{
     text: "Simple Column Chart with Index Labels"
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
 <div id="chartContainer" style="height: 370px; width: 100%;"></div>
 <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
 </body>
 </html>          