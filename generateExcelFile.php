<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<table class="table" style="padding-left:10px">
    <thead class="thead-dark">
    <th scope="col">Numéro Commande</th>
    <th scope="col">date Commande</th>
    <th scope="col">Status commande</th>
    <th scope="col">Montant total</th>

    <th scope="col"></th>

    </thead>
<?php
require_once ('./connexion.php');
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=commandes.xls");

$req = "select num_order,date_order,status_order,sum(amount_product*sell_price) as total from order_ natural join contenirproduct natural join product group by num_order";
$result=$conn->query($req);
$row = $result->fetch_array();
do
{

echo'<tbody><tr>
    <td scope="row">'.$row['num_order'].'</td>
    <td scope="row">'.$row['date_order'].'</td>
    <td scope="row">'.$row['status_order'].'</td>
     <td scope="row">'.$row['total'].' $</td>
</tr>
</tbody>' ;
}while ($row = $result->fetch_array());
?>
</table>
</body>
