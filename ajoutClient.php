<?php

     include ('./connexion.php');

	if (isset($_POST['submit']))
	{
		
		$result=mysqli_query($conn,"SELECT count(*) as total from client");
		$data=mysqli_fetch_assoc($result);
	
		$id="22-SPR-".$data['total'];
		$nom = mysqli_real_escape_string($conn, $_POST['nom']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);

		$face=mysqli_real_escape_string($conn, $_POST['facebook']);
		$insta=mysqli_real_escape_string($conn, $_POST['insta']);
		

		$query = "INSERT INTO client(num_client,name_client, email_client,login_fb,login_insta, id_memebership) VALUES('$id','$nom', '$email','$face','$insta', 1)";

		$membership=(int)mysqli_real_escape_string($conn, $_POST['drone']);
		$tel = mysqli_real_escape_string($conn, $_POST['tel']);
		

		$query = "INSERT INTO client(num_client,name_client, email_client, id_memebership) VALUES('$id','$nom', '$email',1)";

		
		

		$query = "INSERT INTO client(num_client,name_client, email_client, id_memebership) VALUES('$id','$nom', '$email', 1)";

		if (mysqli_query($conn, $query)) 
		{
			
			$query = "INSERT INTO comptefidelite(date_création,	points, num_client ) VALUES(curdate(),100, '$id')";
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
		

			header("Location: clients.php");
		}}
		
		
		
		}

		else
		{
			echo "ERROR". mysqli_error($conn);
		}
		
	}
     
    
 
		
		
		
?>