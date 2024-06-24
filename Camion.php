<?php
include_once "./Autoparte.php";
include_once "./Vehiculo.php";
include_once "./Lista.php";
include_once "./Direccion.php";
include_once "./Carga.php";

class Camion extends Vehiculo {

    public $ruta;
    public $autopartes;

    function __construct($empresa, $matricula, $capacidad, $propio = false) {
        parent::__construct($empresa, $matricula, $capacidad, $propio);

        $this->empresa = $empresa;
        $this->matricula = $matricula;
        $this->capacidad = $capacidad;
        $this->propio = $propio;
        # relacion de composicion con clase autopartes
        if($propio){
            $this->autopartes = new Lista(
                new Autoparte("chasis", 365*15),
                new Autoparte("motor", 365*10),
                new Autoparte("rueda del izq", 365*2),
                new Autoparte("rueda del der", 365*2),
                new Autoparte("rueda tra izq", 365*2),
                new Autoparte("rueda tra der", 365*2),
                new Autoparte("rueda 1 trailer izq", 365*2),
                new Autoparte("rueda 1 trailer der", 365*2),
                new Autoparte("rueda 2 trailer izq", 365*2),
                new Autoparte("rueda 2 trailer der", 365*2),
                new Autoparte("carroceria", 365*7),
                new Autoparte("container", 365*15)
            );
        }
    }

    # get capacidad está en la clase padre como ver_capacidad

    # su superclase está en español, por lo tanto su subclase tambien debe estar en español
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
        $this->carga;
        foreach($this->autopartes as $autoparte){
            $this->autoparte->usar();
        }
        return [
            $this->ruta,
            $this->carga
        ];
    }

    public function realizar_mantenimiento() {
        $autopartes_a_cuidar = Array();
        array_merge($autopartes_a_cuidar,$this->autopartes->buscar_propiedad("nombre", "rueda"));
        $autopartes_a_cuidar[] = $this->autopartes->buscar_propiedad("nombre", "furgon");
        $autopartes_a_cuidar[] = $this->autopartes->buscar_propiedad("nombre", "motor");
        return true;
    }
}

function test_camion(){
    $camion = new Camion("Homero Jay Shipping", "HEX621", 500, true);
    
    var_dump("ver_autopartes: ",$camion->ver_autopartes());
    echo "<br><br>";
    var_dump("ver_empresa: ", $camion->empresa);
    echo "<br><br>";
    var_dump("ver_matricula: ",$camion->ver_matricula());
    echo "<br><br>";
    var_dump("ver_capacidad: ",$camion->ver_capacidad());
    echo "<br><br>";
    var_dump("realizar_mantenimiento: ",$camion->realizar_mantenimiento ());
    echo "<br><br>";
    var_dump("agregar_autopartes: ",$camion->agregar_autopartes(new Autoparte("baulera", 1000)));
    echo "<br><br>";
    var_dump("eliminar_autopartes: ",$camion->eliminar_autopartes(new Autoparte("baulera", 1000)));
    echo "<br><br>";
    var_dump("asignar_carga: ",$camion->asignar_carga(new Carga(
        new Producto("alfajores", 48000, 2, false),
        new Producto("chocolate", 48000, 2, true),
        new Producto("bombones", 48000, 2, true),
        new Producto("frasco de caramelos", 48000, 2, false),
        new Producto("torta", 48000, 2, true),
    )));
    echo "<br><br>";
    var_dump("asignar_ruta: ",$camion->asignar_ruta(
        new Direccion("Gral. Güemes", 503, "san isidro", "buenos Aires", "urbana"),
        new Direccion("Gral. Justo José de Urquiza", 425, "san isidro", "buenos Aires", "urbana"),
        new Direccion("Peru", 365, "san isidro", "buenos Aires", "urbana"),
        new Direccion("Echeverria", 93, "san isidro", "buenos Aires", "urbana"),
        new Direccion("Rafael Obligado", 7823, "san isidro", "buenos Aires", "urbana")
    ));
    echo "<br><br>";
    var_dump("salir_a_reparto: ",$camion->salir_a_reparto());
    echo "<br><br>";
    var_dump("realizar_mantenimiento: ",$camion->realizar_mantenimiento());
    echo "<br><br>";
}
