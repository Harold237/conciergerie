
<?php


require_once ('./connexion.php');
session_start();

if (isset($_POST['add'])){
    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "num_product");

        if(in_array($_POST['num_product'], $item_array_id)){
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = './index.php'</script>";
        }else{
            $count = count($_SESSION['cart']);
            $item_array = array(
                'num_product' => $_POST['num_product'],
                'amount_product'=> $_POST['amount_product'],
            );

            $_SESSION['cart'][$count] = $item_array;
            echo "<script>window.location = './index.php'</script>";
        }

    }else{

        $item_array = array(
            'num_product' => $_POST['num_product'],
            'amount_product'=> $_POST['amount_product'],
        );
        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
}


