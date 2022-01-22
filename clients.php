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
  <div style="margin:10%" >


<?php

include ('./connexion.php');
$req = 'SELECT * FROM client ';
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
    <h2>LISTE DES ClIENTS <a href="ajouterClient.php" ><button type='button' class='btn btn-danger' style="float:right;font-size:20px" >ajouter client</button></a></h2>
    <table class="table" style="padding-left:10px">
        <thead class="thead-dark">
        <th scope="col">Numéro</th>
        <th scope="col">Nom</th>
        <th scope="col">Email</th>
       
        <th scope="col"></th>
        
        </thead>

        <?php
        $row = $result->fetch_array();
        do
        {
   
            echo'<tbody><tr>
                  <td scope="row">'.$row['num_client'].'</td>
                  <td scope="row">'.$row['name_client'].'</td>
                  <td scope="row">'.$row['email_client'].'</td>
                 
                  <td scope="row">
                  <a href ="gestionClient.php?num_client='.$row['num_client'].'">
                  <i class="fas fa-user-edit" style="color:green;font-size:25px"></i>
                  </a>
                
               
                 </tr>
                 </tbody>' ;
        }while ($row = $result->fetch_array());
         ?>
    </table>


</section>
      </div>

      <script type="text/javascript">
       
        function deleteClient(id)
        {
            swal({
  title: "êtes vous sur?",
  text: "vous ne pouvez pas récupérer le client supprimé!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete)
  {
        var path = "deleteClient.php?id=".concat(id);
        window.location.href=path;
  } else
  {
    swal("la suppression n'est pas éxécutée!");
  }
});
        }
    </script>
</body>
</html>