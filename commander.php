<?php
require_once ('./connexion.php');
session_start();
$num_client = $_GET["num"];
$result=mysqli_query($conn,"SELECT count(*) as total from order_");
$data=mysqli_fetch_assoc($result);
$num_commande='22-MAQ-C00'.$data['total'];
$sql = "INSERT INTO order_(num_order,date_order, status_order,num_client) VALUES ('$num_commande',curdate(), 'To Buy','$num_client')";
$result = mysqli_query($conn, $sql);
$id_commande = $conn->insert_id;
foreach ($_SESSION['cart'] as $cart){

    echo $sql = "INSERT INTO contenirproduct(num_order,num_product, amount_product) VALUES ('".$num_commande."','".$cart['num_product']."', ".$cart['amount_product'].")";
    $result = mysqli_query($conn, $sql);
    session_unset();

}
header('location: listeCommande.php?num='.$_GET['num']);

