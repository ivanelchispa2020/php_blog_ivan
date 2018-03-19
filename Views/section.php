

<section class="main-container">
			<div class="row" id="contenedor">
						<section class="posts col-md-9">
										<div class="miga-de-pan">
											<ol class="breadcrumb">
													<li><a >Inicio</a></li>
													<li><a>Categorias</a></li>
														<li class="active">Cursos</li>
														
												</ol>
										</div>
										
										<div class="articulos_ar">
										
								 
									
									<article class="post clearfix">
									 <div id="respuesta"></div>
									</article>
						
											
										<article class="post clearfix" id="articles">
									 <?php post_articulos(); ?>
									</article>  
										</div>
									
								 <?php
					if(isset($_GET["id"])){
							 $id=$_GET["id"];
								if(!is_numeric($id)){
									header("Location: index.php");
								}
					 
					 } else{?>
									<nav>
											<div class="center-block"  id="paginas">
												
														<ul class="pagination" id="pagination">
																
																<?php paginacion(); ?>

															</ul>
												
												</div>
									
									</nav>
											<?php } ?>                  
																			
										
								</section>

										<aside class="col-md-3 hidden-xs hidden-ms" id="ultimos_art">
												
												<div class="list-group" id="seccion_categorias">
															<a href="" class="list-group-item active">Categorias</a>
														<?php  getCategorias();?>
												 </div>
												
												<h4><span class="resaltar">Articulos Recientes</span></h4>
														<?php getUltimosArticulos()?>
											 
								 
										</aside>




				</div>
				
</section>

	
			<div class="container">
							
										<div class="modal fade" id="ventana1">
											<div class="modal-dialog">
														<div class="modal-content">
																				<!--HEADER DE LA VENTANA-->
																		<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																					<h4 class="modal-title">Bienvenidos a mi Blog..!!!</h4>
																				</div>
																						<!--CONTENIDO DE LA VENTANA-->
																				<div class="modal-body">
																				<img src="imagenes/hulk.png" width="400" alt="MI"/>
																						<p >Hola a todos. Mi nombre es Iván sergio Lopez.
																									 Y esto es una prueba de diseño web, espero que os guste
																									 Desde ya muchas gracias por visitar mi pagia personal..BIENVENIDOS..!!!
																								 </p>
																				</div>
																						<!--FOOTER DE LA VENTANA-->
																				 <div class="modal-footer">                 
																<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
																				 </div>       
																								
																</div>
												</div>
										</div></div>


			