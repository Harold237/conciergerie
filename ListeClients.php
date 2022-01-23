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


<?php

include ('./connexion.php');
$req = 'SELECT * FROM client natural join membership natural join 
    comptefidelite natural join  adress natural join contactdetails';
$result = $conn->query($req);

/*if(isset($_POST["Search"])){
    $search=$_POST["Search"];
    $Option="";
    if(isset($_POST["OptionNom"])){
        $Option .="Nom LIKE '%$search%' OR ";
    }
    if(isset($_POST["OptionAge"])){
        $Option .="AgeMin LIKE '%$search%' OR ";
    }
    if(isset($_POST["OptionDescription"])){
        $Option .="Description LIKE '%$search%' OR ";
    }
    if(isset($_POST["OptionType"])){
        $Option .="Type LIKE '%$search%' OR ";
    }
    $Option = substr($Option, 0, -3);
    if($Option != ""){
        $req = 'SELECT * FROM client AND '.$Option;
    }else{
        $req = 'SELECT * FROM client';
    }
}*/


?>
<section>
    <h2>LISTE DES ClIENTS</h2>
    <table class="table">
        <thead class="thead-dark">
        <th scope="col">Numéro</th>
        <th scope="col">Nom</th>
        <th scope="col">Adresse</th>
        <th scope="col">Telephone</th>
        <th scope="col">Email</th>
        <th scope="col">Facebook</th>
        <th scope="col">Instagram</th>
        <th scope="col">membership</th>
        <th scope="col">Total points</th>
        <th scope="col">Modifier</th>
        <th scope="col">Supprimer</th>
        </thead>

        <?php
        $row = $result->fetch_array();
        do
        {

            echo'<tbody><tr>
                  <td scope="row">'.$row['num_client'].'</td>
                  <td scope="row">'.$row['name_client'].'</td>
                  <td scope="row">'.$row['desc_adress'].','.$row['city'].','.$row['PostalCode'].'</td>
                  <td scope="row">'.$row['num_phone'].'</td>
                  <td scope="row">'.$row['login_insta'].'</td>
                  <td scope="row">'.$row['login_fb'].'</td>
                  <td scope="row">'.$row['login_insta'].'</td>
                  <td scope="row">'.$row['desc_membership'].'</td>
                  <td scope="row">'.$row['points'].'</td>
                  <td scope="row"><i class="fas fa-user-edit"></i></td>
                  <td scope="row"><i class="fas fa-user-slash"></i></td>
                 </tr>
                 </tbody>' ;
        }while ($row = $result->fetch_array());
        ?>
    </table>


</section>

</body>
</html>