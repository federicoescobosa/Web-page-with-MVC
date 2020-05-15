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
					<h1 class="titulo_cabecera">Administración de Usuarios</h1>
				</header>
				
			<div class="contenedor">
				<div class="tabla">

					<table>
						<tr><th>Usuario</th><th>Nombre</th><th>Apellidos</th><th>Email</th><th>Contraseña</th><th>Rol</th></tr>
						<?php

							$lista = controlador_admin_usuarios(); //Asigna lista de usuarios 


							foreach ($lista as $clave => $valor):?>
								
								<tr>
									<form method="POST" action="" name="form_update">
										<input hidden type="text" name="id" value="<?php echo $valor['id']?>">
									<td><input class="campo" type="text" name="usuario" value="<?php echo $valor['usuario']?>"></td>
									<td><input class="campo" type="text" name="nombre" value="<?php echo $valor['nombre']?>"></td>
									<td><input class="campo" type="text" name="apellidos" value="<?php echo $valor['apellidos']?>"></td>
									<td><input class="campo" type="email" name="email" value="<?php echo $valor['email']?>"></td>
									<td><input class="campo" type="text" name="contrasena" value="<?php echo $valor['contrasena']?>"></td>
									<td><input class="campo" type="text" name="rol" value="<?php echo $valor['rol']?>"></td>
									
										<?php
										//Condición para que el rol admin no disponga de boton borrar y actualizar
										if($valor['rol']!="admin"){

											?>
											<td>
												
													<a class="btn" href="index.php/borrar?id=<?php echo $valor['id'];?>">Borrar</a>
											</td>
											<td>
													<input class="btn" type="submit" name="update" value="actualizar">
												
											</td>
										<?php

										}
										?>
										
									
									</form>
								</tr>
								
						<?php	
					endforeach
						?>
					</table>
					<div><a class="home" href="../index.php">Home</a></div>

				</div>
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



	
