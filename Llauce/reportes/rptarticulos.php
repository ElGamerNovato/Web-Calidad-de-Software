<?php
require('PDF_MC_Table.php');

class PDF extends FPDF {
    function Header(){
        // Encabezado del PDF
        $this->SetFont('Arial','B',16);
        $this->Cell(0,10,'LISTA DE TODOS LOS PRODUCTOS',0,1,'C');
        $this->Ln(10);

        // Encabezados de la tabla
        $this->SetFont('Arial','B',12);
        $this->SetFillColor(192, 192, 192);
        $this->Cell(19,10,'ID',1,0,'C', 1);
        $this->Cell(70,10,'Producto',1,0,'C', 1);
        $this->Cell(25,10,'Precio',1,0,'C', 1);
        $this->Cell(20,10,'Stock',1,0,'C', 1);
        $this->Cell(30,10,'Categoria',1,0,'C', 1);
        $this->Cell(25,10,'Proveedor',1,1,'C', 1);
    }

    function Footer(){
        // Pie de página
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Página '.$this->PageNo(),0,0,'C');
    }
}

// Crear un nuevo objeto PDF
$pdf = new PDF();

// Agregar una página al PDF
$pdf->AddPage();

require_once '../Controller/conexion/configuracion.php';
$sql = "SELECT id, producto, img, precio, stock, categoria, idproveedor, proveedor FROM productoss";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    // Agregar datos a la tabla
    $pdf->SetFont('Arial', '', 12); // Establece el estilo de fuente para los registros
    $pdf->Cell(19,10,$row['id'],1,0,'C');
    $pdf->Cell(70,10,$row['producto'],1,0,'L');
    $pdf->Cell(25,10,'S/ '.$row['precio'],1,0,'C');
    $pdf->Cell(20,10,$row['stock'],1,0,'C');
    $pdf->Cell(30,10,$row['categoria'],1,0,'L');
    $pdf->Cell(25,10,$row['proveedor'],1,1,'L');
}

// Salida del PDF
$pdf->Output();
?>
