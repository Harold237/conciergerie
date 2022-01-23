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
//$conn = mysqli_connect('127.0.0.1',"root","root","projet_base_de_donnees",'8889');
$req = 'SELECT * FROM order_ natural join client';
$result = $conn->query($req);
include ('./navbar.php');
if(isset($_GET['action']) && $_GET['action']=='supprimer' ){
    $sql = "DELETE FROM order_ WHERE num_order ='".$_GET['id']."'";

    $result = mysqli_query($conn, $sql);
    header('location: listeCommande.php');
}
?>
<section>
    <h2 style="margin-top:5%;margin-bottom:5%;text-align: center;">LISTE DES COMMANDES</h2>
    <table class="table">
        <thead class="thead-dark">
        <th scope="col">NUMERO COMMANDE</th>
        <th scope="col">DATE COMMANDE</th>
        <th scope="col">ETAT DE LA COMMANDE</th>
        <th scope="col">NUMERO CLIENT</th>
        <th scope="col">Modifier</th>
        <th scope="col">Supprimer</th>
        </thead>
        <tbody>
        <?php


        $result = mysqli_query($conn, $req);
        while ($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?=$row['num_order']?></td>
                <td><?=$row['date_order']?></td>
                <td><?=$row['status_order']?></td>
                <td><?=$row['num_client']?></td>
                <td><a href="detail_commande.php?id=<?=$row['num_order']?>"><i class="fas fa-edit" ></i></a></td>
                <td><a href="listeCommande.php?action=supprimer&id=<?=$row['num_order']?>;"><i class="fas fa-trash-alt" style="color: red;"></i></a></td>

            </tr>
            <?php

        }

        ?>
        </tbody>
    </table>


</section>

</body>
</html>

<style>

    .header a {
        float: left;
        color:white;
        text-align: center;
        padding: 12px;
        text-decoration: none;
        font-size: 18px;
        line-height: 25px;
        border-radius: 4px;
    }

    .header a:hover {
        background-color: white;
        color: black;
    }


    .header {
        overflow: hidden;
        background-color: #009aff;
        box-shadow: 0 4px 20px 0 gray;
        padding: 20px 10px;
        color:white;
    }

    .header a.logo {
        font-size: 25px;
        font-weight: bold;
    }

    .header-right {
        float: right;
    }


</style>