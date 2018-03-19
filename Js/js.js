// JavaScript Document
$(function(){

          	$(".imagen_oculta").hide();


					$('.arriba').click(function(){
					    $('body,html').animate({scrollTop : 0}, 500);
					    return false;
					});

          	$(window).scroll(function(){
				         if ($(this).scrollTop() > 600) {
				              $('.arriba').fadeIn();
				         } else {
				              $('.arriba').fadeOut();
				         }
      			});


	$("#ch_imagen").change(function(event) {
					 if( $(this).prop('checked') ) {
								$(".imagen_oculta").fadeIn(2500);
						}else{
						 	 $(".imagen_oculta").fadeOut(2500);
						 }

			});

	


	var valor=Math.random().toString(36).substring(7);
	$("#mi_captcha").html("<label>"+ valor + "</label>");

          $(".oculto_nombre").hide();
				$(".oculto_correo").hide();
				$(".oculto_captcha").hide();
				$(".oculto_mensaje").hide();
          $("#encuesta_grafico").hide();
                 				 

			 $(".mi_envia_comentario").click(function(){		

							// Almaceno los valores
					  var email=$("#txt_email").val();
						var mensaje=$("#txt_mensaje").val();
						var captcha=	$("#txt_captcha").val();
						var nombre =$("#txt_nombre").val(); 
					
						/// Valido el email
						if(nombre==''){
							$(".oculto_nombre").fadeIn(2500);
											$("#txt_nombre").text("");
											$("#txt_nombre").focus();
											return false;

						}else if(validarEmail(email) == false){
											$(".oculto_correo").fadeIn(2500);
											$("#txt_email").text("");
											$("#txt_email").focus();
											return false;

						}else if($("#txt_mensaje").val()==""){
								$(".oculto_mensaje").fadeIn(2500);
								$("#txt_mensaje").focus();
								return false;

						}else if(valor!=captcha){
						 $(".oculto_captcha").fadeIn(2500);
						 $("#txt_captcha").text("");
						 $("#txt_captcha").focus();
						 	  return false;

					 }else{

					 					 $(".formulario_comentario_enviar").submit();
					 									  $("#txt_nombre").text("");
				 										 $("#txt_email").text("");
														 $("#txt_sitio").text("");
														 $("#txt_captcha").text("");
														 $("#txt_mensaje").text("");
														$("#txt_nombre").focus();
					 }


				
			});



	var total=$(".total_comentarios").attr('value');

	
		for (var i = 1; i < total + 1 ; i++) {

			     $(".imagen_oculta_"+i).hide();

					$(".ch_imagen_"+i).change(function(event) {
						 var id_ch=$(this).attr('value');
								 if( $(this).prop('checked') ) {
											$(".imagen_oculta_"+id_ch).fadeIn(2500);
									}else{
									 	 $(".imagen_oculta_"+id_ch).fadeOut(2500);
									 }
						});

						$("#mi_captcha_"+ i).html("<label>"+ valor + "</label>").css({		
												background:"black",
												color: "orange",
												fontSize: "22px",
												width: "110px",
												height: "35px",
												textAlign: "center",
												fontWeight: "bold",
												fontFamily: "Comic Sans Ms",
												marginBottom: "10px",
												marginTop: "10px"	
					   });

						      		$(".oculto_correo_"+i).hide();
										$(".oculto_captcha_"+i).hide();
										$(".oculto_mensaje_"+i).hide();
						 

							 $("#mi_envia_respuesta_"+ i).click(function(){	
							 		
							 		 	var id=$(this).attr('value');
							 
													// Almaceno los valores
											  var email=$("#txt_email_"+id).val();
												var mensaje=$("#txt_mensaje_"+id).val();
												var captcha=	$("#txt_captcha_"+id).val();
											
												/// Valido el email
										
											if(validarEmail(email) == false){
													$(".oculto_correo_"+id).fadeIn(2500);
													$("#txt_email_"+id).text("");
													$("#txt_email_"+id).focus();
																return false;

												}else if($("#txt_mensaje_"+id).val()==""){
														$(".oculto_mensaje_"+id).fadeIn(2500);
														$("#txt_mensaje_"+id).focus();
														return false;

												}else if(valor!=captcha){
									    		 $(".oculto_captcha_"+id).fadeIn(2500);
												 $("#txt_captcha_"+id).text("");
												 $("#txt_captcha_"+id).focus();
												 	  return false;

											 }else{
											 	 $("#formulario_respuesta_enviar_"+id).submit();
										 										 $("#txt_email_"+id).text("");
																				 $("#txt_sitio_"+id).text("");
																				 $("#txt_captcha_"+id).text("");
																				 $("#txt_mensaje_"+id).text("");
																				$("#txt_email_"+id).focus();
											 }
									});


			 		


		}
     


		


function validarEmail(valor) {
	if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor)){
			return true;
				} else {
				 return false;
				}
      }

							      				  	 
 			   $("#enviar_ajax").click(function(e){
				      
				      $("#articles").hide();
					  $("#pagination").hide();
					  $("#input").fadeOu(7000).val('');
				   });

			  



       $("#ver_enc").click(function(){
	           $("#piechart_3d").toggle("slow");		   
       	 });
       
	    $("#ver_encuesta").click(function(){
				$("#encuesta_grafico").toggle("slow");
			});




  })

			  
