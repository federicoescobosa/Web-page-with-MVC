<?php
	


/**
 * Retorna un array con la información de los libros.
 *
 * @return Retorna una lista de libros.
*/
function cargarLibros(){

	require 'conexion.php';

	$sql ="SELECT libro.id_libro, libro.titulo, libro.f_publicacion, libro.id_autor,autor.id, autor.nombre, autor.apellidos,autor.nacionalidad FROM tareaglobal.libro JOIN tareaglobal.autor ON libro.id_autor = autor.id ";//Sentecia sql

	$resultado = $conexion->prepare($sql);//Prepara la conexion

	$resultado->execute();//Ejecuta la consulta.

	//Comprueba si hay más de una linea
	if($resultado->rowCount()>=1){ 

		
		while($fila=$resultado->fetch()){

			
			$listaLibros[]= array('id_libro'=>$fila['id_libro'],'titulo' =>$fila['titulo'],'fech'=>$fila['f_publicacion'],'id_autor'=>$fila['id_autor'],'id'=>$fila['id'],'nombre'=>$fila['nombre'],'apellidos'=>$fila['apellidos'],'nacionalidad'=>$fila['nacionalidad']);//Array

			
			
		}//fin while

	}//fin if
	
	return $listaLibros;//Retorno de la lista.
	$conexion=null;//Termina la conexión.

}//fin function

/**
 * Retorna un array con la información de los libros.
 * @param $id
 * @return Retorna una lista de libros.
*/
function cargaLibros($id){

	require 'conexion.php';

	$sql ="SELECT libro.id_libro, libro.titulo, libro.f_publicacion, autor.nombre, autor.apellidos FROM tareaglobal.libro JOIN tareaglobal.autor ON libro.id_autor = autor.id ";//Sentecia sql

	$resultado = $conexion->prepare($sql);//Prepara la conexion

	$resultado->execute();//Ejecuta la consulta.

	//Comprueba si hay más de una linea
	if($resultado->rowCount()>=1){ 

		
		while($fila=$resultado->fetch()){

			
			$listalibros[]= array('id_libro'=>$fila['id_libro'],'titulo' =>$fila['titulo'],'fech'=>$fila['f_publicacion'],'nombre'=>$fila['nombre'],'apellidos'=>$fila['apellidos']);//Array

			
			
		}//fin while

	}//fin if
	
	return $listalibros;//Retorno de la lista.
	$conexion=null;//Termina la conexión.

}//fin function
/**
 * Devuelve una lista con toda la información de los autores.
 * @author Federico Escobosa Osa.
 * @return array $listaAutores;
 */
function cargarAutores(){

	require 'conexion.php';

	$sql ="SELECT * FROM tareaglobal.autor";//Sentecia sql

	$resultado = $conexion->prepare($sql);//Prepara la conexion

	$resultado->execute();//Ejecuta la consulta.

	//Comprueba si hay más de una linea
	if($resultado->rowCount()>=1){ 

		
		while($fila=$resultado->fetch()){

			
			$listaAutores[]= array('id_autor'=>$fila['id'],'nombre' =>$fila['nombre'],'apellidos'=>$fila['apellidos'],'nacionalidad'=>$fila['nacionalidad'] );//Array

		}//fin while
	

	}//fin if

	return $listaAutores;//Retorno de la lista.
	$conexion=null;//Termina la conexión.
	
}

/**
 * Función booleana que devuelve true si el usuario ya existe.
 * @param $usuario, atributo que recibe d
 * @return Devuelve true o false.
 * 
 */

function existeUsuario($usuario){

	include 'conexion.php';// incluye la conexion

	
	$sql = "SELECT * FROM tareaglobal.usuarios Where usuario='".$usuario."'";//Sentencia sql
	
	
	$resultado = $conexion->prepare($sql);//Prepare

	$resultado->execute();//Ejecucion

	if($resultado->rowCount()>=1){ //Condición si el resultado es una o más filas.

		return true;

		
	}else{

		return false;
	}
	
	$conexion=null; //Cierra la conexion
	
}

/**
 * Comprueba si el usuario y la contraseña son correctos
 * @param   $usuario    Argumento
 * @param   $contrasena Argumento
 * @return boolean      Retorna true si la constraseña es igual a la introducida
 */
function compruebaUsuario($usuario,$contrasena){

	require "conexion.php";

	$sql = "SELECT contrasena FROM tareaglobal.usuarios Where usuario='".$usuario."'";//Sentencia sql
	
	
	$resultado = $conexion->prepare($sql);//Prepare

	$resultado->execute();//Ejecucion

	if($resultado->rowCount()>=1){ //Condición si el resultado es una o más filas.

		$fila = $resultado->fetch();//Se obtiene la fila como resultado en un array.

		$passDB = $fila['contrasena']; // Se asigna la contraseña de la base de datos.

		
		if(password_verify($contrasena, $passDB)){

			return true;
			
		}else{

			return false;
			
		}
		$resultado=null;//Libera resultados de la consulta.
		$conexion=null; //Cierra la conexion
	}else{

		
		return false;
		$conexion=null; //Cierra la conexion
	}
	
	


}

/**
 * Carga una lista con los datos de un usuario
 * @return Array con todas la columnas de la consulta.
 */
function cargarUsuario(){

	require 'conexion.php';

	$sql = "SELECT * FROM tareaglobal.usuarios";

	$resultado = $conexion->prepare($sql);

	$resultado->execute();

	if($resultado->rowCount()>=1){

		while ($fila = $resultado->fetch()){
			//Array lista usuarios
			$listaUsuarios[] = array('id'=>$fila['id'],'usuario'=>$fila['usuario'],'nombre'=>$fila['nombre'],'apellidos'=>$fila['apellidos'],'email'=>$fila['email'],'contrasena'=>$fila['contrasena'],'rol'=>$fila['rol']); 
		}
		$resultado=null;
		$conexion=null;
	}

	return $listaUsuarios;
	$conexion=null;
}

/**
 * Carga el rol de un usuario
 * @param  String $usuario argumento
 * @return String Retorna el valor de la columna rol diferenciado por su valor de usuario
 */
function cargarRol($usuario){

	require 'conexion.php';

	$sql = "SELECT rol FROM tareaglobal.usuarios WHERE usuario='".$usuario."'";

	$resultado = $conexion->prepare($sql);

	$resultado->execute();

	if($resultado->rowCount()>=1){

		$fila = $resultado->fetch();

		return $fila['rol'];
		$resultado=null;
		$conexion=null;
	}
	
	$conexion=null;

}


/**
 * Introduce un libro nuevo
 * @param Array $datos_libro Array con todos los datos para crear un libro
 */
function set_libro($datos_libro){

	require 'conexion.php';
	try{

		$sql ="INSERT INTO tareaglobal.libro (titulo,f_publicacion,id_autor) VALUES (:titulo,:f_publicacion,:id_autor)";

	// Prepare
	$stmt = $conexion->prepare($sql);

	$titulo = $datos_libro['titulo'];
	$fecha = $datos_libro['f_publicacion'];
	$id_autor =$datos_libro['id_autor'];

	//execute
	if($stmt->execute(array(':titulo'=>$titulo,':f_publicacion'=>$fecha,':id_autor'=>$id_autor))){

		echo "<script>alert('Los datos se han creado correctamente');</script>";

		$stmt=null;//Cierra statement
		$conexion=null;//Cierra conexion

	}else{

		echo "Ha ocurrido un error";

		$stmt=null;//Cierra statement
		$conexion=null;//Cierra conexion

	}//fin bloque if/else
	$conexion=null;//Cierra conexion

	}catch(PDOException $e){

		echo "<script>alert('Este título ya está registrado');</script>";
	}
	
}

/**
 * Introduce un autor nuevo
 * @param Array $datos_autor Array con todos los datos para introducir un nuevo autor
 */
function set_autor($datos_autor){

	require 'conexion.php';

	$sql ="INSERT INTO tareaglobal.autor (nombre,apellidos,nacionalidad) VALUES (:nombre,:apellidos,:nacionalidad)";

	// Prepare
	$stmt = $conexion->prepare($sql);

	$nombre = $datos_autor['nombre'];
	$apellidos_autor = $datos_autor['apellidos'];
	$nacionalidad = $datos_autor['nacionalidad'];

	//execute
	if($stmt->execute(array(':nombre'=>$nombre,':apellidos'=>$apellidos_autor,'nacionalidad'=>$nacionalidad))){

		echo "<script>alert('Los datos se han creado correctamente');</script>";

		$stmt=null;//Cierra statement
		$conexion=null;//Cierra conexion

	}else{

		echo "<script>alert('Ha ocurrido un error');</script>";

		$stmt=null;//Cierra statement
		$conexion=null;//Cierra conexion

	}//fin bloque if/else
	$conexion=null;//Cierra conexion
}

/**
 * Crea un nuevo usuario
 * @param  Array $lista_registro Array con todos los datos para crear un nuevo usuario
 * 
 */
function registrar_Usuario($datos_usuario){

	require 'conexion.php';

	//Encriptar contraseña con password_hash
	$hash = password_hash($datos_usuario['pass'],PASSWORD_DEFAULT,['cost'=>10]);

	
	$sql ="INSERT INTO tareaglobal.usuarios (usuario,nombre,apellidos,email,contrasena) VALUES (:usuario,:nombre,:apellidos,:email,:pass)";

	// Prepare
	$stmt = $conexion->prepare($sql);

	$usuario = $datos_usuario['usuario'];
	$nombre = $datos_usuario['nombre'];
	$apellidos = $datos_usuario['apellidos'];
	$email = $datos_usuario['email'];

	//Bind y execute
	if($stmt->execute(array(':usuario'=>$usuario,':nombre'=>$nombre,':apellidos'=>$apellidos,':email'=>$email,':pass'=>$hash))){

		echo "<script>alert('Los datos se han creado correctamente');</script>";

		$stmt=null;//Cierra statement
		$conexion=null;//Cierra conexion

	}else{

		echo "Ha ocurrido un error";

		$stmt=null;//Cierra statement
		$conexion=null;//Cierra conexion

	}//fin bloque if/else
	
}//fin funcion

/**
 * Borra un usuario diferenciado por su id
 * @param  Integer $id parámetro diferenciador
 * 
 */
function borrar_usuario($id){

	require 'conexion.php';

	$sql = "DELETE FROM tareaglobal.usuarios WHERE id='".$id."'";//Sentencia sql

	$resultado = $conexion->prepare($sql);

	$resultado->execute();

	if($resultado->rowCount()>=1){

		echo "<script>alert('El usuario se ha eliminado correctamente')</script>";
		
	}else{

		echo"<script>alert('No se ha podido eliminar el usuario')</script>";

	}
	$resultado=null;
	$conexion=null;
}

/**
 * Borra un libro por su id
 * @param  Integer $id parámetro diferenciador.
 * 
 */
function borrar_libro($id){

	require 'conexion.php';

	$sql = "DELETE FROM tareaglobal.libro WHERE id_libro='".$id."'";//Sentencia sql

	$resultado = $conexion->prepare($sql);

	$resultado->execute();

	if($resultado->rowCount()>=1){

		echo "<script>alert('El libro se ha eliminado correctamente')</script>";
	}else{

		echo"<script>alert('No se ha podido eliminar el libro')</script>";
	}
	$resultado=null;
	$conexion=null;
}

/**
 * Borra un autor por su id
 * @param  Integer $id parámetro diferenciador
 * 
 */
function borrar_autor($id){

	require 'conexion.php';

	try{

	$sql = "DELETE FROM tareaglobal.autor WHERE id='".$id."'";//Sentencia sql

	$resultado = $conexion->prepare($sql);

	$resultado->execute();

	if($resultado->rowCount()>=1){

		echo "<script>alert('El autor se ha eliminado correctamente')</script>";
	}else{

		echo"<script>alert('No se ha podido eliminar el autor')</script>";
	}

	$resultado=null;
	$conexion=null;



	}catch(Exception $e){

		
		$resultado=null;
		$conexion=null;

	}

	$resultado=null;
	$conexion=null;

}

/**
 * Modifica los datos de un usuario
 * @param  Array $lista_modificada Array con todos los datos para modificar el usuario
 * 
 */
function update_user($lista_modificada){

	require 'conexion.php';

	//Encriptar contraseña con password_hash
	$hash = password_hash($lista_modificada['contrasena'],PASSWORD_DEFAULT,['cost'=>10]);
	//Sentecia sql
	$sql ="UPDATE tareaglobal.usuarios SET usuario=:usuario, nombre=:nombre, apellidos=:apellidos, email=:email,contrasena=:contrasena,rol=:rol WHERE id=:id";
	
	$resultado = $conexion->prepare($sql);


	$resultado->execute($lista_modificada);

	if($resultado->rowCount()>=1){

		echo "<script>alert('Se han modificado los cambios con éxito')</script>";

	}
	$resultado=null;
	$conexion=null;
}
/**
 * Modifica los datos de un libro
 * @param  Array $lista_modificada Array con todos los datos para modificar el libro
 *
 */
function update_libro($lista_modificada){

	require 'conexion.php';

	//Sentecia sql
	$sql ="UPDATE tareaglobal.libro SET titulo=:titulo_libro, f_publicacion=:f_publicacion, id_autor=:id_autor WHERE id_libro=:id_libro";
	
	$resultado = $conexion->prepare($sql);

	
	$resultado->execute($lista_modificada);

	if($resultado->rowCount()>=1){

		echo "<script>alert('Se han modificado los cambios con éxito')</script>";

	}
	$resultado=null;
	$conexion=null;
}

/**
 * Modifica los valores de un autor
 * @param  Array $lista_modificada Array con todos los datos para modificar un libro.
 * 
 */
function update_autor($lista_modificada){

	require 'conexion.php';

	//Sentecia sql
	$sql ="UPDATE tareaglobal.autor SET nombre=:nombre_autor, apellidos=:apellidos_autor, nacionalidad=:nacionalidad_autor WHERE id=:id_autor";
	
	$resultado = $conexion->prepare($sql);
	
	$resultado->execute($lista_modificada);

	if($resultado->rowCount()>=1){

		echo "<script>alert('Se han modificado los cambios con éxito')</script>";

	}
	$resultado=null;
	$conexion=null;
}

	

?>