<?php
include ('connexion.php');

require('fpdf/fpdf.php');
$req1='Select id_client,name_client,desc_adress,city,PostalCode,email_client,num_phone,date_order,num_invoice,date_invoice
from client natural join adress natural join contactdetails natural join order_ natural join contenirproduct natural join invoice  where num_order = "021120-MAQ-C002"';
$req = 'SELECT name_product,amount_product,sell_price from contenirproduct natural join product where num_order = "021120-MAQ-C002"';
$result1 = $conn->query($req1);
$rowResultat1 = $result1->fetch_array();
$result = mysqli_query($conn, $req);
while($row=mysqli_fetch_assoc($result)) {
    $resultset[] = $row;
}
$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'N° client:'.$rowResultat1['id_client'],0,1);
$pdf->Cell(0,5,'Nom client:'.$rowResultat1['name_client'],0,1);
$pdf->Cell(0,5,'email:'.$rowResultat1['email_client'],0,1);
$pdf->Cell(0,5,'Telephone:'.$rowResultat1['num_phone'],0,1);
$pdf->Cell(0,5,'Adresse:'.$rowResultat1['desc_adress'].','.$rowResultat1['city'].','.$rowResultat1['PostalCode'],0,1);
$pdf->setX(120);
$pdf->Cell(0,5,'N commande:021120-MAQ-C002',0,1);
$pdf->setX(120);
$pdf->Cell(0,5,'Date commande:'.$rowResultat1['date_order'],0,1);
$pdf->setX(120);
$pdf->Cell(0,5,'N facture:'.$rowResultat1['num_invoice'],0,1);
$pdf->setX(120);
$pdf->Cell(0,20,'Date facture:'.$rowResultat1['date_invoice'],0,1);
$pdf->Cell(60,12,'Produit',1);
$pdf->Cell(60,12,'Quantite',1);
$pdf->Cell(60,12,'Prix unitaire',1);
foreach($resultset as $row) {
    $pdf->SetFont('Arial','',12);
    $pdf->Ln();
    foreach($row as $column)
        $pdf->Cell(60,12,$column,1);
}
$pdf->Output();
?>