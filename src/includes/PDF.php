<?php
/**
 * Created by PhpStorm.
 * User: mateusz
 * Date: 20.03.19
 * Time: 19:14
 */

session_start();
require '../fpdf/fpdf.php';

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 36);
        $this->Cell(0, 10, 'Service Management', 0, 0, 'C');
        $this->Ln(20);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 10);
        $this->Cell('0', 10, '@Copyright Mateusz Balcer', 0, 0, 'C');
    }

}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(0, 5, 'You can follow the repair status by logging in to the website: ', 0, 1);
$pdf->Cell(0, 10, 'http://mbalcer.cba.pl/ServiceManagement', 0, 1);
$pdf->Ln(10);
$pdf->Cell(0, 10, 'Your login data is: ', 0, 1);
$pdf->Cell(0, 10, 'Email: '.$_SESSION['email'], 0, 1);
$pdf->Cell(0,10, 'Password: '.$_SESSION['password'], 0, 1);

$pdf->Output();

