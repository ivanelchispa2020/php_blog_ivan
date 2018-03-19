<?php 

class conectar{
	
	    public static function con(){
			
	    	/*
postgres://jswhtriiboqhin:d6480f72a9f8b6fb469e9450ffd8ef7bb23e1897dd3681a36273ceee2da315d9@ec2-23-21-238-246.compute-1.amazonaws.com:5432/dejvpcqv9sunoj
	    	*/


			try{
   $con=new PDO("pgsql:host=ec2-23-21-238-246.compute-1.amazonaws.com;port=5432;dbname=dejvpcqv9sunoj;user=jswhtriiboqhin;password=d6480f72a9f8b6fb469e9450ffd8ef7bb23e1897dd3681a36273ceee2da315d9");
			 $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			 return $con;
			}catch(PDOException $e){
				 echo "ERROR AL CONECTAR LA BASE DE DATOS ".$e->getMessage();
				 exit();
				}
			
			}
	
	
	}

class trabajo{
	
		        private $articulos=array();
		        private $categorias=array();
				   private $ultimosRegistros=array();
	           private $contarRegistro=array();
			      private $id_articulo=array();
				    private $buscador=array();
				    private $contarBuscador=array();
	            private $contarRegistro2=array();			
				    private $comentarios=array();
		         private $respuestas=array();
	            private $contarId=array();
			     	private $contarCom=array();
			     	private $encuesta=array();
						private $lista_comentarios=array();
						private $lista_respuesta=array();



			public function getArticulos(){
			
				    $con=conectar::con();
	
					
		    if(isset($_GET["c"])){
				  $c=$_GET["c"];
				  if(!is_numeric($c)|| is_null($c)||empty($c)){

					   echo "<script>window.location='index.php';</script>";
					   echo "<script>window.history.back();</script>";
					   
					   exit;
					  }
				}				
			if(isset($_GET["c"])){
				  
				  $c=strip_tags($_GET["c"]);		
				$sql="SELECT * FROM ARTICULOS WHERE CAT=:cat";
				 $res=$con->prepare($sql);
            			$res->bindParam(":cat",$c,PDO::PARAM_INT);
		
				}

				else{
				$sql="SELECT * FROM ARTICULOS";
				 $res=$con->prepare($sql);
            			
				}
			
	 	
			$res->execute();
           
	    foreach($res as $reg){
					$this->contarRegistro[]=$reg;
				}
		 	$totalRegistros= sizeof($this->contarRegistro);            
          		   
		   
		  ///// PAGINACION
		$regPax=5;
		$pagina=false;
		
		
		if(isset($_GET["p"])){
			$pagina=strip_tags($_GET["p"]);
		
			if(!is_numeric($pagina)|| is_null($pagina)|| empty($pagina)){
				
		      echo "<script>window.history.back()</script>";  
		       echo "<script>window.location='index.php';</script>";
					exit;		
				};
			
			}
	   
		
		if(isset($_GET["p"])){
			  
			  $pagina=$_GET["p"];
			}
		if(!$pagina){
			$inicio=0;
			$pagina=1;
		 }	else{
            $inicio=($pagina-1)*$regPax;
	  	 }		
			 
	    /// CALCULO EL TOTAL DE PAGINAS
		
		$totalPaginas=ceil($totalRegistros/$regPax); /// PARA  DETERMINAR LA CANTIDAD DE PAGINAS			
        
		  
		$con=conectar::con();	
		if(isset($_GET["c"])){
				  $c=$_GET["c"];
				  if(!is_numeric($c)|| is_null($c)||empty($c)){
					   echo "<script>window.history.back()</script>";
					   header("Location: index.php");
					  }
				}				
									
			if(isset($_GET["c"])){	
			      $c=strip_tags($_GET["c"]);
			    			
				$sql="SELECT * FROM ARTICULOS WHERE CAT=$c LIMIT ".$regPax." OFFSET ".$inicio;
				}else{
					$sql="SELECT * FROM ARTICULOS LIMIT ".$regPax."OFFSET ".$inicio;
					}

			$res=$con->prepare($sql);
			$res->execute();
			
			foreach($res as $reg){
					$this->articulos[]=$reg;
				}
					return $this->articulos;		
                   
		}
	
		public function cambiarFecha($fecha) {
						  return implode("-", array_reverse(explode("-", $fecha)));
						} 
						
						
	
          public function getCategorias(){
			   
			  
				$con=conectar::con();
				$sql="SELECT * FROM CATEGORIAS";
				$res=$con->prepare($sql);
				$res->execute();
				
				foreach($res as $reg){
						$this->categorias[]=$reg;			
					}    return $this->categorias;
		   
		   
		   }
		   
		   
		   public function get_id_articulo(){
			     if(isset($_GET["id"])){
					  $id=$_GET["id"];
	
					    if(!is_numeric($id)|| is_null($id) || empty($id)){
				
				      echo "<script>window.location='index.php';</script>";
							
					   echo "<script>window.history.back()</script>";
                     	exit;
						}
	
	
					 }
			       
			      $con=conectar::con();
				  $sql="SELECT * FROM ARTICULOS WHERE ID=:id"; 
				  
				  $id=strip_tags($id);
				  $res=$con->prepare($sql);
				  $res->bindParam(":id",$id,PDO::PARAM_INT);
				  $res->execute();
				
				  if($res->rowCount()==0){
					   echo "<script>window.history.back()</script>";
					  
					  } 
				  foreach($res as $reg){
						$this->id_articulo[]=$reg;			
					}    return $this->id_articulo;
		      
			     
				  
			   
			   
			   }
		   
           
		   public function ultimosArticulos(){
			     $con=conectar::con();
				 $sql="SELECT * FROM ARTICULOS ORDER BY FECHA DESC LIMIT 5 ";
				 $res=$con->prepare($sql);
				 $res->execute();
				 
				 	foreach($res as $reg){
							$this->ultimosRegistros[]=$reg;						
						}
			   				return $this->ultimosRegistros;
			   }

          
		  public function contarRegistros(){
			     $con=conectar::con();
				
            if(isset($_GET["c"])){
				  $c=$_GET["c"];
				  if(!is_numeric($c)|| is_null($c)||empty($c)){

					   echo "<script>window.location='index.php';</script>";
					   echo "<script>window.history.back();</script>";
					   
					   exit;
					  }
				}			
			if(isset($_GET["c"])){	
			      $c=$_GET["c"];
			    			
				$sql="SELECT * FROM ARTICULOS WHERE CAT=$c";
				
				
				}else{
					$sql="SELECT * FROM ARTICULOS";
					}
				 
				 $res=$con->prepare($sql);
				 $res->execute();
				 
				   foreach($res as $reg){
					$this->contarRegistro[]=$reg;
				}
		 	$totalRegistros= sizeof($this->contarRegistro);            
          	
			return $totalRegistros;	   	  
			  
			  
			  }         
   
   
   //////////////// PARA AUTOCOMPLETAR ********//////////
			
		private $resultados=array();
		
		public function autocompletar()
		
	{
		if(isset($_POST["word"]))
		{
			if($_POST["word"]{0}=="*")
			{
				$sql="select "
					." titulo "
					." from "
					." articulos "
					." where "
					." titulo like '%".substr($_POST["word"],1)."%' "
					." and "
					." titulo <> '".$_POST["word"]."' limit 9 ";
			}else
			{
				$sql="select "
					." titulo "
					." from "
					." articulos "
					." where "
					." titulo like '%".$_POST["word"]."%' "
					." and "
					." titulo <> '".$_POST["word"]."' limit 9";
			}

		
			$con=conectar::con();
			$res=$con->query($sql);
				foreach($res as $reg)
			{
			$dato=utf8_decode(utf8_encode($reg["titulo"]));
				// Mostramos las lineas que se mostrarán en el desplegable. Cada enlace
				// tiene una funcion javascript que pasa los parámetros necesarios a la
				// función selectItem
				echo "<a class='btn btn-default' onclick='from('$dato','respuesta','Views/resultados.php')'>$dato</a><br>";

			}
		}
	}
	
   
   
	public function get_buscador(){
    
	     
		 $con=conectar::con();
	

		 
	$sql="SELECT * FROM ARTICULOS WHERE 
						 TITULO LIKE '%".htmlentities(utf8_decode(utf8_encode($_GET["id"])))."%' OR
						 PARRAFO LIKE '%".htmlentities(utf8_decode(utf8_encode($_GET["id"])))."%' OR
						 DESCRIPCION LIKE '%".htmlentities(utf8_decode(utf8_encode($_GET["id"])))."%' 
						 ";		
	    	$res=$con->prepare($sql);
		
		
			$res->execute();
      
	    foreach($res as $reg){
					$this->contarBuscador[]=$reg;
				}
		 	$totalRegistros= sizeof($this->contarBuscador);            
        
	
	            
		  ///// PAGINACION
		$regPax=5;
		$pagina=false;
		   
		
		if(isset($_GET["pa"])){
			  
			  $pagina=$_GET["pa"];
			}
		if(!$pagina){
			$inicio=0;
			$pagina=1;
		 }	else{
            $inicio=($pagina-1)*$regPax;
	  	 }		
			 
	    /// CALCULO EL TOTAL DE PAGINAS
		
		$totalPaginas=ceil($totalRegistros/$regPax); /// PARA  DETERMINAR LA CANTIDAD DE PAGINAS			
        
		  

							
						$con=conectar::con();
						$sql="SELECT * FROM ARTICULOS WHERE 
						 TITULO LIKE '%".htmlentities(utf8_decode(utf8_encode($_GET["id"])))."%' OR
						 PARRAFO LIKE '%".htmlentities(utf8_decode(utf8_encode($_GET["id"])))."%' OR
						 DESCRIPCION LIKE '%".htmlentities(utf8_decode(utf8_encode($_GET["id"])))."%' 
						 LIMIT ".$regPax." OFFSET ".$inicio;		
							
						$res=$con->query($sql);
					foreach($res as $reg){
							$this->buscador[]=$reg;
						}
							return $this->buscador;
					}
	   
   
   
   
   
   
		  public function contarRegistrosBuscador(){
			     $con=conectar::con();
				
				$sql="SELECT * FROM ARTICULOS WHERE 
						 TITULO LIKE '%".htmlentities(utf8_decode(utf8_encode($_GET["id"])))."%' OR
						 PARRAFO LIKE '%".htmlentities(utf8_decode(utf8_encode($_GET["id"])))."%' OR
						 DESCRIPCION LIKE '%".htmlentities(utf8_decode(utf8_encode($_GET["id"])))."%' 
						 ";
				
				 
				 $res=$con->prepare($sql);
				 $res->execute();
				 
				   foreach($res as $reg){
					$this->contarRegistro2[]=$reg;
				}
		 	$totalRegistros= sizeof($this->contarRegistro2);            
          	
			return $totalRegistros;	   	  
			  
			  
			  }         
   
   
   
   
            public function listComentarios(){
						
				  $con=conectar::con();
				 $sql="SELECT * FROM COMENTARIOS WHERE ID_ARTICULO=".$_GET["id"]." ORDER BY ID_COM ASC";
				 $res=$con->prepare($sql);
				 $res->execute();
				 
				 	foreach($res as $reg){
							$this->lista_comentarios[]=$reg;						
						}
			   			return $this->lista_comentarios;					
				}

			
   
   
    	public function getCuentaArticulos(){
			  
			  			     $con=conectar::con();
				  if(isset($_GET["id"])){
					  $id=$_GET["id"];
	
					    if(!is_numeric($id)|| is_null($id) || empty($id)){
				
				      echo "<script>window.location='index.php';</script>";
							
					   echo "<script>window.history.back()</script>";
                     	exit;
						}
						
				  }
				  
				$sql="SELECT * FROM COMENTARIOS WHERE ID_ARTICULO=".$id;
				 
				 $res=$con->prepare($sql);
				 $res->execute();
				 
				   foreach($res as $reg){
					$this->contarId[]=$reg;
				}
		 	        return sizeof($this->contarId);   	  
			  

			  
			}
   
   
   public function insert_comentarios($nombre_imagen){
 

	 $con=conectar::con();
	$sql="insert into comentarios  (id_articulo, id_com,comentario,nombre,correo,web,fecha,hora,imagen) values(
	 '".strip_tags($_POST["id_articulo"])."',
	 '".strip_tags($_POST["id_com"])."',
	 '".strip_tags($_POST["txt_mensaje"])."',
	 '".strip_tags($_POST["txt_nombre"])."',
	 '".strip_tags($_POST["txt_email"])."',
	 '".strip_tags($_POST["txt_web"])."',
	now(),now(),
	 '".$nombre_imagen."'
	 )";

	$res=$con->query($sql);
		
  	}
		
 public function insert_respuestas($nombre_imagen,$i){

	 $con=conectar::con();
	$sql="insert into respuestas  (id_articulo, id_com,comentario,correo,web,fecha,hora,imagen) values(
	 '".strip_tags($_POST["id_articulo"])."',
	 '".strip_tags($_POST["id_com"])."',
	 '".strip_tags($_POST["txt_mensaje_".$i])."',
	 '".strip_tags($_POST["txt_email_".$i])."',
	 '".strip_tags($_POST["txt_web_".$i])."',
	now(),now(),
	 '".$nombre_imagen."'
	 )";

	$res=$con->query($sql);

	}

     public function muestra_respuestas($id_com){	
		 
	   $con=conectar::con();  
     $sql="SELECT * FROM RESPUESTAS WHERE ID_COM=".$id_com;
     $res=$con->prepare($sql);
     $res->execute();
	
	 foreach($res as $reg){
		     $this->lista_respuesta[]=$reg;
		 }
		    return $this->lista_respuesta;
	 }
  




   public function totalComentarios($id){
	   
	 $con=conectar::con();
	   
     $sql="SELECT * FROM COMENTARIOS WHERE ID_ARTICULO=".strip_tags($id);
     $res=$con->prepare($sql);
     $res->execute();
	
	  return $res->rowCount();
	
	   
	   }




    public function insertEncuesta(){
		
	 $con=conectar::con();  	 
 	 $sql=" UPDATE ENCUESTAS SET  ".strip_tags($_POST["radio"])."=(".strip_tags($_POST["radio"])." + 1 ) WHERE  ID_ARTICULO=".strip_tags($_POST["id_articulo"])."";
    
	  $res=$con->prepare($sql);
     $res->execute();
	

		}


     public function muestra_encuesta(){	
		 
	 $con=conectar::con();  
     $sql="SELECT * FROM ENCUESTAS WHERE ID_ARTICULO=".$_GET["id"];
     $res=$con->prepare($sql);
     $res->execute();
	
	 foreach($res as $reg){
		     $this->encuesta[]=$reg;
		 }
		    return $this->encuesta;
	 }
  
}






?>




