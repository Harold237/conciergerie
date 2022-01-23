<?php
require_once ('./connexion.php');
session_start();
$num_client = $_GET["num"];
echo $sql = "INSERT INTO order_(num_order,date_order, status_order,num_client) VALUES ('021120-MAQ-C0022',curdate(), 'To Buy','$num_client')";
$result = mysqli_query($conn, $sql);
$id_commande = $conn->insert_id;
foreach ($_SESSION['cart'] as $cart){

    echo $sql = "INSERT INTO contenirproduct(num_order,num_product, amount_product) VALUES ('021120-MAQ-C0022','".$cart['num_product']."', ".$cart['amount_product'].")";
    $result = mysqli_query($conn, $sql);

}
header('location: listeCommande.php?num='.$_GET['num']);

