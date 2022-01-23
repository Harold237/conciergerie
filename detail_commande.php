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
        <title>Cart</title>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

        <!-- Bootstrap CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <link rel="stylesheet" href="style.css">
    </head>
    <body class="bg-light">

    <?php
    require_once ('./header.php');
    if (isset($_GET['id'])){
        $id=    $_GET['id'];
    }
    if (isset($_GET['action'])){
        if($_GET['action'] == 'supprimer'){
            $idsupprimer = $_GET['num_order'];
            $sql = "DELETE FROM contenirproduct WHERE num_order ='".$_GET['num_order']."' and num_product='".$_GET['num_product']."'";

            $result = mysqli_query($conn, $sql);
            header('location: listeCommande.php');
        }
    }
    ?>

    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart">
                    <h6>My Cart</h6>
                    <hr>

                    <?php

                    $total = 0;

                    $sql = "SELECT * FROM contenirproduct natural join product WHERE num_order ='".$id."'";

                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)){
                        ?>
                        <form action="./modifier_commande.php" method="post" class="cart-items">
                            <div class="border rounded">
                                <div class="row bg-white">
                                    <div class="col-md-3 pl-0">
                                        <!--<img src="<?=$row['product_image']?>" alt="Image1" class="img-fluid">-->
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="pt-2"><?=$row['name_product']?></h5>
                                        <small class="text-secondary">Seller: dailytuition</small>
                                        <h5 class="pt-2">$<?=$row['buy_price']?></h5>
                                        <h5 class="pt-2">Quantité:<input type='number' min="1" class='form-control form-control-xs' name="amount_product" value='<?=$row['amount_product']?>'> </h5>
                                        <input type="hidden" name="num_product" value="<?=$row['num_product']?>">
                                        <input type="hidden" name="num_order" value="<?=$row['num_order']?>">
                                        <div class="col-md-12 row">
                                            <div class="col-md-6"><button type="submit" class="btn btn-info mx-2">Modifier </button></div>
                                            <div class="col-md-6"><a href="detail_commande.php?action=supprimer&num_product=<?=$row['num_product']?>&num_order=<?=$row['num_order']?>" class="btn btn-warning mx-2">Supprimer </a></div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </form>


                        <?php

                        $total = $total + (int)$row['buy_price'] * (int)$row['amount_product'];
                    }

                    ?>

                </div>
            </div>
            <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

                <div class="pt-4">
                    <h6>DETAILS</h6>
                    <hr>
                    <div class="row price-details">
                        <div class="col-md-6">
                            <?php
                            if (isset($_SESSION['cart'])){
                                $count  = count($_SESSION['cart']);
                                echo "<h6>Price ($count items)</h6>";
                            }else{
                                echo "<h6>Price (0 items)</h6>";
                            }
                            ?>
                            <h6>Frais de livraison</h6>
                            <hr>
                            <h6>Montant Payé</h6>
                        </div>
                        <div class="col-md-6">
                            <h6>$<?php echo $total; ?></h6>
                            <h6 class="text-success">GRATUIT</h6>
                            <hr>
                            <h6>$<?php
                                echo $total;
                                ?></h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
    </html>
