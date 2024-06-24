<?php
include_once "./Lista.php";
include_once "./Vehiculo.php";
include_once "./VehiculoPropio.php";
include_once "./VehiculoTercerizado.php";
include_once "./Autoparte.php";

class Flota extends Lista {
  public $nombre_empresa;
  public $vehiculos_propios;
  public $vehiculos_tercerizados;
  function __construct($nombre_empresa, Array $vehiculos_propios){
    $this->nombre = $nombre_empresa;
    parent::__construct($vehiculos_propios);
  }
  
  function get_vehiculos(){$this->get_contenido();}
  
  function comprar(Vehiculo ...$vehiculos){
    
    }
  
  function contratar(){
    $this->agregar();
    
  }

  function get_nombre_empresa(){return $this->nombre_empresa;}
}

function test_flota(){$flota = new Flota ("Homero Jay Shipping",[new Autoparte("motor")]);
var_dump($flota->get_contenido());}
?>