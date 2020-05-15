<?php  


if(defined("EN_CONTROLADOR")){

	?>
			<!DOCTYPE html>
			<html lang="es">
			<head>
				<meta charset="utf-8">
				<title>Lista de autores</title>
				<style>
					@import url('../estilo.css');
				</style>
			</head>
			<body>
				<header>
					<h1 class="titulo_cabecera">Administración de Autores y Libros</h1>
				</header>
				<div><a class="home" href="../index.php">Home</a><a class="home" href="admin_libros">Registrar Autores y Libros</a></div>


			<div class="contenedor">

				<div class="tabla">

					<table>
						<tr><th>Id</th><th>Nombre</th><th>Apellidos</th><th>Nacionalidad</th></tr>
						<?php

							$lista = lista_autores(); //Asigna lista de usuarios 
							

							foreach ($lista as $clave => $valor):?>
								
								<tr>
									<form method="POST" action="" name="form_update">
									<td><input class="campo_read_only" readonly="readonly" type="text" name="id_autor" value="<?php echo $valor['id_autor']?>"></td>
									<td><input class="campo" type="text" name="nombre_autor" value="<?php echo $valor['nombre']?>"></td>
									<td><input class="campo" type="text" name="apellidos_autor" value="<?php echo $valor['apellidos']?>"></td>
									<td><input class="campo" type="text" name="nacionalidad" value="<?php echo $valor['nacionalidad']?>"></td>
																	
											<td>
												
													<a class="btn" href="index.php/borrar_autor?id=<?php echo $valor['id_autor'];?>">Borrar</a>
											</td>
											<td>
													<input class="btn" type="submit" name="up_autor" value="actualizar">
												
											</td>
																
									
									</form>
								</tr>
								
						<?php	
					endforeach
						?>
					</table>
					<div>
				</div>
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