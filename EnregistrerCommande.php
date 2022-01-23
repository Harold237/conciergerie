<?php

include("./connexion.php");
include("./header.php");

$req2 = "SELECT * FROM product";
$req_aff = mysqli->query("SELECT num_product,name_product,buy_price FROM product where num_product =  '$num_product'");
$result = $conn->query($req2);
$row = $result->fetch_array();
if (isset($_POST["Enregistrer"])) {
    $num_order = $_POST["num_order"];
    $date_order = $_POST["date_order"];
    $status_order = $_POST["status_order"];
    $num_client = $_POST["num_client"];
    $num_product = mysqli_real_escape_string($conn, $_POST['num_product']);
    $name_product = mysqli_real_escape_string($conn, $_POST['name_product']);
    $amount_product = mysqli_real_escape_string($conn, $_POST['amount_product']);
    $req = "INSERT INTO `order_`(`num_order`, `date_order`, `status_order`, `num_client`) VALUES ('$num_order','$date_order','$status_order','$num_client')";
    $req1 = "INSERT INTO 'contenirproduct'('num_order','num_product','amount_product') VALUES ('$num_order','$num_product','$amount_product')";
    $exe = mysqli_query($conn, $req);
    $exe1 = mysqli_query($conn, $req1);
    $id = mysqli_insert_id($conn);
}
if (isset($_POST["Ajouter"])) {
    $num_order = $_POST["num_order"];
    $num_product = mysqli_real_escape_string($conn, $_POST['num_product']);
    $req_aff = mysqli->query("SELECT num_product,name_product,buy_price FROM product where num_product =  '$num_product'");

    $id = mysqli_insert_id($conn);
}

?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<section>
    <h2>ENREGISTRER UNE COMMANDE</h2>
    <table border="1">
        <thead>
        <th>Label</th>
        <th>Champs</th>
        </thead>
        <form action="" method="POST">
            <tbody>
            <tr>
                <td>NUMERO COMMANDE</td>
                <td><input required type="text" name="num_order" id="num_order"
                           placeholder="Veuillez entrer le numéro de la commande"></td>
            </tr>
            <tr>
                <td>DATE COMMANDE</td>
                <td><input required type="date" name="date_order" id="date_order" value="" readonly>
                    <script>
                        document.getElementById("date_order").valueAsDate = new Date();
                    </script>
                </td>
            </tr>
            <tr>
                <td>ETAT DE LA COMMANDE</td>
                <td><input required type="text" name="status_order " id="status_order "
                           value="En Attente"></td>
            </tr>
            <tr>
                <td>NUMERO CLIENT</td>
                <td><input required type="text" name="num_client" id="num_client"
                           placeholder="Veuillez entrer le numéro du client..."></td>
            </tr>
            <tr>
                <td>
                    <label>Nom du produit</label>
                </td>
                <td>
                    <?php
                    while($commande= $req_aff->fetch_array()){
                        echo $commande['name_product'].'<br>';
                        echo $commande['num_product'].'<br>';
                        echo $commande['buy_price'];
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="button" name="Enregistrer" value="Enregistrer">
                </td>
            </tr>
            </tbody>
        </form>
    </table>
</section>
<section>
    <h2>Liste Des Produits</h2>
    <table class="table">
        <thead class="thead-dark">
        <th scope="col">Numéro du produit</th>
        <th scope="col">Nom du produit</th>
        <th scope="col">Statut</th>
        <th scope="col">Prix</th>
        <th scope="col">Ajouter</th>
        </thead>

        <?php

        do {

            echo '<tbody><tr>
                  <td scope="row">' . $row['num_product'] . '</td>
                  <td scope="row">' . $row['name_product'] . '</td>
                  <td scope="row">' . $row['status_product'] . '</td>
                  <td scope="row">' . $row['buy_price'] . '</td>
                  <td scope="row"><input type="button" name="Ajouter" value="Ajouter" ></td>
                 </tr>
                 </tbody>';
        } while ($row = $result->fetch_array());
        ?>
    </table>


</section>

</body>
</html>

<style>

    .header a {
        float: left;
        color: white;
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
        color: white;
    }

    .header a.logo {
        font-size: 25px;
        font-weight: bold;
    }

    .header-right {
        float: right;
    }


</style>
