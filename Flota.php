<?php
include_once "./Lista.php";
include_once "./Vehiculo.php";
include_once "./Camion.php";
include_once "./Utilitario.php";
include_once "./Autoparte.php";
include_once "./utils.php";

class Flota extends Lista{
  public $nombre_empresa;
  function __construct($nombre_empresa){
    $this->nombre_empresa = $nombre_empresa;
  }
  
  function get_vehiculos(){return $this->get_contenido();}

  function comprar(Vehiculo ...$vehiculos){
    $result=[];
    foreach ($vehiculos as $vehiculo) {
      # validar si es propio
      if(!$vehiculo->es_propio){$vehiculo->es_propio = true;}
      
      $result []= $this->agregar($vehiculo);
    
    }

    return $result;
  }
  
  function contratar(Vehiculo ...$vehiculos){

    foreach ($vehiculos as $vehiculo) {
      # validar si es propio
      if($vehiculo->es_propio){$vehiculo->es_propio = false;}
      
     $this->agregar($vehiculo);
    
     var_dump($vehiculo);
    } 
    
  }

  function get_nombre_empresa(){return $this->nombre_empresa;}
}

function test_flota(){
  echo "<h3>Test Clase Flota</h3>";
  $flota = new Flota ("Homero Jay Shipping");

  var_dump("<h4>comprar: </h4>");
  
  var_dump($flota->comprar(
    new Camion("Homero Jay Shipping", "SIM123", 12000, true),
    new Camion("Homero Jay Shipping", "SIN123", 12000, true, true),
    new Utilitario("Homero Jay Shipping", "SIM124", 12000, false)
  ));
  
  var_dump("<h4>contratar: </h4>");
  var_dump($flota->contratar(new Utilitario("Homero Jay Shipping", "REF124", 12000, false, true)));
  
  var_dump("<h4>get_vehiculos: </h4>");
  var_dump($flota->get_vehiculos());
 
  var_dump("<h4>get_nombre_empresa: </h4>");
  var_dump($flota->get_nombre_empresa());

}
test_flota();
?>