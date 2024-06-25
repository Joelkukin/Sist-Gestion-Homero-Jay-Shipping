<?php
include_once "./Lista.php";
include_once "./Direccion.php";

class Ruta extends Lista{
  public $tipo_de_area;

  function __construct(String $tipo_de_area , Direccion ...$direcciones) {
    $this->tipo_de_area = $tipo_de_area;
    parent::__construct(...$direcciones);
  }
}

?>