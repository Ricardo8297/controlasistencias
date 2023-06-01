<?php
// Conectar a la base de datos
require "conexion.php";

// Obtener los valores del formulario
$id_materia = $_POST['materia'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$dataPoints = array();
// Obtener la lista de alumnos de la materia
$query = "SELECT * FROM alumno WHERE id_materia = $id_materia";
$resultado = mysqli_query($conexion, $query);

// Incluir la biblioteca FPDF
require('fpdf185\fpdf.php');

// Crear una nueva instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Establecer el título del documento
$pdf->SetTitle('Tabla de Asistencias');

// Establecer la fuente y el tamaño de letra para el título
$pdf->SetFont('Arial', 'B', 16);

// Escribir el título
$pdf->Cell(0, 10, 'Tabla de Asistencias', 0, 1, 'C');

// Establecer la fuente y el tamaño de letra para el contenido
$pdf->SetFont('Arial', '', 12);

// Crear la tabla de asistencias
$pdf->Cell(120, 10, '                                 Nombre del alumno', 1);
$pdf->Cell(30, 10, '   Asistencias', 1);
$pdf->Cell(30, 10, '   Ausencias', 1);
$pdf->Ln();

// Iterar sobre los alumnos y mostrar sus asistencias en la tabla
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

  // Agregar los datos a la matriz de puntos de datos para el gráfico (opcional)
  $dataPoints[] = array("label"=> $nombre_alumno, "y"=> $asistencias_count);

  // Agregar una fila a la tabla
  $pdf->Cell(120, 10, $nombre_alumno, 1);
  $pdf->Cell(30, 10, $asistencias_count, 1);
  $pdf->Cell(30, 10, $ausencias_count, 1);
  $pdf->Ln();
}

// Generar el gráfico de asistencias (opcional)
// ...

// Guardar el archivo PDF
ob_clean();
$pdf->Output('tabla_asistencias.pdf', 'D');
exit();

// Generar un nombre único para el archivo PDF
//$nombre_archivo = 'tabla_asistencias_' . uniqid() . '.pdf';
//$ruta_archivo = 'pdf/' . $nombre_archivo;

// Guardar el archivo PDF en el servidor
//$pdf->Output($ruta_archivo, 'F');

// Enviar el archivo al navegador para su descarga
//header("Content-type: application/pdf");
//header("Content-Disposition: attachment; filename=$nombre_archivo");
//readfile($ruta_archivo);
//unlink($ruta_archivo);

?>