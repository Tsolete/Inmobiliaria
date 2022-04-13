<?php require_once('header.php'); ?>
  
<div class="bg-top">
	<div class="container">
		<ol class="breadcrumb">
		  <li><a href="index.php">Início</a></li>
		  <li class="active">Anúnciese</li>
		</ol>
	</div>
</div>
	<div class="space-20 clearfix"></div>
	<div class="container"></div>
    <div class="space-20"></div>
	<h1 class="text-uppercase text-center"><b>anuncie su inmueble con nosotros</b></h1>
	<hr>
	<div class="space-40"></div>
	<p>Rellene los campos de abajo y nos pondremos en contacto con usted:</p>
    <div class="space-40"></div>
    <div class="contact-form">
		<form name="sentMessage-tirar" id="anuncieForm" enctype="application/x-www-form-urlencoded" method="post" action="anuncie.php">
			<div CLASS="form-group row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px;">
					<select class="form-control" id="finalidade" name="finalidade" required>
				  	  <option value="">Selecione una finalidad</option>
					  <option value="vender">Vender</option>
					  <option value="alquilar">Alquilar</option>
					</select>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px;">
					<input type="text" class="form-control" id="nome" name="nome" placeholder="Nombre*" required>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px;">
					<input type="email" class="form-control" id="email" name="email" placeholder="E-mail*" required>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px;">
					<input type="tel" class="form-control" id="telefone" name="telefone" placeholder="Teléfono*" required>
				</div>
				<div CLASS="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<textarea style="resize:none; height:100px;" type="text" class="form-control" id="mensagem" name="mensagem" placeholder="Describa su inmueble. Ej: Casa con 2 habitaciones, comedor, 1 cocina, 2 baños, etc;*" required></textarea>
				</div>
			</div>
			<button type="submit" class="btn btn-primary">Enviar</button>
		</form>
		<div class="space-20"></div>
		<div id="respuesta"></div>
	</div>  
	<div class="space-40"></div> 
</div>
	
<?php require_once('footer.php'); ?>

    
<script type="text/javascript" async defer>
	jQuery(document).ready(function(e){

		jQuery('#anuncieForm').submit(function(e){
			e.preventDefault();
			var dados = jQuery( this ).serialize();
e.preventDefault();
e.preventDefault();
			jQuery.ajax({
				type: "POST",
				url: "envia.php",
				data: dados,
				success: function( data )
				{

					$("#respuesta").html(data);
					document.getElementById('anuncieForm').reset();						
				}
			});



		});

	});
</script>