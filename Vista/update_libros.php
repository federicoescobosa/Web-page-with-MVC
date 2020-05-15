<?php  


if(defined("EN_CONTROLADOR")){

	?>

	<div class="contenedor">

				<div class="tabla">

					<table>
						<tr><th>Id</th><th>Título</th><th>Fecha de publicación</th><th>Autor</th></tr>
						<?php

							$lista = controlador_index(); //Asigna lista de usuarios 
							

							foreach ($lista['libros'] as $clave => $valor):?>
								
								<tr>
									<form method="POST" action="administrar_autores_libros" name="form_update">
									<td><input class="campo_read_only" readonly="readonly" type="text" name="id_libro" value="<?php echo $valor['id_libro']?>"></td>
									<td><input class="campo" type="text" name="titulo_libro" value="<?php echo $valor['titulo']?>"></td>
									<td><input class="campo" type="text" name="f_publicacion" value="<?php echo $valor['fech']?>"></td>
									<td><input class="campo_read_only" type="text" readonly="readonly" name="autor" value="<?php echo $valor['nombre']." ".$valor['apellidos']?>"></td>
									<td><input class="campo_read_only" hidden readonly="readonly" type="text" name="id" value="<?php echo $valor['id']?>">								
											<td>
												
													<a class="btn" href="index.php/borrar_libro?id=<?php echo $valor['id_libro'];?>">Borrar</a>
											</td>
											<td>
													<input class="btn" type="submit" name="up_libro" value="actualizar">
												
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
	<?php
	}else{

		// Si no está definida la constante EN_CONTROLADOR aparece un mensaje de error y se mata el proceso	
			echo "<h1>No se puede llamar directamente a este fichero</h1>";
			die("<h1><strong>NO ESTAS AUTORIZADO</strong></h1>");
	}
?>	