<?php 


include('../Models/gestiona.php');

$i=$_POST["i"];

 if(isset($_FILES['imagen_upload_'.$i])){

	  if($_FILES['imagen_upload_'.$i]['type'] !='jpg' || $_FILES['imagen_upload_'.$i]['type'] !='png' || $_FILES['imagen_upload_'.$i]['type'] !='gif'){
	  	  header('Location: /index.php?id="'.$_POST["id_articulo"].'"&i');
	  };

	if($_FILES['imagen_upload_'.$i]['size'] >= 1024000){
		  header('Location: /index.php?id="'.$_POST["id_articulo"].'"&g');
	}


	$new_file_name = strtolower($_FILES['imagen_upload_'.$i]['name']); //rename file
		
	if (move_uploaded_file($_FILES['imagen_upload_'.$i]['tmp_name'], '../imagenes/avatares/'.$new_file_name)) {
	   
	} else {
	    header('Location: /index.php?id="'.$_POST["id_articulo"].'"&h');
	}

}

$nombre_imagen=$_FILES['imagen_upload_'.$i]['name'];


$tra=new trabajo();
$tra->insert_respuestas($nombre_imagen,$i);

header('Location: /index.php?id='.$_POST["id_articulo"]);





?>