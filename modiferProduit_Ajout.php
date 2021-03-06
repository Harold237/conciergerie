<?php
session_start();
require_once ('./connexion.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>
<body>


<?php
require_once ('./navbar.php');
if(isset($_POST['num_product'])){
$sql = "INSERT INTO contenirproduct(num_order,num_product, amount_product) VALUES ('".$_GET['num_order']."','".$_POST['num_product']."', '".$_POST['amount_product']."')";
$result = mysqli_query($conn, $sql);
}
?>
<div class="container" style="margin-top:10%">
<a href="detail_commande.php?id=<?= $_GET['num_order']?>"> 
<h5> Retour aux détails de la commande </h5>
</a>
<h3>vous etes entrain d'ajouter dans la commande numero :<?= $_GET['num_order']?> </h3>
    <div class="row text-center py-5">
        <?php
       $sql ="select * from product where num_product  not in (select num_product from contenirproduct where num_order ='".$_GET['num_order']."')";

        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)){

            ?>
            <div class="col-md-3 col-sm-6 my-3 my-md-0" >
              
                  <form action="modiferProduit_ajout.php?num_order=<?= $_GET['num_order']?>" method="post">
                    <div class="card shadow"style="margin-top:10px" >
                        <div>
                            <img src="<?=$row['product_image']?>" alt="Image1" class="img-fluid card-img-top">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?=$row['name_product']?></h5>
                            <h6>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </h6>
                          
                            <h5>
                                <small><s class="text-secondary">$519</s></small>
                                <span class="price">$<?=$row['buy_price']?></span>
                            </h5>
                            <input type='number' min="1" class='form-control form-control-xs' name="amount_product" value='1'>
                            <button type="submit" class="btn btn-warning my-3" name="add">Add to this order</i></button>
                            <input type='hidden' name='num_product' value='<?=$row['num_product']?>'>
                        </div>
                    </div>
					</form>
               
            </div>

            <?php
        }
        ?>
    </div>
</div>





<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>