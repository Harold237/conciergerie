<?php
require_once ('./connexion.php');
session_start();


echo '<pre>';

echo $sql = "UPDATE contenirproduct SET amount_product=".$_POST['amount_product']." WHERE num_product='".$_POST['num_product']."' and
 num_order='".$_POST['num_order']."'";
$result = mysqli_query($conn, $sql);

header('location: ./listeCommande.php');

?>