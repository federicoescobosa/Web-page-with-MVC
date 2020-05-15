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
				<script>
			    if ( window.history.replaceState ) {
			  window.history.replaceState( null, null, window.location.href );
			}
			</script>
			</head>
			<body>

				<header><h1 class="titulo_cabecera">Registro Libros y Autores</h1></header>

				<section>
					<div><a class="btn" href="../index.php">Home</a><a class="btn" href="administrar_autores_libros">Administrar Autores y Libros</a></div>
					<form action="" name="RegistroAutores" method="POST">
						<fieldset>
							<legend>Introduce un nuevo autor</legend>
							<div class="bloq_registro">
								<label class="etiqueta">Nombre</label>
								<input type="text" name="nombre_autor" class="campo_registro" placeholder="Nombre autor" required>
							</div>
							<div class="bloq_registro">
								<label class="etiqueta">Apellidos</label>
								<input type="text" name="apellidos_autor" class="campo_registro" placeholder="Apellidos autor" required>
							</div>
							<div class="bloq_registro">
								<label class="etiqueta">Pais</label>
								<input type="text" name="pais_autor" class="campo_registro" placeholder="Pais" required>
							</div>
								<input class="btn" type="submit" name="registrar_autor" value="Registrar">
						</fieldset>
						
					</form>
					<form action="" name="RegistroLibros" method="POST">
						<fieldset>
							<legend>Introduce un nuevo libro</legend>
							<div class="bloq_registro">
								<label class="etiqueta">Titulo</label>
								<input type="text" name="titulo" class="campo_registro" placeholder="Titulo del libro" required>
							</div>
							<div class="bloq_registro">
								<label class="etiqueta">Fecha Publicación</label>
								<input type="text" name="f_publicacion" class="campo_registro" placeholder="Fecha Publicación" required>
							</div>
							<div class="bloq_registro">
								<label class="etiqueta">Id de autor asocioado</label>
								<input type="number" name="id_autor" class="campo_registro" placeholder="Id autor" required>
							</div>
								<input class="btn" type="submit" name="registrar_libro" value="Registrar">
						</fieldset>
						
					</form>
					<hr>
					
								
							
						
					</div>
				</section>


			</body>
			</html>




	<?php

	}else{

		// Si no está definida la constante EN_CONTROLADOR aparece un mensaje de error y se mata el proceso	
			echo "<h1>No se puede llamar directamente a este fichero</h1>";
			die("<h1><strong>NO ESTAS AUTORIZADO</strong></h1>");
	}
?>




