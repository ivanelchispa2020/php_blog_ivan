<?php 


include('../Models/gestiona.php');



 if(isset($_FILES['imagen_upload'])){

	  if($_FILES['imagen_upload']['type'] !='jpg' || $_FILES['imagen_upload']['type'] !='png' || $_FILES['imagen_upload']['type'] !='gif'){
	  	  header('Location: /index.php?id="'.$_POST["id_articulo"].'"&i');
	  };

	if($_FILES['imagen_upload']['size'] >= 1024000){
		  header('Location: /index.php?id="'.$_POST["id_articulo"].'"&g');
	}


	$new_file_name = strtolower($_FILES['imagen_upload']['name']); //rename file
		
	if (move_uploaded_file($_FILES['imagen_upload']['tmp_name'], '../imagenes/avatares/'.$new_file_name)) {
	   
	} else {
	    header('Location: /index.php?id="'.$_POST["id_articulo"].'"&h');
	}

}

$nombre_imagen=$_FILES['imagen_upload']['name'];

$tra=new trabajo();
$tra->insert_comentarios($nombre_imagen);

header('Location: /index.php?id='.$_POST["id_articulo"]);


  ?> 
