<?php
session_start();
	$imagen=imagecreate(100,35);
	$fondo=imagecolorallocate($imagen,150,80,180);
          $texto=imagecolorallocate($imagen,250,150,80);
	
	$_SESSION['tmptxt']=$aleatorio=rand(100000,999999);
	
	ImageFill($imagen,50,0,$fondo);
	imagestring($imagen,100,25,10,$aleatorio,$texto);
	header('content-type: image/png');
	imagepng($imagen);
	
		
?>