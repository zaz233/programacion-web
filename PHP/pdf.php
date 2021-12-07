<?php
//Llamado a la base de datos y a la libreria FPDF
include 'conexion.php';
require('FPDF/fpdf.php');
date_default_timezone_set('America/Caracas');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    // $this->Image('IMG/Logo.png',88.5,25,33);
    // Arial bold 15
    $this->SetFont('Arial','B',16);
    // Movernos a la derecha
    $this->Cell(56);
    // Título
    $this->Cell(80,10,'Reporte de Estudio Medico',1,0,'C');
    // Salto de línea
    $this->Ln(50);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

//Llamada de datos para el pdf
$sql_select_pdf = "SELECT * FROM estudio WHERE estado = 'Realizado' AND estado_medico = 'Enviar';";
$sql_select_pdf_ejecutar = mysqli_query($con, $sql_select_pdf) or die('Error: ' . $mysqli_error($con));
$sql_select_pdf_array = mysqli_fetch_array($sql_select_pdf_ejecutar);

//creacion del pdf
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(70,10,utf8_decode('Información del Paciente'), 0, 1, 'C', 0);
$pdf->Cell(40,10,utf8_decode('Nombre:'), 1, 0, 'C', 0);
$pdf->Cell(55,10,utf8_decode($sql_select_pdf_array['nombre_paciente']), 1, 0, 'C', 0);
$pdf->Cell(40,10,utf8_decode('Apellido:'), 1, 0, 'C', 0);
$pdf->Cell(55,10,utf8_decode($sql_select_pdf_array['apellido_paciente']), 1, 1, 'C', 0);
$pdf->Cell(30,10,utf8_decode('Cedula:'), 1, 0, 'C', 0);
$pdf->Cell(160,10,utf8_decode($sql_select_pdf_array['cedula_paciente']), 1, 1, 'C', 0);
$pdf->Cell(60,10,utf8_decode('Correo Electrónico:'), 1, 0, 'C', 0);
$pdf->Cell(130,10,utf8_decode($sql_select_pdf_array['email_paciente']), 1, 1, 'C', 0);
$pdf->Cell(50,10,utf8_decode('Examen Medico:'), 1, 0, 'C', 0);
$pdf->Cell(140,10,utf8_decode($sql_select_pdf_array['examen']), 1, 1, 'C', 0);
$pdf->Cell(50,10,utf8_decode(''), 0, 1, 'C', 0);

$pdf->Cell(70,10,utf8_decode('Información del Enfermero'), 0, 1, 'C', 0);
$pdf->Cell(40,10,utf8_decode('Nombre:'), 1, 0, 'C', 0);
$pdf->Cell(55,10,utf8_decode($sql_select_pdf_array['nombre_enfermero']), 1, 0, 'C', 0);
$pdf->Cell(40,10,utf8_decode('Apellido:'), 1, 0, 'C', 0);
$pdf->Cell(55,10,utf8_decode($sql_select_pdf_array['apellido_enfermero']), 1, 1, 'C', 0);
$pdf->Cell(30,10,utf8_decode('Cedula:'), 1, 0, 'C', 0);
$pdf->Cell(160,10,utf8_decode($sql_select_pdf_array['cedula_enfermero']), 1, 1, 'C', 0);
$pdf->Cell(70,10,utf8_decode('Fecha de Atencion:'), 1, 0, 'C', 0);
$pdf->Cell(120,10,utf8_decode(date('d/m/Y h:i:s a',strtotime($sql_select_pdf_array['fecha_atencion_enfermero']))), 1, 1, 'C', 0);
$pdf->Cell(50,10,utf8_decode(''), 0, 1, 'C', 0);

$pdf->Cell(70,10,utf8_decode('Información del Medico'), 0, 1, 'C', 0);
$pdf->Cell(40,10,utf8_decode('Nombre:'), 1, 0, 'C', 0);
$pdf->Cell(55,10,utf8_decode($sql_select_pdf_array['nombre_medico']), 1, 0, 'C', 0);
$pdf->Cell(40,10,utf8_decode('Apellido:'), 1, 0, 'C', 0);
$pdf->Cell(55,10,utf8_decode($sql_select_pdf_array['apellido_medico']), 1, 1, 'C', 0);
$pdf->Cell(30,10,utf8_decode('Cedula:'), 1, 0, 'C', 0);
$pdf->Cell(160,10,utf8_decode($sql_select_pdf_array['cedula_medico']), 1, 1, 'C', 0);
$pdf->Cell(70,10,utf8_decode('Fecha de Atencion:'), 1, 0, 'C', 0);
$pdf->Cell(120,10,utf8_decode(date('d/m/Y h:i:s a',strtotime($sql_select_pdf_array['fecha_atencion_medico']))), 1, 1, 'C', 0);
$pdf->Cell(50,60,utf8_decode(''), 0, 1, 'C', 0);

$pdf->Cell(190,10,utf8_decode('Diagnostico:'), 1, 1, 'C', 0);
$pdf->Cell(190,205,utf8_decode($sql_select_pdf_array['diagnostico']), 1, 0, 'L', 0);



$pdfdoc = $pdf->Output('','S');

//Datos para actualizar la tabla estudio
$estado_medico = 'Enviado';
$ID = $sql_select_pdf_array['id'];

//actualizando la tabla estudio
$sql_update = "UPDATE estudio SET estado_medico = '$estado_medico' WHERE id = '$ID';";
$sql_update_ejecutar = mysqli_query($con, $sql_update) or die("Error:" . mysqli_error($con));
?>