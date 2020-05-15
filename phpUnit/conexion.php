<?php


	/*if(defined("EN_CONTROLADOR")){


	}else{

		// Si no está definida la constante EN_CONTROLADOR aparece un mensaje de error y se mata el proceso	
			echo "<h1>No se puede llamar directamente a este fichero</h1>";
			die("<h1><strong>NO ESTAS AUTORIZADO</strong></h1>");
	}*/

$url = 'mysql:host=localhost;dbename=tareaglobal';
$user = 'root';
$pass = '';


try{

	$conexion = new PDO($url,$user,$pass);//Conexión bases de datos.

	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Atributo para manejar los tipos de error.

	$conexion->exec("SET CHARACTER SET UTF8");//Para teclado español.
	

}catch (PDOException $e){

	
	die("Error ".$e->getMessage());

}



?>