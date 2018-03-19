<?php 


include('../Models/gestiona.php');



$tra=new trabajo();
$tra->insertEncuesta();

header('Location: https://blog-php-ivan.herokuapp.com/index.php?id='.$_POST["id_articulo"]);

  ?> 
