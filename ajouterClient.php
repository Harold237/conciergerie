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

<body  >
  <div style="margin:10%;margin-right:20%" >

  <h1>Ajouter Client</h1>
  

  
  
	<form method="POST" action="ajoutClient.php" id="add" name="add" autocomplete="off">
				
		 		
                <div class="form-group">
		 			<label for="nom" style="font-weight:bold;font-size:19px;">Nom: </label>
		 			<input type="text" name="nom" class="form-control" required>
		 		</div>
                <div class="form-group" Style="margin-top:10px;margin-bottom:10px;">
		 			<label for="adress" style="font-weight:bold;font-size:19px;float:left">Adresse: </label>
					
					
			
               <div id="dynamic_field_append">
                  <div class="row padding_t_b">
                      <div class="col-md-6 col-md-offset-2">
                        <input type="text" name="name[]" placeholder="Adresse" class="form-control" style="margin-top:10px" required>
						<input type="text" name="codeP[]" placeholder="code postale. exp:72000" class="form-control"style="margin-top:10px" pattern="[0-9]+" required>
						<input type="text" name="city[]" placeholder="ville" class="form-control"style="margin-top:10px" required>
                      </div>
                      <div class="col-md-4">
                         <button type="button" name="add" id="add_field" class="btn btn-success"> ajouter une adresses </button>
                      </div>
                  </div>
              </div>
			  
			  
              <br>
              
         </div>
				
				
				   <div class="form-group" Style="margin-top:10px;margin-bottom:10px;">
		 			<label for="numero" style="font-weight:bold;font-size:19px;float:left">numero de telephone : </label>
					
					
			
               <div id="dynamic_field_append2">
                  <div class="row padding_t_b">
                      <div class="col-md-6 col-md-offset-2">
                        <input type="text" name="numero[]" placeholder="exemple: 0633548421" class="form-control" style="margin-top:10px" pattern="[0-9]+" required>
						
                      </div>
                      <div class="col-md-4">
                         <button type="button" name="add" id="add_field2" class="btn btn-success"> ajouter un numero de tele  </button>
                      </div>
                  </div>
              </div>
			  
			  
              <br>
              
         </div>
				
				
				
				
		 		
		 		
		 		<div class="form-group">
		 			<label for="email" style="font-weight:bold;font-size:19px;" >Email: </label>
		 			<input type="email" name="email" class="form-control" placeholder="exemple@exemple.exemlp" required>
		 		</div>
             
		 		<input type="submit" name="submit" value="Ajouter"  class="btn btn-success " style="width:40%;margin-left:20%;font-weight:bold;font-size:23px;">
		</form>


</section>
      </div>
 <script>
          $(document).ready(function(){ 
               var i = 1;
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
       

				 var i2 = 1;
               $('#add_field2').click(function(){  
                   i2++;  
                   $('#dynamic_field_append2').append('<div class="row padding_t_b" id="row_remove2'+i2+'" style="margin-left:0%;margin-top:10px"> <label for="city" style="" >autre numero de tele : </label><div class="col-md-6 col-md-offset-2"><input type="text" name="numero[]" placeholder="numero de telephone" class="form-control" style="margin-top:10px" pattern="[0-9]+" required></div><div class="col-md-4"><button type="button" name="remove2" id="'+i2+'" class="btn btn-danger btn_remove2">Remove (X)</button></div></div>');
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