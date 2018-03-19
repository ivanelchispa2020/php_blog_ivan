<?php  include("vistas.php"); ?>
						 
															<header>        
																							
 <nav class="navbar navbar-inverse navbar-static-top" role="navigation" id="barra">
									<div class="container">
											 <div class="navbar-header">
											<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navegacion_fm" aria-expanded="false">
												<span class="sr-only">Mostrar/Ocultar</span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
											</button>
										
										</div>
										 <!--- INICIA MENU -->
										<div class="collapse navbar-collapse" id="navegacion_fm">
											<ul class="nav navbar-nav">
											<li><a class="btn btn-link presentame" data-toggle="modal"  data-target="#presentacion">Aprendices</a></li>
												<li><a href="/index.php">Inicio</a></li>
												
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">CATEGORIAS <span class="caret"></span></a>
													<ul class="dropdown-menu">
		 
		 
		 
										 <?php getCategoriasCabecera(); ?>
		
		
													</ul>
												</li>
												
											</ul>
					 <div class="navbar-form navbar-right" role="search" id="busc">
												<div class="form-group">
								<input type="text" class="form-control"  placeholder="buscar..." name="query" id="input">
												
												<button type="button" class="btn btn-success" id="enviar_ajax" onClick="from(document.getElementById('input').value.toLowerCase(),'respuesta','Views/resultados.php')"><span class="glyphicon glyphicon-search"></span></button>
										
											</div>
											 
										</div>
									</div> 
									
								</nav>


</header>


