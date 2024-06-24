<?php
include_once "./autoparte.php";


abstract class Vehiculo
{
    protected $empresa; 
    protected $matricula;
    protected $capacidad;
    public $ruta;
    public $carga;
    public $propio;
    function __construct(String $empresa, String $matricula, String $capacidad, Lista $ruta, Lista $carga){
        
        $this->$empresa;
        $this->$matricula;
        $this->$capacidad;
        $this->$ruta;
        $this->$carga;
    }
    
    function ver_empresa (){
        return $this->empresa;
    }
    function ver_matricula(){
        return $this->matricula;
    }
    function ver_capacidad (){
        return $this->capacidad;
    }
    function realizar_mantenimiento (){
        $autopartes = $this->autopartes->get_contenido();
        foreach ($autopartes as $autoparte){
            $autoparte->cambiar();
        }
    }

    abstract function salir_a_reparto();
}

?>