<?php
	

	if(defined("EN_CONTROLADOR")){


	}else{

		// Si no está definida la constante EN_CONTROLADOR aparece un mensaje de error y se mata el proceso	
			echo "<h1>No se puede llamar directamente a este fichero</h1>";
			die("<h1><strong>NO ESTAS AUTORIZADO</strong></h1>");
	}
?>

		<title><?php echo $datos['titulo'];?></title>
		<style>
			
			@import url('../estilo.css');
		</style>	
		<header>
					<h1 class="titulo_cabecera"><?php echo $datos['titulo'];?></h1>								
		</header>
		<!-- Contenedor para el Login -->
		<div class="cajaInterior" id="cajaLogin">	
			<section id="login">
				
				<form action="" id="formLogin" name="formLogin" method="POST">
					<fieldset>
						<legend>Introducir usuario y constraseña. Todos son obligatorios</legend>
						<div class="bloq_registro">
							<label class="etiqueta" for="usuarioLogin">Usuario</label>
							<input type="text" id="usuarioLogin" class="campo_login" name="usuarioLogin" placeholder="Nombre de usuario">
							<span class="error"></span>
						</div> 
						<div class="bloq_registro">
							<label class="etiqueta" for="contrasenaLogin">Contraseña</label>
							<input type="password" id="contrasenaLogin" class="campo_login" name="contrasenaLogin" >
							<span class="error"></span>
						 </div>
						<div id="btn">
							<input class="btn"  type="submit" name="login" value="Login">
						</div>
						<div id="home">
							<a class="home"  href="../index.php">Home</a>
						</div>        
					</fieldset>
				</form>
			</section>
		</div>
<?php
	

?>