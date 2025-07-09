<?php
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 18);

// Add logo image
$pdf->Image('./assets/img/cart.png', 20, 5, 27, 24);

// Cooperative name
$pdf->Cell(25);
$pdf->SetFont('Times', 'B', 20);
$pdf->Cell(0, 5, 'KOPERASI HARUM MANIS BERSATU', 0, 1, 'C');

// Website and email
$pdf->Cell(25);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0, 5, 'Website: ' . 'MMM.HARUMBERSATU.COM' . ' / E-Mail: ' . 'admin@harumbersatu.com', 0, 1, 'C');

// Address and contact
$pdf->Cell(25);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0, 5, 'Banjarmasin Utara' . ' Telp./Fax: ' . '089520201001' . ' / ' . 'KOPERASI HARUM MANIS BERSATU', 0, 1, 'C');

// Add decorative lines
$pdf->SetLineWidth(1);
$pdf->Line(10, 36, 197, 36);
$pdf->SetLineWidth(0);
$pdf->Line(10, 37, 197, 37);

// Add spacing
$pdf->Cell(30, 17, '', 0, 1);

$pdf->SetFont('Times', '', 10);
?>