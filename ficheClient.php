<?php
include ('./connexion.php');

//requete pour avoir le nom, email,login_fb,login_insta,membership et points
$req = "SELECT * FROM client natural join membership natural join 
    comptefidelite  where num_client ='".$_GET['num']."'";
$result = $conn->query($req);
$row = $result->fetch_array();
//requete pour avoir les adresses du client
$req1="select * from adress where id_client='".$_GET['num']."'";
$result1=$conn->query($req1);
//requete pour avoir les numéros téléphones du client
$req2="select * from contactdetails where num_client='".$_GET['num']."'";
$result2=$conn->query($req2);
?>
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

<body >
<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4" style="text-align: center;">
                    <div>Fiche Client</div>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="img/avatar.png" style="width: 150px;border-radius: 50%;">
                        <h5 class="my-3"><?php echo $row['num_client'] ?></h5>
                        <p class="text-muted mb-1"><?php echo  $row['name_client'] ?></p>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                <p class="mb-0"><?php echo $row['login_insta'] ?></p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                <p class="mb-0"><?php echo $row['login_fb'] ?></p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fa fa-star" style="color: #333333;"></i>
                                <p class="mb-0"><?php echo $row['desc_membership'] ?></p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fas fa-piggy-bank" style="color: #55acee;"></i>
                                <p class="mb-0"><?php echo  $row['points'] ?> points</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Nom complet:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo  $row['name_client'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo  $row['email_client'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Telephone(s)</p>
                            </div>
                            <div class="col-sm-9">
                                <?php
                                $row2 = $result2->fetch_array();
                                do {
                                if($row2!=null ) {
                                    echo '<p class="text-muted mb-0" >' . $row2['num_phone'] . '</p>';
                                }else{
                                    echo '<p class="text-muted mb-0" >Aucun numero du telephone n`est renseigné</p>';
                                }
                                }while($row2 = $result2->fetch_array());
                                ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Adresse(s)</p>
                            </div>
                            <div class="col-sm-9">
                                <?php
                                $row1 = $result1->fetch_array();
                                do {
                                    if($row1!=null ){
                                        echo '<p class="text-muted mb-0" >'.$row1['desc_adress'].','.$row1['city'].','.$row1['PostalCode'].'</p>';
                                    }else{
                                        echo '<p class="text-muted mb-0" >Aucune adresse n`est renseignée</p>';
                                         }
                                }while($row1 = $result1->fetch_array());
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4 mb-md-0">
                            <div class="card-body">
                                <p class="mb-4"><span class="text-primary font-italic me-1">Historique de Commande</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4 mb-md-0">
                            <div class="card-body">
                                <p class="mb-4"><span class="text-primary font-italic me-1">Historique d'utilisation des points</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>


