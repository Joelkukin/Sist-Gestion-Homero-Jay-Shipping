<?php
include_once "./Autoparte.php";
include_once "./Vehiculo.php";
include_once "./Lista.php";
include_once "./Direccion.php";
include_once "./Carga.php";
include_once "./utils.php";

class Camion extends Vehiculo {

    public $ruta;
    public $autopartes;

    function __construct($empresa, $matricula, $capacidad, $es_propio = false, $es_refrigerado = false) {
        parent::__construct($empresa, $matricula, $capacidad, $es_propio, $es_refrigerado, "urbana");

        # relacion de composicion con clase autoparte 
        if($es_propio){
            $this->autopartes = new Lista(
                new Autoparte("chasis", 365*15),
                new Autoparte("motor", 365*5),
                new Autoparte("rueda del izq", 365*2),
                new Autoparte("rueda del der", 365*2),
                new Autoparte("rueda tra izq", 365*2),
                new Autoparte("rueda tra der", 365*2),
                new Autoparte("carroceria", 365*7),
                new Autoparte("furgon", 365*5)
            );
        }
        
    }

    public function ver_autopartes() { 
        return $this->autopartes;
    }

    public function agregar_autopartes(Autoparte ...$autopartes) {
        return $this->autopartes->agregar($autopartes);
    }
    
    public function eliminar_autopartes(Autoparte ...$autopartes) {
        return $this->autopartes->eliminar($autopartes);
    }

    public function salir_a_reparto() {
        $this->ruta = null;
        $this->carga = null;
        foreach($this->autopartes as $autoparte){
            $this->autoparte->usar();
        }
        return [
            $this->ruta,
            $this->carga
        ];
    }

    public function realizar_mantenimiento() {
        

        foreach ($this->autopartes as $autoparte) {
            
            var_dump("viendo autoparte de metodo 'realizar_mantenimiento'(): ", $autoparte);
            $autoparte->realizar_mantenimiento();
        }
        return true;
    }
}

function test_camion(){
    echo "<h3>Test Clase Camion</h3>";

    $coche = new Camion("Homero Jay Shipping", "HEX621", 10000, true, true);
    
    var_dump("<h4>es_propio: </h4>",$coche->es_propio);
    var_dump("ver_autopartes: </h4>",$coche->ver_autopartes());
    echo "<br><br>";
    var_dump("<h4>ver_empresa: </h4>", $coche->empresa);
    echo "<br><br>";
    var_dump("<h4>ver_matricula: </h4>",$coche->ver_matricula());
    echo "<br><br>";
    var_dump("<h4>ver_capacidad: </h4>",$coche->ver_capacidad());
    echo "<br><br>";
    var_dump("<h4>realizar_mantenimiento: </h4>",$coche->realizar_mantenimiento ());
    echo "<br><br>";
    var_dump("<h4>agregar_autopartes: </h4>",$coche->agregar_autopartes(new Autoparte("baulera", 1000)));
    echo "<br><br>";
    var_dump("<h4>eliminar_autopartes: </h4>",$coche->eliminar_autopartes(new Autoparte("baulera", 1000)));
    echo "<br><br>";
    var_dump("<h4>asignar_carga: </h4>",$coche->asignar_carga(new Carga(
        new Producto("alfajores", 48, 2, false),
        new Producto("chocolate", 48, 2, true),
        new Producto("bombones", 48, 2, true),
        new Producto("frasco de caramelos", 48, 2, false),
        new Producto("torta", 48, 2, true),
    )));
    echo "<br><br>";
    var_dump("<h4>asignar_ruta: </h4> ",$coche->asignar_ruta(
        new Ruta("larga distancia",
            new Direccion("Gral. Güemes", 503, "san isidro", "buenos Aires", "larga distancia"),
            new Direccion("Gral. Justo José de Urquiza", 425, "san isidro", "buenos Aires", "larga distancia"),
            new Direccion("Peru", 365, "san isidro", "buenos Aires", "larga distancia"),
            new Direccion("Echeverria", 93, "san isidro", "buenos Aires", "larga distancia"),
            new Direccion("Rafael Obligado", 7823, "san isidro", "buenos Aires", "larga distancia")
        )
    ));
    echo "<br><br>";
    var_dump("<h4>salir_a_reparto: </h4>",$coche->salir_a_reparto());
    echo "<br><br>";
    var_dump("<h4></h4>realizar_mantenimiento: </h4>",$coche->realizar_mantenimiento());
    echo "<br><br>";
}
test_camion();