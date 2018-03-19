
<?php
			include("Models/gestiona.php");

function post_articulos(){
if(isset($_GET["id"])){
				$id=$_GET["id"];
				if(!is_numeric($id)|| is_null($id)||empty($id)){
							echo "<script>window.location='index.php';</script>";
							echo "<script>window.history.back();</script>";
							exit;
			}
				$tra=new trabajo();
			$datos=$tra->get_id_articulo();
							foreach($datos as $reg){	
?>

			<?php
				if(isset($_GET["i"])){
				?>
					<div>
					<h2>La imagen seleccionada no pertenece al formato adecuado: GIF. PNG. JPG.</h2>
					</div>
				<?php
				}
				?>
			<?php
			if(isset($_GET["g"])){
			?>
				<div>
				<h2>El tamaño de la imagen es demasiado grande...Por favor seleccione otra</h2>
				</div>
			<?php
			}
			?>
	
		<?php
			if(isset($_GET["h"])){
			?>
				<div>
				<h2>Ha ocurrido un error al intentar  subir la imagen.. Intentelo nuevamente..Gracias.</h2>
				</div>
			<?php
			}
			?>



<a  href="#ventana2" class="thumb pull-left" data-toggle="modal" title="<?php  echo utf8_decode(utf8_encode($reg["titulo"]));?>">
	<img src="imagenes/imagen<?php echo $reg["id"]; ?>.jpg" class="img-thumbnail" alt="imagen_<?php echo utf8_decode(utf8_encode($reg["titulo"])); ?> "/>
	</a>



										<div class="modal fade" id="ventana2">
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
																	<p >Hola a todos. Esta Imagen fue subida el
																	 <?php echo date('Y-m-d H:i:s',strtotime($reg["fecha"])); ?>
																		y fue publicado por Iván Sergio Lopez.
																									</p>
																				</div>
																						<!--FOOTER DE LA VENTANA-->
																					<div class="modal-footer">
																	<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
																					</div>

																</div>
												</div>
										</div>


										<h2  class="post-title">
												<button class="btn btn-link" id="titulo_resaltar">
													<span id="resaltame"><?php echo utf8_decode(utf8_encode($reg["titulo"])); ?></span>
											</button>

										</h2>
										<p>
						<span class="post-fecha"> <?php echo date('Y-m-d H:i:s',strtotime($reg["fecha"])); ?></span> por <span class="post-autor">
												<a href="#ventana1" class="btn btn-link" data-toggle="modal">Iván Lopez</a>

												</span>
										</p>
										<p class="post-contenido text-justify">
													<?php  echo utf8_decode(utf8_encode($reg["parrafo"]));?>
										</p>
										<p class="post-contenido text-justify">
													<span class="igualar"></span>
													<?php  echo utf8_decode(utf8_encode($reg["descripcion"]));?>
										</p>

										<div class="contenedor-botones">
												<a href="?id=<?php echo $reg["id"]; ?>" class="btn btn-primary btn_leer_mas">Leer Mas</a>
	<a  class="btn btn-success btn_comentarios">Comentarios <span class="badge"><?php echo $tra->totalComentarios($reg["id"]);?></span></a> <button type="button" name="graficos" class="btn btn-danger hidden-xs hidden-sm btn_encuestas" id="ver_encuesta"><span>Participa en nuestra encuesta..!!!</span></button>
										</div>
 
										<div class="separador"></div>
<?php  }
?>


<h3 class="resalta_titulo_encuesta hidden-xs hidden-ms">NUESTRA ENCUESTA..!!!</h3>
<div id="encuesta_grafico">
			<form name="form" method="post" action="Controllers/encuestas_ajax.php" enctype="application/x-www-form-urlencoded">
					<div class="form-group">
								<label for="option" class="tit">¿QUE TE HA PARECIDO EL ARTICÚLO?</label>
												<div class="radio">
														<label for="radio-1">
																<input type="radio" name="radio" id="radio-1" class="" value="resp_1" checked>Poco Útil
																				</label>
																							</div>
																								<div class="radio">
																									<label for="radio-2">
					<input type="radio" name="radio" id="radio-2" class="" value="resp_2">Regular
																									</label>
																										</div>
																										<div class="radio">
																										<label for="radio-3">
																					<input type="radio" name="radio" id="radio-3" class="" value="resp_3">Bueno
																											</label>
																											</div>
																											<div class="radio">
																												<label for="radio-4">
												<input type="radio" name="radio" id="radio-4" class="" value="resp_4">Interesante
																					</label>
																				</div>
																								<div class="radio">
																								<label for="radio-5">
														<input type="radio" name="radio" id="radio-5" class="" value="resp_5">Excelente
																																</label>
																																</div>
		<input type="hidden" name="id_articulo" value="<?php echo $_GET["id"] ?>">
		<button type="submit" class="btn btn-danger btn_votar_ahora" id="votar_gra">Vota Ahora.!!!</button>
														<button type="button" class="btn btn-info hidden-xs hidden-sm" id="ver_enc">Ver / Ocultar</button>
																												</div>
																								</form>
			</div>

<input  type="hidden" class="total_comentarios" value="<?php echo $tra->totalComentarios($reg["id"])?>
">

<div id="respuesta_graficos"></div>


<div id="piechart_3d" class="hidden-xs hidden-ms"></div>


<?php  
	$tra=new trabajo();
		$datos=$tra->listComentarios();
		$i=0;
					foreach($datos as $reg){
						$i++;
?>




<div class="comentario">
		<div class="media">
		  <div class="media-left media-middle">
	
	  <?php  
		         if($reg["imagen"]==""){
		  ?>
		    <a>
		      <img class="media-object  img_comentario" src="imagenes/ivan_avatar.png" class="img-responsive" alt="comentario_logo" width="64px">
		    </a>
		    		
		   <?php }else {?>
				<a>
		      <img class="media-object img_comentario" src="imagenes/avatares/<?php echo $reg["imagen"] ?>" class="img-responsive" alt="comentario_logo" width="64px">
				 </a>
		  <?php  }?>


		  </div>
		  <div class="media-body">
		  <button class="btn btn-default pull-right btn_responder_comentario" data-toggle="modal" data-target="#respuesta_<?php echo $i; ?>">Responder</button>
		
		    <h4 class="media-heading resalta_parrafo">Comentarario  subido por <span class="correo_comentario"><?php echo utf8_decode(utf8_encode($reg["correo"])); ?></span> </h4>
		        <h4 class="mensaje_comentario"> <?php echo utf8_decode(utf8_encode($reg["comentario"])); ?></h4>
		       <strong class="mover_derecha"> Publicado el </strong>  
							<span class="fecha_comentario"><?php echo date('Y-m-d H:i:s' ,strtotime($reg["fecha"])); ?> Hs.</span>
		  </div>
		</div>
</div>
		

					<?php  
	   $tra=new trabajo();
		$datis=$tra->muestra_respuestas($reg["id"]);
					foreach($datis as $red){
					?>


					<!--  RESPUESTAS A COMENTARIOS LISTA  -->
				<div class="respuestas_comentarios col-md-offset-1">
								<div class="media ">
								  <div class="media-left media-middle">
								
								  <?php  
								         if($red["imagen"]==""){
								  ?>
								    <a>
								      <img class="media-object img_comentario" src="imagenes/ivan_avatar.png" class="img-responsive" alt="comentario_logo" width="64px">
								    </a>
								    		
								   <?php }else {?>
										<a>
								      <img class="media-object img_comentario" src="imagenes/avatares/<?php echo $red["imagen"] ?>" class="img-responsive" alt="comentario_logo" width="64px">
										 </a>
								  <?php  }?>

								  </div>
								  <div class="media-body">
								    <h4 class="media-heading resalta_parrafo mover_derecha">Comentarario  subido por <span class="correo_comentario"><?php echo utf8_decode(utf8_encode($red["correo"])); ?></span> </h4>
								        <h4 class="mensaje_respuesta"> <?php echo utf8_decode(utf8_encode($red["comentario"])); ?></h4>
								       <strong class="mover_derecha"> Publicado el </strong>  
													<span class="fecha_respuesta"><?php echo date('Y-m-d H:i:s' ,strtotime($red["fecha"])); ?> Hs.</span>
								  </div>
								</div>
						</div>


						<?php } ?>



							<!-- FORMULARIO RESPUESTA MODAL  -->

							<div class="modal fade" id="respuesta_<?php echo $i ?>">
             <div class="modal-dialog">
                     <div class="modal-content">
                                                 <!--HEADER DE LA VENTANA-->
                           <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Respuesta al comentario de......<?php echo $reg["correo"]; ?></h4>
                           </div>
                                                  <!--CONTENIDO DE LA VENTANA-->
                        <div class="modal-body">
                              <form name="formu_respuestas_<?php  echo $i   ;?>" id="formulario_respuesta_enviar_<?php  echo $i  ;?>" class="formulario_respuesta_enviar_<?php  echo $i   ;?>"  action="Controllers/insert_respuestas.php" method="post" enctype="multipart/form-data">
               
                                  <div class="form-group">
                                      <label class="sr-only">CORREO</label>
                                              <label >CORREO</label>
                                     <input type="email" class="form-control" id="txt_email_<?php echo $i ?>" placeholder="CORREO" name="txt_email_<?php echo $i ?>" required>
                                      <label class="oculto_correo_<?php  echo $i   ;?>" >El campo correo es obligatorio</label>

                                              </div>
                                         <div class="form-group">
                                      <label class="sr-only">Sitio</label>
                                        <label >SITIO <span class="mensaje-importante">(NO SERA PUBLICADO...)</span></label>
                                      <input type="text" class="form-control" id="txt_web_<?php echo $i ?>" placeholder="SITIO...(NO SERA PUBLICADO)" name="txt_web_<?php echo $i ?>">
                                       </div>
                                          
                                          <div id="mi_captcha_<?php  echo $i   ;?>"></div>

                                                <div class="form-group">
                                      <label class="sr-only mensaje-importante ">Ingrese captcha</label>
                                     <input type="text" name="txt_captcha_<?php echo $i ?>" class="form-control" id="txt_captcha_<?php echo $i ?>" placeholder="INGRESE EL NUMERO QUE APARECE EN IMAGEN.." required>
                                    <label class="oculto_captcha_<?php  echo $i  ;?>" >Por favor ingrese el numero que aparece en la imagen.GRACIAS</label>

                                       </div>

                                   <div class="checkbox">
                                                <label>
                                                  <input type="checkbox" value="<?php echo $i; ?>" class="ch_imagen_<?php echo $i; ?>" id="ch_imagen_<?php echo $i; ?>"> Deseas compartir una imagen....
                                                </label>
                                              </div>

                                 <div class="field  imagen_oculta_<?php echo $i; ?>">
                           <input type="file" class="form-control" name="imagen_upload_<?php echo $i; ?>">            
                                     <div class="form-group">
                                 
                                    </div>
                                                

                                               </div>

                                     <div class="form-group">
                                       <label for="mensaje">INGRESE MENSAJE</label>
                                 <textarea class="form-control" id="txt_mensaje_<?php echo $i; ?>" placeholder="INGRESE SU COMENTARIO..." name="txt_mensaje_<?php echo $i; ?>"></textarea>
                                          <label class="oculto_mensaje_<?php echo $i; ?>" >Este campo es obligatorio.Rellenelo.Gracias</label>
                                        </div>



                                    <input type="hidden" value="<?php echo $_GET["id"] ?>" id="id_articulo" name="id_articulo"></input>
                                  <input type="hidden" value="<?php echo $reg["id"] ?>" id="id_com" name="id_com"></input>
                                   <input type="hidden" value="<?php echo $i ?>" id="i" name="i"></input>

                                 

                           </div>
                                              <!--FOOTER DE LA VENTANA-->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-success col-xs-offset-4 col-md-offset-5 mi_envia_respuesta_<?php echo $i; ?>" value="<?php echo $i; ?>" id="mi_envia_respuesta_<?php echo $i ?>" 	title="Enviar Respuesta ">ENVIAR</button>
                          
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                              </div>

										 </form>
                         
                         </div>
                      </div>
                 </div>
					

<?php } ?>


							<div class="col-md-offset-3"><img class="img-responsive" id="imagen_comentar" src="imagenes/comen.gif"></div>

							<span id="resultado_post"></span>


							<div class="container">
										<div class=" col-md-6 col-md-offset-2">
			<form name="formu" id="formulario_comentario_enviar" class="formulario_comentario_enviar"  action="Controllers/insert_comentarios.php" method="post" enctype="multipart/form-data">
									<div class="form-group">
								<label class="sr-only">NOMBRE</label>
																<label >NOMBRE</label>
								<input type="text" class="form-control" id="txt_nombre" placeholder="NOMBRE" name="txt_nombre" required>
									<label class="oculto_nombre" >Este campo es obligatorio.Rellenalo.Gracias</label>
									</div>
																			<div class="form-group">
								<label class="sr-only">CORREO</label>
																<label >CORREO</label>
							<input type="email" class="form-control" id="txt_email" placeholder="CORREO" name="txt_email" required>
								<label class="oculto_correo" >El campo correo es obligatorio</label>

																</div>
											<div class="form-group">
								<label class="sr-only">Sitio</label>
										<label >SITIO <span class="mensaje-importante">(NO SERA PUBLICADO...)</span></label>
								<input type="text" class="form-control" id="txt_web" placeholder="SITIO...(NO SERA PUBLICADO)" name="txt_web">
									</div>
												
												<div id="mi_captcha"></div>

																		<div class="form-group">
								<label class="sr-only mensaje-importante ">Ingrese captcha</label>
							<input type="text" name="txt_captcha" class="form-control" id="txt_captcha" placeholder="INGRESE EL NUMERO QUE APARECE EN IMAGEN.." required>
						<label class="oculto_captcha" >Por favor ingrese el numero que aparece en la imagen.GRACIAS</label>

									</div>

					<div class="checkbox">
                  <label>
                    <input type="checkbox" id="ch_imagen"> Deseas compartir una imagen....
                  </label>
                </div>

                 <div class="field  imagen_oculta">
        				<input type="file" class="form-control" name="imagen_upload">            
							<div class="form-group">
			
						</div>
                 	

                 </div>

							<div class="form-group">
									<label for="mensaje">INGRESE MENSAJE</label>
			<textarea class="form-control" id="txt_mensaje" placeholder="INGRESE SU COMENTARIO..." name="txt_mensaje"></textarea>
												<label class="oculto_mensaje" >Este campo es obligatorio.Rellenelo.Gracias</label>
										</div>



		   	<input type="hidden" value="<?php echo $_GET["id"] ?>" id="id_articulo" name="id_articulo"></input>
				<input type="hidden" value="0" id="id_com" name="id_com"></input>

<button type="button" class="btn btn-success btn-lg  col-xs-offset-4 col-md-offset-5 mi_envia_comentario"  id="mi_envia_comentario" title="Enviar comentario">ENVIAR</button>
							</form>
								</div>
																</div>



<?php
	}else{
		$tra=new trabajo();
		$datos=$tra->getArticulos();
					foreach($datos as $reg){
?>
<a  href="#ventana<?php echo $reg["id"]; ?>" class="thumb pull-left " data-toggle="modal" title="<?php  echo utf8_decode(utf8_encode($reg["titulo"]));?>">
	<img src="imagenes/imagen<?php echo $reg["id"]; ?>.jpg" class="img-thumbnail separar_imagen" alt="imagen_<?php echo utf8_decode(utf8_encode($reg["titulo"])); ?> "/>
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
					<?php echo date('Y-m-d H:i:s' ,strtotime($reg["fecha"])); ?></strong>            
					      y fue publicado por <strong><i>Iván Sergio Lopez</i></strong>.
																									</p>
																				</div>
																						<!--FOOTER DE LA VENTANA-->
																					<div class="modal-footer">
																	<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
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
					<span class="post-fecha">
					 <?php echo date('Y-m-d H:i:s',strtotime($reg["fecha"])); ?>
					 	
					 </span> por <span class="post-autor">
														<a href="#ventana_presentacion" class="btn btn-link" data-toggle="modal">Iván Lopez</a>

												</span>
										</p>
										<p class="post-contenido text-justify">
													<?php  echo utf8_decode(utf8_encode($reg["parrafo"]));?>
										</p>

										<div class="contenedor-botones">
												<a href="?id=<?php echo $reg["id"]; ?>" class="btn btn-primary btn_leer_mas" >Leer Mas</a>
				<a class="btn btn-success btn_comentarios">Comentarios <span class="badge">


		<?php echo $tra->totalComentarios($reg["id"])?>


				</span></a>
										</div>
										<div class="separador"></div>

<?php  }
	}
}
function getCategorias(){
				$tra=new trabajo();
			$datos=$tra->getCategorias();
			foreach($datos as $reg){
			?>
					<a href="?c=<?php echo $reg["id"]; ?>" class="list-group-item"><?php echo  utf8_decode(utf8_encode($reg["categoria"])); ?></a>
			<?php
						}
	}
function getUltimosArticulos(){
				$tra=new trabajo();
			$datos=$tra->ultimosArticulos();
				foreach($datos as $reg){
				?>

														<a href="?id=<?php echo $reg["id"];?>" class="list-group-item">
																<h4 class="list-group-item-heading"><?php echo utf8_decode(utf8_encode($reg["titulo"])); ?></h4>
															<p class="list-group-item-text"><?php echo  utf8_decode(utf8_encode(substr($reg["parrafo"],0,70)))."..."; ?></p>
														</a>



<?php
				}
if(isset($_GET["id"])){
$datos=$tra->muestra_encuesta();
?>


				<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
				<script type="text/javascript">
						google.charts.load("current", {packages:["corechart"]});
						google.charts.setOnLoadCallback(drawChart);
						function drawChart() {
				<?php foreach($datos as $reg){ ?>
				
								var data = google.visualization.arrayToDataTable([
										['Task', 'Hours per Day'],
										['Poco Util',     <?php echo $reg["resp_1"]; ?>],
										['Regular',      <?php echo $reg["resp_2"]; ?>],
										['Bueno',  <?php echo $reg["resp_3"]; ?>],
										['Interesante', <?php echo $reg["resp_4"]; ?>],
										['Excelente',    <?php echo $reg["resp_5"]; ?>]
								]);
						<?php } ?>
								var options = {
										title: '¿Que te ha parecido el Articulo ?',
										is3D: true,
								};
								var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
								chart.draw(data, options);
						}
				</script>

				<div id="piechart_3d" style="width: 900px; height: 500px;"></div>




<?php
}
?>


<?php
	}
function paginacion(){
				$tra=new trabajo();
								//// PARA LA PAGINACION
				$cuenta=$tra->contarRegistros();
			///// PAGINACION
		$regPax=5;
		$pagina=false;
			if(isset($_GET["c"])){
					$c=$_GET["c"];
					if(!is_numeric($c)){
							header("Location: index.php");
						}
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
		$totalPaginas=ceil($cuenta/$regPax); /// PARA  DETERMINAR LA CANTIDAD DE PAGINAS
				$paginacion="<div class='pagi'";
					$paginacion.="<p>El numero de resultados encontrados es de ".$cuenta."</p><br>";
						$paginacion.="<p>Pagina ".$pagina." de ".$totalPaginas."</p><br>";
			$paginacion.="</div>";
				$paginacion.="<nav>";
			if(isset($c)){
				if($totalPaginas>1){
				$paginacion.="<ul class='pagination pagination-lg' >";
				if($pagina!=1){
					$paginacion.="<li><a href='?p=".($pagina - 1)."&c=$c'>&laquo;</a></li>";
					}
							for($i=1;$i<=$totalPaginas;$i++){
								if($pagina!=$i){
									$paginacion.="<li  class=''><a href='?p=$i&c=$c' class='active'>$i</a></li>";
								}else{
										$paginacion.="<li  class='active'><a href='?p=$i&c=$c'>$i</a></li>";
									}
							}
				if($pagina!=$totalPaginas){
					$paginacion.="<li><a href='?p=".($pagina + 1)."&c=$c'>&raquo;</a></li>";
					}
				$paginacion.="</ul>";
				}
				}else{
				if($totalPaginas>1){
				$paginacion.="<ul class='pagination pagination-lg' >";
				if($pagina!=1){
					$paginacion.="<li><a href='?p=".($pagina - 1)."'>&laquo;</a></li>";
					}
							for($i=1;$i<=$totalPaginas;$i++){
								if($pagina!=$i){
									$paginacion.="<li  class=''><a href='?p=$i' class='active'>$i</a></li>";
								}else{
										$paginacion.="<li  class='active'><a href='?p=$i'>$i</a></li>";
									}
							}
				if($pagina!=$totalPaginas){
					$paginacion.="<li><a href='?p=".($pagina + 1)."'>&raquo;</a></li>";
					}
				$paginacion.="</ul>";
				}
				}
					$paginacion.="</nav>";
			echo $paginacion;
	}
function getCategoriasCabecera(){
		$tra=new trabajo();
		$datos=$tra->getCategorias();
		foreach($datos as $reg){
				?>

									<li class="resalt"><a href="?c=<?php echo $reg["id"]; ?>" class="resalt" ><?php echo utf8_decode(utf8_encode($reg["categoria"])); ?></a></li>


								<?php
			}
			}
	?>