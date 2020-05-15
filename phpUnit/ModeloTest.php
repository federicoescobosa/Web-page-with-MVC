<?php
    use PHPUnit\Framework\TestCase;
    
    require "Modelo.php";


    final class ModeloTest extends TestCase {



    	public function testExisteUsuario(){


    		$modelo = new Modelo();

    		$this->assertEquals(true, $modelo->existeUsuario("admin"));

    		$this->assertEquals(false, $modelo->existeUsuario("aaaa"));

    	}



    }
?>    