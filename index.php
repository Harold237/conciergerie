<?php

include("./connexion.php");
$connect = mysqli_connect('127.0.0.1',"root","root","projet_base_de_donnees",'8889');
$req = 'SELECT * FROM client';
if(isset($_POST["Search"])){
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
}
$ReqListeClient = mysqli_query($connect,$req);

?>
<section>
    <h2>LISTE DES JEUX DEJA EMPRUNTES</h2>
    <table border="1" >
        <thead>
        <th>Numéro</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Facebook</th>
        <th>Instagram</th>
        </thead>
        <tbody>
        <?php
        while ($row = mysqli_fetch_array($ReqListeClient)) {
            ?>
            <tr>
                <td><a href="DetailJeu.phpeuId=<?= $row['JeuId'] ?>"><?= date_format(date_create($row['DateReservation']),"d/m/Y") ?></a></td>
                <td><a href="DetailJeu.phpeuId=<?= $row['JeuId'] ?>"><?= $row['Nom'] ?></a></td>
                <td><a href="DetailJeu.phpeuId=<?= $row['JeuId'] ?>"><?= $row['Activite'] ?></a></td>
                <td><a href="DetailJeu.phpeuId=<?= $row['JeuId'] ?>"><?= $row['Type'] ?></a></td>
                <td><a href="DetailJeu.phpeuId=<?= $row['JeuId'] ?>"><?= $row['AgeMin'] ?> (+)</a></td>
                <td><a href="DetailJeu.phpeuId=<?= $row['JeuId'] ?>"><?= $row['Description'] ?></a></td>
                <td><a href="DetailJeu.phpeuId=<?= $row['JeuId'] ?>"><?= $row['Libelle'] ?></a></td>
            </tr>
        <?php            }
        ?>
        </tbody>
    </table>


</section>
<style>
    table{
        width:100%;
        border-collapse:collapse;
    }
    td,th{
        border:2px solid #009aff;
    }
    a{
        text-decoration:none;
    }
    input[type=text]{
        height:30px;

    }
    button{

        color:white;
        background-color:#009aff;
        padding:7px;
        border:none;
    }
    thead{
        color:white;
        background-color:#009aff;
    }
    h1,h2,h3{
        text-align:center;
    }
</style>
