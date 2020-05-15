	<?php

	if(defined("EN_CONTROLADOR")){

		$titulo = controlador_index();

		?>
		<!DOCTYPE html>
		<html lang="es"> <!-- Indica el lenguaje de contenido del código -->
		<head>
			<!-- Formato de codificación de los caracteres que se usará en la web -->
			<meta charset="UTF-8">
			
			<!-- Título de la página para que aparezca en el navegador -->
			<title><?php echo $titulo['titulo']?></title>
			
			<!-- Importar el CSS del estilo que usará la página -->
			<style>
				@import url("estilo.css");
			</style>
			<script src="scripts/ajax.js"></script>
		</head>	
		<body>
			<!-- Contenedor prncipal sobre la que descansan todos los demas elementos -->
			<div id="cajaPrincipal">
				<!-- Cabecera donde se nos mostrará el logo de la página -->
				<header>
					<h1 class="titulo_cabecera">DWES - Tarea Tarea Global</h1>								
				</header>
				<div class="content_buttons">
					<nav>
					<?php 
					
					//Comprueba si la session está vacía
					if(empty($_SESSION)){
							//No hay session
						?>
							<a class="btn" id="btn" href="index.php/registro">Página de registro</a>
							<a class="btn" id="btn_log" href="index.php/login">Página de login</a>
							
						<?php
					}else{
							//Hay session y el rol es admin
							if($_SESSION['Rol']=='admin'){
								//Es admin
								?>
							<a class="btn" id="btn_admin_user" href="index.php/admin_usuarios">Administración de usuarios</a>
							<a class="btn" id="btn_admin_book" href="index.php/admin_libros">Administración de libros</a>
							<a class="btn" id="btn_out_log" href="index.php/logout">Logout</a>

						<?php
							}else{

								//Si el rol es usuario
								?>
									<a class="btn" id="btn_out_log" href="index.php/logout">Logout</a>
								<?php
							}
						?>
							
							
							
						<?php
					}
					?>
						
					</nav>	
				</div>
		<div class="contenedor">		
			<div>
				<label>Buscar:</label>
				<form> 
<!--
    Cada vez que tecleamos algo en este field se ejecutará mostrar_sugerencias 
-->
Usuario: <input type="text" onkeyup="mostrar_sugerencias(this.value)">
</form>
				<p><strong>Sugerencias:</strong> <span id="sugerencias" style="color: #0080FF;"></span></p>
			</div>
					<div class="tabla">
						<table>
							<?php	
							//Comprueba si la session está vacía
						if(empty($_SESSION)){
								//Si no hay session
							?>
								<tr><th>id</th><th>titulo</th><th>Fecha Publicación</th><th>Autor</th></tr>
							<?php

							$lista = controlador_index(); // Asigna controlador_index a una variable

							foreach ($lista['libros'] as $clave => $valor):?>

								<tr><td><?php echo $valor['id_libro']?></td>
									<td><?php echo $valor['titulo']?></td>
									<td><?php echo $valor['fech']?></td>
									<td><?php echo $valor['nombre']." ".$valor['apellidos'];?></td>
								</tr>
								

							

							<?php
						endforeach; 
						?>
								
							<?php
						}else{
								//Hay session y el rol es admin
								if($_SESSION['Rol']=='admin'){
									//Es admin
									?>
								<tr><th>id</th><th>titulo</th><th>Fecha Publicación</th><th>Autor</th></tr>
							<?php

							$lista = controlador_index(); // Asigna controlador_index a una variable

							foreach ($lista['libros'] as $clave => $valor):?>
		

								<tr><td><?php echo $valor['id_libro']?></td>
									<td><?php echo $valor['titulo']?></td>
									<td><?php echo $valor['fech']?></td>
									<td><?php echo $valor['nombre']." ".$valor['apellidos'];?></td>
									
								</tr>
								

							

							<?php
						endforeach; 
						?>

							<?php
								}else{

									//Si el rol es usuario
									?>
										<tr><th>id</th><th>titulo</th><th>Fecha Publicación</th><th>Autor</th></tr>
							<?php

							$lista = controlador_index(); // Asigna controlador_index a una variable

							foreach ($lista['libros'] as $clave => $valor):?>

								<tr><td><?php echo $valor['id_libro']?></td>
									<td><?php echo $valor['titulo']?></td>
									<td><?php echo $valor['fech']?></td>
									<td><?php echo $valor['id_autor']?></td>
								</tr>
								

							

							<?php
						endforeach 
						?>
									<?php
								}
							?>
								
								
								
							<?php
						}
						?>	

				
						</table>

	
					</div>
					
				</div>
		</div>
		<footer>
						 <h3 id="pie_pagina">Federico Escobosa Osa.</h3>


					</footer>			
</body>
</html>
	<?php
	}else{

		// Si no está definida la constante EN_CONTROLADOR aparece un mensaje de error y se mata el proceso	
			echo "<h1>No se puede llamar directamente a este fichero</h1>";
			die("<h1><strong>NO ESTAS AUTORIZADO</strong></h1>");
	}

		$titulo = controlador_index();//Se obtiene al array asocitivo.
		
	?>
	