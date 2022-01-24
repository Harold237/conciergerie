<?php
include ('connexion.php');

require('fpdf/fpdf.php');

$req1="Select id_client,name_client,desc_adress,city,PostalCode,email_client,num_phone,date_order
from client natural join adress natural join contactdetails natural join order_ natural join contenirproduct  where num_order ='".$_GET['num_order']."'";
$req = "SELECT name_product,amount_product,sell_price from contenirproduct natural join product where num_order = '".$_GET['num_order']."'";
$result1 = $conn->query($req1);
$rowResultat1 = $result1->fetch_array();
$result = mysqli_query($conn, $req);
while($row=mysqli_fetch_assoc($result)) {
    $resultset[] = $row;
}
/*$req2 = "SELECT id_payement,libelle_typePayement,date_payement,amount_payement from concernerpaiment natural join payement natural join typepayement where num_invoice='".$rowResultat1['num_invoice']."'";
$result2 = mysqli_query($conn, $req2);
while($row2=mysqli_fetch_assoc($result2)) {
    $resultset2[] = $row2;
}*/
$result=mysqli_query($conn,"SELECT num_invoice from invoice order by num_invoice DESC LIMIT 1");
$data=mysqli_fetch_assoc($result);
$num = explode("0", $data['num_invoice']);
$numPlus=intval($num[count($num)-1])+1;
$num_facture='22-MAQ-F00'.$numPlus;
$numOrder=$_GET['num_order'];
$pdf = new FPDF();
$pdf->AddPage();
$pdf->setX(50);
$pdf->SetFont('Arial','B',18);
$pdf->Cell(60,30,'Facture Numero:'.$num_facture,0,1);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,8,'N client:'.$rowResultat1['id_client'],0,1);
$pdf->Cell(0,8,'Nom client:'.$rowResultat1['name_client'],0,1);
$pdf->Cell(0,8,'email:'.$rowResultat1['email_client'],0,1);
$pdf->Cell(0,8,'Telephone:'.$rowResultat1['num_phone'],0,1);
$pdf->Cell(0,8,'Adresse:'.$rowResultat1['desc_adress'].','.$rowResultat1['city'].','.$rowResultat1['PostalCode'],0,1);
$pdf->setX(120);
$pdf->Cell(0,8,'N commande:021120-MAQ-C002',0,1);
$pdf->setX(120);
$pdf->Cell(0,8,'Date commande:'.$rowResultat1['date_order'],0,1);
$pdf->setX(120);
$date=date("y-m-d") ;
$pdf->Cell(0,8,'Date facture:'.$date,0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(60,12,'Produit',1);
$pdf->Cell(60,12,'Quantite',1);
$pdf->Cell(60,12,'Prix unitaire',1);

$total=0;
foreach($resultset as $row) {
    $pdf->SetFont('Arial','',12);
    $pdf->Ln();
    $total+=$row['amount_product']*$row['sell_price'];
    foreach($row as $column) {
        $pdf->Cell(60, 12,$column, 1);
    }
}
$pdf->Cell(0,20,'',0,1);
$pdf->setX(130);
$pdf->Cell(60,12,'Montant de la commande : '.$total.' $',1);
$sql = "INSERT INTO invoice(num_invoice,date_invoice,amount_invoice,num_order) VALUES ('$num_facture',curdate(),$total,'$numOrder')";
$sqlResult= mysqli_query($conn, $sql);
$pdf->Output();
?>