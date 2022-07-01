<?php

class Empresa{

    private $idEmpresa;
    private $nombre;
    private $direccion;    
    private $msjOperacion;

    public function __construct(){
        $this->idEmpresa = 0;
        $this->nombre = "";
        $this->direccion = "";
        $this->colViajes = [];
    }

    public function cargarDatos($nombreE,$dirE){
        // $this->setIdEmpresa($idE);
        $this->setNombre($nombreE);
        $this->setDireccion($dirE);        
    }

    public function getIdEmpresa(){
        return $this->idEmpresa;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getDireccion(){
        return $this->direccion;
    }   
    public function getMsjOperacion(){
        return $this->msjOperacion;
    }
    public function setIdEmpresa($idE){
        $this->idEmpresa = $idE;
    }
    public function setNombre($nombreE){
        $this->nombre = $nombreE;
    }
    public function setDireccion($dirE){
        $this->direccion = $dirE;
    }    
    public function setMsjOperacion($msjOperacion){
        $this->msjOperacion = $msjOperacion;
    }    

    public function __toString(){
        return  "DATOS EMPRESA: " . 
                "\nID EMPRESA: " . $this->getIdEmpresa() .
                "\nNOMBRE EMPRESA: " . $this->getNombre() .
                "\nDIRECCION EMPRESA: " . $this->getDireccion() . "\n\n";
    }

    /**
	 * Recupera los datos de un empresa por id de empresa
	 * @param int $idEmpresa;
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function buscarEmp($idEmpresa){
		$base = new BaseDatos();
		$consultaEmpresa = "Select * from empresa where idempresa=" . $idEmpresa;
		$respuesta = false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaEmpresa)){
				if($row=$base->Registro()){
				    $this->setIdEmpresa($idEmpresa);
					$this->setNombre($row['enombre']);
					$this->setDireccion($row['edireccion']);
					$respuesta = true;
				}
		 	}else{
		 		$this->setMsjOperacion($base->getError());		 		
			}
		 }else{
		 	$this->setMsjOperacion($base->getError());		 	
		 }		
		 return $respuesta;
	}

    public function listarEmp($condicion=""){
	    $aEmpresa = null;
		$base = new BaseDatos();
		$consultaEmpresa = "Select * from empresa ";
		if ($condicion != ""){
		    $consultaEmpresa = $consultaEmpresa . ' where ' . $condicion;
		}
		$consultaEmpresa .= " order by idempresa ";		
		if($base->Iniciar()){
			if($base->Ejecutar($consultaEmpresa)){
				$aEmpresa = array();
				while($row = $base->Registro()){					
					$IdEmpresa = $row['idempresa'];					
					$objEmpresa = new Empresa();
					$objEmpresa->buscarEmp($IdEmpresa);
					array_push($aEmpresa,$objEmpresa);
				}							
		 	}else{
		 		$this->setMsjOperacion($base->getError());		 		
			}
		 }else{
		 	$this->setMsjOperacion($base->getError());		 	
		 }	
		 return $aEmpresa;
	}

    public function insertarEmp(){
		$base = new BaseDatos();
		$respuesta = false;
		$consultaInsertar = "INSERT INTO empresa(enombre, edireccion)
				VALUES ('". $this->getNombre()."','" . $this->getDireccion() . "')";		
		if($base->Iniciar()){
			if($idEmp = $base->devuelveIDInsercion($consultaInsertar)){
				$this->setIdEmpresa($idEmp);
			    $respuesta = true;
			}else{
				$this->setMsjOperacion($base->getError());
			}
		}else{
			$this->setMsjOperacion($base->getError());
		}
		return $respuesta;
	}

    public function modificarEmp(){
	    $respuesta = false; 
	    $base = new BaseDatos();
		$consultaModifica = "UPDATE empresa SET enombre='" . $this->getNombre() . "',edireccion='" . $this->getDireccion() . "' WHERE idempresa=" . $this->getIdEmpresa();
		if($base->Iniciar()){
			if($base->Ejecutar($consultaModifica)){
			    $respuesta=  true;
			}else{
				$this->setMsjOperacion($base->getError());				
			}
		}else{
			$this->setMsjOperacion($base->getError());			
		}
		return $respuesta;
	}

    public function eliminarEmp(){
		$base = new BaseDatos();
		$respuesta = false;
		if($base->Iniciar()){
				$consultaBorra = "DELETE FROM empresa WHERE idempresa = " . $this->getIdEmpresa();
				if($base->Ejecutar($consultaBorra)){
				    $respuesta = true;
				}else{
					$this->setMsjOperacion($base->getError());					
				}
		}else{
			$this->setMsjOperacion($base->getError());
		}
		return $respuesta; 
	}

}

?>