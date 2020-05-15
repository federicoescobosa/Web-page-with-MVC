<?php

	if(defined("EN_CONTROLADOR")){

		?>

		<!DOCTYPE html>
		<html lang="es">
		<head>
			<meta charset="utf-8">
			<title><?php echo $datos['titulo']?></title>
			<style>
				@import url('../estilo.css');
			</style>
		</head>
		<body>
			<header>
							<h1 class="titulo_cabecera"><?php echo $datos['titulo']?></h1>								
			</header>
			<!-- Contenedor para el Registro -->
				<div class="cajaInterior" id="cajaRegistro">	
					<section id="registro">
						
						<form action="" id="formRegistro" name="formRegistro" method="POST">
							<fieldset>
								<legend>Introduce tus datos personales. Todos son obligatorios</legend>
								<div class="bloq_registro">
									<label class="etiqueta" for="usuario">Usuario</label>
									<input type="text" id="usuario" class="campo_registro" name="usuario" placeholder="Nombre de usuario" required><span class="error"></span>
								</div> 
								<div class="bloq_registro">
									<label class="etiqueta" for="nombre">Nombre</label>
									<input type="text" id="nombre" class="campo_registro" name="nombre" placeholder="Su nombre" required><span class="error"></span>
								</div>    
								<div class="bloq_registro">
									<label class="etiqueta" for="apellidos">Apellidos</label>
									<input type="text" id="apellidos" class="campo_registro" name="apellidos" placeholder="Sus apellidos" required>
									
								</div>
								<div class="bloq_registro">
									<label class="etiqueta" for="email">E-mail</label>
									<input type="email" id="email" class="campo_registro" name="email" placeholder="Su correo electrónico" required>
									
								 </div>
								 <div class="bloq_registro">
									<label class="etiqueta" for="contrasena">Contraseña</label>
									<input type="password" id="contrasena" class="campo_registro" name="contrasena" required>
									
								 </div>
								 <dir>
								 	
								 	<input class="btn" type="submit" name="registro" value="Registrar">
								 </dir>
								<dir>
									<a class="home" href="../index.php">Home</a> 
								</dir>
								     
							</fieldset>
						</form>
					</section>
				</div>

		</body>
		</html>
		<?php
	}else{

		// Si no está definida la constante EN_CONTROLADOR aparece un mensaje de error y se mata el proceso	
			echo "<h1>No se puede llamar directamente a este fichero</h1>";
			die("<h1><strong>NO ESTAS AUTORIZADO</strong></h1>");
	}

?>

