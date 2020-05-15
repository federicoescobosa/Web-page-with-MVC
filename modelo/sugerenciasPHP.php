<?php
    
        include 'conexion.php';
        include 'modelo.php';

         $list_libros = cargarLibros();

        foreach ($list_libros as $clave => $valor) {
                
            
            $a[]=$valor['titulo'];//Para que sólo muestre el título.
           
               
        }

        // obtenemos el parámetro GET de la URL (Ej: "sugerenciasPHP.php?q=Anna")
        $q = $_REQUEST["q"];

        // Variable que contendrá las coincidencias
        $sugerencias = "";

       

        //Entra en el bucle si el parámetro obtenido del GET ($q) es diferente a ""
        if ($q !== "") 
        {
            //Si el usuario ha insertado datos se pasan a minúscula
            $q = strtolower($q);
            //Almacenamos la longitud de la palabra
            $len=strlen($q);
            //Ahora vamos a buscar coincidencias en la "base de datos"
            foreach($a as $clave=>$name) 
            {

                // Buscamos los nombres que contengan la cadena insertada al principio
                //if (stristr($q, substr($name, 0, $len))) 
                if (stristr($name, $q)) //buscar en cualquier lugar
                {
                    $lista = resultado_sugerencias($name);
                    foreach ($lista as $clave => $valor):?>
                        
                
                        $sugerencias .= "<br>".$valor['id_libro']." ".$valor['titulo']." ".$valor['fech']; 
                    }
                    
                    
                }
            }
        }

        // Salida: "no se encuentran sugerencias" si no hay sugerencias
        echo $sugerencias === "" ? "no se encuentran sugerencias" : $sugerencias;
        $conexion=null;//Termina la conexión.


    /**
     * @param
     */     
    function resultado_sugerencias($name){
        include 'conexion.php';

        $sql = "SELECT * FROM  tareaglobal.libro WHERE titulo ='".$name."'";
        

        $resultado = $conexion->prepare($sql);

        $resultado->execute();//Ejecuta la consulta.

        //Comprueba si hay más de una linea
        if($resultado->rowCount()>=1){ 

            
            while($fila=$resultado->fetch()){
                
                
                $listaLibros[]= array('id_libro'=>$fila['id_libro'],'titulo' =>$fila['titulo'],'fech'=>$fila['f_publicacion']);//Array

                
                return $listaLibros;//Retorno de la lista si hay coincidencias.
                
            }//fin while

        }//fin if
    
    
    }

 
?>