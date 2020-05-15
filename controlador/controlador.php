<?php

if(defined("EN_CONTROLADOR")){

	//Inicio de session
	session_start();

	}else{

		// Si no está definida la constante EN_CONTROLADOR aparece un mensaje de error y se mata el proceso	
			echo "<h1>No se puede llamar directamente a este fichero</h1>";
			die("<h1><strong>NO ESTAS AUTORIZADO</strong></h1>");
	}
	
/**
 * Devuelve una lista de un array asociativo, provisto por un titulo para la página y una lista de libros.
 * 
 * @return array
 */
function controlador_index(){

	

	$datos = ["titulo"=>"Todo libros","libros"=>cargarLibros()];

	return $datos;

	require "Vista/home.php";

}

/**
 * Obtiene un lista de un formulario con los datos necesarios para crear un usuario
 * 
 */
function controlador_registro(){

	$datos['titulo']= "Página de registro";

	if(isset($_POST['registro'])){

		
		//Recoger los datos intruducidos
		
		$usuario = $_POST["usuario"];
		$nombre = $_POST["nombre"];
		$apellidos = $_POST["apellidos"];
		$email = $_POST["email"];
		$contrasena = $_POST["contrasena"];
		
		//Comprueba que no se a repetido nombre de usuario.
		if(!existeUsuario($usuario)){

			$datos_usuario = ['usuario'=>$usuario,'nombre'=>$nombre,'apellidos'=>$apellidos,'email'=>$email,'pass'=>$contrasena];//Array con los datos de registro

			registrar_Usuario($datos_usuario);

		}else{

			echo "<script>alert('El usuario ya existe');</script>"; // Mensaje si el usuario existe.
		}
	}

	include_once "Vista/registro.php"; 
}

/**
 * Obtiene un lista de un formulario con los datos necesarios para crear un usuario
 */
function controlador_login(){

	$datos['titulo']="Página de login";

	if(isset($_POST['login'])){


		//Recoge usuario y contraseña
		$usuario = $_POST['usuarioLogin'];
		$pass = $_POST['contrasenaLogin'];

		//Comprueba que el usuario y contraseña sea correcto
		if(!compruebaUsuario($usuario,$pass)){

			echo "<script>alert('El usuario o la contraseña es incorrecto');</script>";
			
		}else{

			echo "<script>alert('Te has logueado correctamente');</script>";
			//Crear una session con clave-valor
			
			$_SESSION['Usuario']=$usuario;
			$_SESSION['Rol'] = cargarRol($usuario);
			
			header('Location: http://localhost/Tarea_Global_DWES/index.php');
		}
	}
	
	include_once 'Vista/login.php'; 
}

/**
 * Obtiene una lista de un formulario para modificar un usuario.
 * @return Array con toda los datos para llamar a la función que modifique los cambien en modelo.php
 */
function controlador_admin_usuarios(){


	$datos['titulo'] = "Página de admistración de usuarios";

	//Esta parte corresponde a actualizar usuarios.
	if(isset($_POST['update'])){

			
			$lista_modificada =  array('id' =>$_POST['id'],'usuario'=> $_POST['usuario'], 'nombre'=> $_POST['nombre'],'apellidos'=> $_POST['apellidos'],'email'=> $_POST['email'],'contrasena'=> $_POST['contrasena'],'rol' => $_POST['rol']);
			//Llamada a función
			
			update_user($lista_modificada);
	}

	
	if($_SESSION['Rol'] !="admin"){
		//Si el rol no es admin


		echo "<script>alert('Acceso no autorizado');</script>";
	}else{


		//Si el rol es admin
		$usuarios = cargarUsuario();
		include_once 'Vista/admin_usuarios.php';
		return $usuarios;
	}
}

/**
 * Funcion que inserta Libros, Autores, los modifica y obtiene una lista de cada.
 * @return Array  de Autores.
 */
function controlador_admin_libros(){

	$datos['titulo'] = "Página de admistración de libros y autores";
	
	

	//********************************************************
	//****** Parte inserta autores ********************/
	if($_SESSION['Rol']=='admin'){

			if(isset($_POST['registrar_autor'])){
				

			$datos_autor = array('nombre'=>$_POST['nombre_autor'],'apellidos'=>$_POST['apellidos_autor'],'nacionalidad'=>$_POST['pais_autor']);
			
			set_autor($datos_autor);
			
			}else if(isset($_POST['registrar_libro'])){

			$datos_libro = array('titulo'=>$_POST['titulo'],'f_publicacion'=>$_POST['f_publicacion'],'id_autor'=>$_POST['id_autor']);
			set_libro($datos_libro);
			
			}else{
				
			}

			
		include_once 'Vista/admin_libros.php';
		

	}else{


		// Si el rol no es admin.
		echo"<script>alert('Acceso no autorizado');</script>";
	}
	
	
}

/**
 * Destruye la Session y reenvia a index.php
 * 
 */
function controlador_logout(){

	
	session_unset();
	session_destroy();//Destruye la session
	$_SESSION = array();
	header('Location: http://localhost/Tarea_Global_DWES/index.php');//Envía a index.php
}
/**
 * Función que borrará un usuario.
 * @var $id int.
 * 
 */
function controlador_borrar_usuario(){

	$id = $_GET['id'];

	borrar_usuario($id);
	header('Location: http://localhost/Tarea_Global_DWES/index.php/admin_usuarios');//Envía a admin_usuarios

	
}
/**
 * Función que borrará un libro.
 * @var $id int.
 * 
 */
function controlador_borrar_libro(){

	$id = $_GET['id'];

	borrar_libro($id);
	header('Location: http://localhost/Tarea_Global_DWES/index.php/administrar_autores_libros');//Envía a admin_libros

	
}
/**
 * Función que borrará un autor.
 * @var $id int.
 * 
 */
function controlador_borrar_autor(){

	$id = $_GET['id'];

	borrar_autor($id);
	header('Location: http://localhost/Tarea_Global_DWES/index.php/administrar_autores_libros');//Envía admin_libros

	
}

/**
 * Función que lista los autrores
 * @return Array con la lista de autores
 * 
 */
function lista_autores(){

	$lista_autores = cargarAutores();
		return $lista_autores;
}
/**
 * Función que modificar los autores
 * 
 */ 
function update_autores(){

	
		
		if(isset($_POST['up_autor'])){

			
			$lista_modificada_autor = array ('nombre_autor'=>$_POST['nombre_autor'],'apellidos_autor'=> $_POST['apellidos_autor'],'nacionalidad_autor'=> $_POST['nacionalidad'],'id_autor'=> $_POST['id_autor']);
			
			update_autor($lista_modificada_autor);
		}

	include_once 'Vista/administrar_autores_libros.php';	
	

}
/**
 * Función que modifica lo libros
 * 
 */
function update_book(){

	
		
		if(isset($_POST['up_libro'])){

			

			$lista_modificada_libro = array ('id_libro'=>$_POST['id_libro'], 'titulo_libro'=>$_POST['titulo_libro'], 'f_publicacion'=>$_POST['f_publicacion'],'id_autor'=>$_POST['id']);
			
			 update_libro($lista_modificada_libro);

		}
		
		include 'Vista/update_libros.php';	
}


?>