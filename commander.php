<?php
require_once ('./connexion.php');
session_start();
$num_order = $_POST["num_order"];
$date_order = $_POST["date_order"];
$status_order = $_POST["status_order"];
$num_client = $_POST["num_client"];
echo $sql = "INSERT INTO `order_`('num_order',`date_order`, `status_order`,'num_client') VALUES ('$num_order','$date_order', '$status_order','$num_client')";
$result = mysqli_query($conn, $sql);
$id_commande = $conn->insert_id;
foreach ($_SESSION['cart'] as $cart){

    echo $sql = "INSERT INTO `contenirproduct`(`num_order`,`num_product`, `amount_product`) VALUES (".$num_order.",". $cart['num_product'].", ".$cart['amount_product'].")";
    $result = mysqli_query($conn, $sql);

}
header('location: listeCommande.php');

