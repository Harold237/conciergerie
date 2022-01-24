<?php 

	include ('./connexion.php');

  

	$update_id =  $_GET['num_client'];
	$query = "SELECT * FROM client where num_client = '". $update_id."'";
	$result = mysqli_query($conn, $query);
	$user = mysqli_fetch_array($result);

	$num = $user['num_client'];
	$nom = $user['name_client'];
	$email = $user['email_client'];
	$login_fb = $user['login_fb'];
	$login_insta = $user['login_insta'];
	$membership = $user['id_memebership'];
	if (isset($_POST['submit']))
	{
		//get form data
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$nom1 = mysqli_real_escape_string($conn, $_POST['nom']);
		$email1 = mysqli_real_escape_string($conn, $_POST['email']);
		$membership1=(int)mysqli_real_escape_string($conn, $_POST['drone']);
		$login_fb1 = mysqli_real_escape_string($conn, $_POST['fblogin']);
		$login_insta1 = mysqli_real_escape_string($conn, $_POST['instalogin']);
		

		$query = "UPDATE client SET 
			name_client = ' $nom1',
			email_client = '$email1',
			login_fb = '$login_fb1',
			login_insta = '$login_insta1',
			id_memebership = $membership1
			WHERE num_client = '$id'";
		     
		if (mysqli_query($conn, $query)) 
		{
			$query = "delete from adress where id_client='$id'";
			mysqli_query($conn, $query);
			$number = count($_POST["name"]);
			
			
		if($number > 0) { 
		$message = false;
		for($i=0; $i<$number; $i++) {
         if(trim($_POST["name"][$i] != '')) { 
             $sql = "INSERT INTO adress(desc_adress,city,PostalCode,id_client) VALUES('".$_POST["name"][$i]."' ,'".$_POST["city"][$i]."','".$_POST["codeP"][$i]."','$id')";
             mysqli_query($conn, $sql);
             $message = true;
         } else {
             echo "Please Enter Name";
         }
		
		}}
		
		    $query = "delete from contactdetails where num_client='$id'";
			mysqli_query($conn, $query);
			$number2 = count($_POST["numero"]);
		
		if($number2 > 0) { 
		$message = false;
		for($i=0; $i<$number2; $i++) {
         if(trim($_POST["numero"][$i] != '')) { 
             $sql = "INSERT INTO contactdetails(num_phone,num_client) VALUES('".$_POST["numero"][$i]."','$id')";
             mysqli_query($conn, $sql);
             $message = true;
         } else {
             echo "Please Enter Name";
         }
		

		
		}}
		
			header("Location:clients.php");
		}

		else
		{
			echo "ERROR". mysqli_error($conn);
		}
	}
				

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
		  
		  <style>
             .padding_t_b {
                 padding: 3px 0;
             }
			 
        </style>
</head>
<?php

include ('navbar.php');

?>
<body  style="margin:10%">
	
	<div class="container">
    	<h1>Modifier Client</h1>
		<form method="POST" action="gestionClient.php" autocomplete="off">
		<?php
						if((int)$membership==1){
		echo '<input type="radio" id="silver" name="drone" value="1" checked style="margin-left:10%;height: 25px;width: 25px; vertical-align: middle; background-color: #ffa500;">
                <label for="huey" style="font-weight:bold;font-size:23px;">Silver</label>
                <input type="radio" id="gold" name="drone" value="2" style="margin-left:10%;height: 25px;width: 25px; vertical-align: middle;">
                <label for="dewey"style="font-weight:bold;font-size:23px;" >Gold</label>
                <input type="radio" id="Platinum" name="drone" value="3" style="margin-left:10%;height: 25px;width: 25px; vertical-align: middle;">
                <label for="louie" style="font-weight:bold;font-size:23px;">Platinum</label>
	';}
	else if((int)$membership==2){
		echo '
		<input type="radio" id="silver" name="drone" value="1"  style="margin-left:10%;height: 25px;width: 25px; vertical-align: middle; background-color: #ffa500;">
                <label for="huey" style="font-weight:bold;font-size:23px;">Silver</label>
                <input type="radio" id="gold" name="drone" value="2" checked style="margin-left:10%;height: 25px;width: 25px; vertical-align: middle;">
                <label for="dewey"style="font-weight:bold;font-size:23px;" >Gold</label>
                <input type="radio" id="Platinum" name="drone" value="3" style="margin-left:10%;height: 25px;width: 25px; vertical-align: middle;">
                <label for="louie" style="font-weight:bold;font-size:23px;">Platinum</label>
	';}
	else{ echo '
			<input type="radio" id="silver" name="drone" value="1"  style="margin-left:10%;height: 25px;width: 25px; vertical-align: middle; background-color: #ffa500;">
				<label for="huey" style="font-weight:bold;font-size:23px;">Silver</label>
                <input type="radio" id="gold" name="drone" value="2" style="margin-left:10%;height: 25px;width: 25px; vertical-align: middle;">
                <label for="dewey"style="font-weight:bold;font-size:23px;" >Gold</label>
                <input type="radio" id="Platinum" name="drone" value="3" checked style="margin-left:10%;height: 25px;width: 25px; vertical-align: middle;">
                <label for="louie" style="font-weight:bold;font-size:23px;">Platinum</label>
	';}
			

				
		
		?>
		 	
		 		<div class="form-group">
		 			<label for="nom">Nom: </label>
		 			<input type="text" name="nom" class="form-control" required value="<?php echo $nom ?>">
		 		</div>
		 		
		 		<div class="form-group">
		 			<label for="email">Email: </label>
		 			<input type="email" name="email" class="form-control" required value="<?php echo $email ?>">
		 		</div>
				<div class="form-group">
		 			<label for="fblogin">login facebook: </label>
		 			<input  name="fblogin" class="form-control"  value="<?php echo $login_fb ?>">
		 		</div>
				<div class="form-group">
		 			<label for="instalogin">login instagrame: </label>
		 			<input  name="instalogin" class="form-control"  value="<?php echo $login_insta ?>">
		 		</div>
		 	
		 		
		 		<div>
		 			<input type="hidden" name="id" value="<?php echo $update_id ?>">
		 		</div>
				<?php
				$result=mysqli_query($conn,"SELECT count(*) as total from adress where id_client = '". $update_id."'");
				$data=mysqli_fetch_assoc($result);
				
				if(((int)$data['total'])>0){
				$query = "SELECT * FROM adress where id_client = '". $update_id."'";
				$result = mysqli_query($conn, $query);
				$row = $result->fetch_array();
			
			echo '
			<div style="margin-top:60px"/> 
			<label for="adress" style="font-weight:bold;font-size:19px;float:left">Adresses: </label>
			<div class="col-md-4" style="margin-left:10%">
                         <button type="button" name="add" id="add_field" class="btn btn-success"> ajouter une adresses </button>
                      </div>
					  
					<div id="dynamic_field_append">
                  <div class="row padding_t_b">
					  
					  ';
					  $i=0;
        do
        {
					$i++;
            echo'
			
                     <div class="row padding_t_b" id="row_remove'.$i.'" style="margin-left:3%;margin-top:10px"> 
					 <label for="city" style="" >adresse'.$i.' : </label>
					 <div class="col-md-6 col-md-offset-2"><input type="text" name="name[]" placeholder="Adresse" class="form-control" value="'. $row['desc_adress'] .'"required/>
					 <input type="text" name="codeP[]" placeholder="code postale" class="form-control"style="margin-top:10px" pattern="[0-9]+" value="'. $row['PostalCode'] .'"required/>
					 <input type="text" name="city[]" placeholder="ville" class="form-control"style="margin-top:10px" value="'. $row['city'] .'"required/>
					 </div>
					 <div class="col-md-4"><button type="button" name="remove" id="'.$i.'" class="btn btn-danger btn_remove">Remove (X)</button>
					 </div>
             
                      
                 
			  
			  ' 
			  ;
        }while ($row = $result->fetch_array());


			echo '    </div></div></div "> ';
			  
				}
	
				if(((int)$data['total'])==0){
					$i=0;
				echo'
				 <div style="margin-top:60px;margin-bottom:30px"/> 
					  <div id="dynamic_field_append">
							<div class="row padding_t_b">
                      
							<label for="adress" style="font-weight:bold;font-size:19px;float:left">Adresses: </label>
							<div class="col-md-4" style="margin-left:10%">
							<button type="button" name="add" id="add_field" class="btn btn-success"> ajouter une adresses </button>
							</div>
					   </div>
				  <p>Aucune adresse trouvée</p>
				</div>
					   <div class="row padding_t_b" id="row_remove2'.$i.'" style="margin-left:0%;margin-top:10px"> 
								</div>
						
								</div></div>';
					
				}
	
	
	
				$result=mysqli_query($conn,"SELECT count(*) as total from contactdetails where num_client = '". $update_id."'");
				$data=mysqli_fetch_assoc($result);
				
				
				if(((int)$data['total'])>0){
					
				$query = "SELECT * FROM contactdetails where num_client = '". $update_id."'";
				$result = mysqli_query($conn, $query);
				$row = $result->fetch_array();
					
					echo'
					<div style="margin-top:60px"/> 
					<label for="numero" style="font-weight:bold;font-size:19px;float:left;margin-top:10px">numero de telephone : </label> 
					<div class="col-md-4" style="margin-left:20%;margin-top:10px">
                         <button type="button" name="add" id="add_field2" class="btn btn-success"> ajouter plus de numero </button>
                      </div>
					 <div id="dynamic_field_append2">
					<div class="row padding_t_b2">
					
					
					
					
					';
					$i2=0;
		do{
						$i2++;
						echo '
								<div class="row padding_t_b" id="row_remove2'.$i2.'" style="margin-left:0%;margin-top:10px"> 
								<label for="city" style="" >numero de tele '.$i2.' : </label><div class="col-md-6 col-md-offset-2">
								<input type="text" name="numero[]" placeholder="numero de telephone" class="form-control" style="margin-top:10px" pattern="[0-9]+" value="'. $row['num_phone'] .'"required>
								</div><div class="col-md-4"><button type="button" name="remove2" id="'.$i2.'" class="btn btn-danger btn_remove2">Remove (X)</button></div></div>';
 
					
					
					
        }while ($row = $result->fetch_array());


echo '      </div>
			  </div>
			  
              <br>
              
         </div> 
		 </div> ';
			  
				}
					
					
					if(((int)$data['total'])==0){
						$i2=0;
						echo'
						<div style="margin-top:60px;margin-bottom:30px"/> 
					  <div id="dynamic_field_append2">
						<div class="row padding_t_b">
                     <label for="adress" style="font-weight:bold;font-size:19px;float:left">numero de telephone : </label>
                      <div class="col-md-4">
                         <button type="button" name="add" id="add_field2" class="btn btn-success"> ajouter plus de numero </button>
                      </div>
					</div>
					<p>Aucun numéro de téléphone trouvé</p>
				</div>
					
					             <div class="row padding_t_b" id="row_remove2'.$i2.'" style="margin-left:0%;margin-top:10px"> 
								
								
								</div><div class="col-md-4"></div></div>';
 
					
					;
						
					}
					
				
	
	
		
				?>
		 		<input type="submit" name="submit" value="modifier" class="btn btn-success " style="width:40%;margin-left:20%;font-weight:bold;font-size:23px;">
		</form>
    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS. -->
    <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        function logout()
        {
            swal
            ({
                title: "êtes vous sur?",
              text: "vous allez vous déconnecter",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) 
              {
                window.location.href= "logout.php";
              }
            });
        }
    </script>
	
	
	<script>
          $(document).ready(function(){ 
               var i = "<?php echo $i; ?>";
               $('#add_field').click(function(){  
                   i++;  
                   $('#dynamic_field_append').append('<div class="row padding_t_b" id="row_remove'+i+'" style="margin-left:3%;margin-top:10px"> <label for="city" style="" >autre adresse : </label><div class="col-md-6 col-md-offset-2"><input type="text" name="name[]" placeholder="Adresse" class="form-control" required/><input type="text" name="codeP[]" placeholder="code postale" class="form-control"style="margin-top:10px" pattern="[0-9]+" required><input type="text" name="city[]" placeholder="ville" class="form-control"style="margin-top:10px" required></div><div class="col-md-4"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Remove (X)</button></div></div>');
               });
               $(document).on('click', '.btn_remove', function() {
                   var button_id = $(this).attr("id");
                   $('#row_remove'+button_id+'').remove();
               });
               $('#submit').click(function() {
                   $.ajax({
                       url:"process.php",
                       method:"POST",
                       data:$('#dynamic_form').serialize(),
                       success:function(data) {  
                           alert(data);
                           $('#dynamic_form')[0].reset();
                       }
                   });
               });
       

				 var i2 = "<?php echo $i2; ?>";;
               $('#add_field2').click(function(){  
                   i2++;  
                   $('#dynamic_field_append2').append('<div class="row padding_t_b2" id="row_remove2'+i2+'" style="margin-left:0%;margin-top:10px"> <label for="city" style="" >autre numero de tele : </label><div class="col-md-6 col-md-offset-2"><input type="text" name="numero[]" placeholder="numero de telephone" class="form-control" style="margin-top:10px" pattern="[0-9]+" required></div><div class="col-md-4"><button type="button" name="remove2" id="'+i2+'" class="btn btn-danger btn_remove2">Remove (X)</button></div></div>');
               });

			$(document).on('click', '.btn_remove2', function() {
                   var button_id = $(this).attr("id");
                   $('#row_remove2'+button_id+'').remove();
               });



	   })
;
      </script>
</body>
</html>