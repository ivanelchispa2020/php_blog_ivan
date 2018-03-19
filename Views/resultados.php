<?php  



if(isset($_GET["pa"])){
	  $_GET["pa"];
	}else{
		$_GET["pa"]=1;
		
		}
				
	include("../Models/gestiona.php");
	$tra=new trabajo();
	$datos=$tra->get_buscador();
	
	foreach($datos as $reg){
		?>
	
    
  <a  href="#ventana<?php echo $reg["id"]; ?>" class="thumb pull-left" data-toggle="modal" title="<?php  echo utf8_decode(utf8_encode($reg["titulo"]));?>">
 <img src="imagenes/imagen<?php echo $reg["id"]; ?>.jpg" class="img-thumbnail" alt="imagen_<?php echo utf8_decode(utf8_encode($reg["titulo"])); ?> "/>
  </a>   


       <div class="modal fade" id="ventana<?php echo $reg["id"]; ?>">
                    	<div class="modal-dialog">
                        		<div class="modal-content">
                                				<!--HEADER DE LA VENTANA-->
                                		<div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        	<h4 class="modal-title"><?php echo utf8_decode(utf8_encode($reg["titulo"])); ?></h4>
                                        </div>
                                        		<!--CONTENIDO DE LA VENTANA-->
                                        <div class="modal-body">
         <img src="imagenes/imagen<?php echo $reg["id"]; ?>.jpg" class="img-responsive" alt="<?php echo utf8_decode(utf8_encode($reg["titulo"])); ?>"/>
                              		<p >Hola a todos. Esta Imagen fue subida el <strong>
                              		<?php echo date('Y-m-d H:i:s',strtotime($reg["fecha"])); ?>
                              			
                              		</strong>    y fue publicado por <strong><i>Iván Sergio Lopez</i></strong>.
                                                 </p>
                                        </div>
                                        		<!--FOOTER DE LA VENTANA-->
                                         <div class="modal-footer">                     
                                	<button type="button" class="btn btn-primary" data-dismiss="modal">CERRAR</button>
                                         </div>       
                                                
                                </div>
                        </div>
                    </div>
                  

         <h2 class="post-title">
                       <a href="?id=<?php echo $reg["id"]; ?>">
      <?php echo utf8_decode(utf8_encode($reg["titulo"])); ?>
      
                       </a>
                    </h2>
                    <p>
                       <span class="post-fecha"> <?php echo date('Y-m-d H:i:s',strtotime($reg["fecha"])); ?></span> por <span class="post-autor">
                            <a href="#ventana1" class="btn btn-link" data-toggle="modal">Iván Lopez</a>

                       </span>
                    </p>
                    <p class="post-contenido text-justify">
    <?php echo utf8_decode(utf8_encode(str_ireplace("".$_GET["id"]."","<span class='busca'>".$_GET["id"]."</span>",$reg["parrafo"]))); ?>
       
                   
                    </p>
                   
                   <div class="contenedor-botones">
                   			<a href="?id=<?php echo $reg["id"]; ?>" class="btn btn-primary btn_leer_mas">Leer Mas</a>
                            <a  class="btn btn-success btn_comentarios">Comentarios <span class="badge"><?php echo $tra->totalComentarios($reg["id"])?></span></a>
                   </div>
                   <div class="separador"></div>

<?php		
		}
		
		
		
	                 $cuenta=$tra->contarRegistrosBuscador();
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
		
		$totalPaginas=ceil($cuenta/$regPax); /// PARA  DETERMINAR LA CANTIDAD DE PAGINAS			

        ?>
        
         <div><p>El numero de resultados encontrados es de <?php echo $cuenta ?></p><br>
		      <p>Pagina <?php echo $pagina ?> de <?php echo $totalPaginas ?></p><br>
		 </div>

	      <nav  class="pagination" id="pagination">
          <ul>
        <?php        
	    
		
      		 
         
       if($totalPaginas>1){
		   
		   ?>
		     <ul class='pagination pagination-lg' >
		   <?php 
		   if($pagina!=1){
			   ?>
              <li>
              <a
         onClick="from3('<?php echo $_GET['id'];?>',<?php echo ($pagina - 1) ?>,'respuesta','Views/resultados.php')">&laquo;
           </a>
              
              </li>

               <?php 
			  			   }
				  
				     for($i=1;$i<=$totalPaginas;$i++){
						 		
								if($pagina!=$i){
					
					?>
					
					      <li  class=''>
                          <a  class="btn btn-link active" onClick="from3('<?php echo $_GET['id'];?>',<?php echo $i ?>,'respuesta','Views/resultados.php')"><?php echo $i ?></a>
                          </li>
								 
					<?php 			 
								}else{
									
					?>
									 <li  class='active'><a><?php echo $i ?></a></li>
				    <?php  					
                                     }
						 
						 }
						 
			 if($pagina!=$totalPaginas){
				 
	             ?>			 
<li><a onClick="from3('<?php echo $_GET['id'];?>',<?php echo ($pagina + 1) ?>,'respuesta','Views/resultados.php')" >&raquo;</a>
                      </li>
			     <?php 
              
               }
			   ?>				  
		   </ul>
           
           <?php
		   }
			 
		    ?>
         </nav>		  
            <?php
				
	

	
	?>		 
	
                          

                              </ul>
<?php
				  
				 
?>
				
                
                