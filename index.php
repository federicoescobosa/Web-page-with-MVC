<?php

	/*Controlador Frontal.*/
	//Constante para controlar que todo pase por este controlador frontal.
	const EN_CONTROLADOR = true;

	//Se incluye el modelo y el controlador
	include "modelo/modelo.php";
	include "controlador/controlador.php";


	// URI NAVEGADOR
	$URI = $_SERVER['REQUEST_URI'];

	

	if($URI=="/Tarea_Global_DWES/index.php"){

		include "Vista/home.php";

	}else if ($URI=="/Tarea_Global_DWES/index.php/registro"){

		controlador_registro();

	}else if($URI == "/Tarea_Global_DWES/index.php/login"){

		
		controlador_login();

	}else if($URI == "/Tarea_Global_DWES/index.php/admin_usuarios"){

		
		controlador_admin_usuarios();	

	}else if($URI == "/Tarea_Global_DWES/index.php/admin_libros"){

		controlador_admin_libros();
		
	}else if($URI == "/Tarea_Global_DWES/index.php/logout"){

		controlador_logout();

	}else if($URI == "/Tarea_Global_DWES/index.php/administrar_autores_libros"){


		update_autores();
		update_book();

	}else if($URI == "/Tarea_Global_DWES/index.php/index.php/borrar?id=".$_GET['id']){


		controlador_borrar_usuario();

	}else if($URI == "/Tarea_Global_DWES/index.php/index.php/borrar_libro?id=".$_GET['id']){


		controlador_borrar_libro();

	}else if($URI == "/Tarea_Global_DWES/index.php/index.php/borrar_autor?id=".$_GET['id']){


		controlador_borrar_autor();

	}else{

		echo "Url no autorizada";
		
		
	}	

	

		
	
	

?>
	