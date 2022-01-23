<?php
require_once ('./connexion.php');
session_start();


echo '<pre>';
var_dump();
echo $sql = "UPDATE `contenirproduct` SET `amount_product`=".$_POST['amount_product']." WHERE `nu`=".$_POST['id_ligne']."";
$result = mysqli_query($conn, $sql);

header('location: ./listeCommande.php');

?>