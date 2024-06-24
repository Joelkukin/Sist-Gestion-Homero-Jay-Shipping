<?php

class Direccion {
    // Propiedades de la clase
    public $calle;
    public $numero;
    public $localidad;
    public $provincia;
    public $codigoPostal;
    public $tipoArea;

    // Constructor para iniciar la clase
    function __construct($calle, $numero, $localidad, $provincia, $tipoArea) {
        $this->calle = $calle;
        $this->numero = $numero;
        $this->localidad = $localidad;
        $this->provincia = $provincia;
        $this->tipoArea = $tipoArea;

        // Validar datos al crear la instancia
        $this->validarDireccion();
    }

    // Método para validar la dirección
    private function validarDireccion() {
        // Validar calle (no vacío)
        if (empty($this->calle)) {
            throw new Exception("La calle no puede estar vacía");
        }

        // Validar número (numérico mayor que cero)
        if (!is_numeric($this->numero) || $this->numero <= 0) {
            throw new Exception("El número debe ser un número positivo");
        }

        // Validar localidad (no vacío)
        if (empty($this->localidad)) {
            throw new Exception("La localidad no puede estar vacía");
        }

        // Validar provincia (no vacío)
        if (empty($this->provincia)) {
            throw new Exception("La provincia no puede estar vacía");
        }

    

        // Validar tipoArea (debe ser "rural" o "urbana")
        if ($this->tipoArea != "larga distancia" && $this->tipoArea != "urbana") {
            throw new Exception("El tipo de área debe ser 'larga distancia' o 'urbana'");
        }
    }

    // Método para obtener la dirección completa
    function getDireccionCompleta() {
        return $this->calle . " " . $this->numero . ", " . $this->localidad . ", " . $this->provincia . ", (" . $this->tipoArea . ")";
    }

    // Método para mostrar la dirección completa por pantalla
    function mostrarDireccion() {
        echo $this->getDireccionCompleta() . "\n";
    }
}

function test_direccion() {// Crear una instancia para comprobar funcionamiento
$direccion = new Direccion("Av. Siempreviva", 123, "La Ciudad", "Buenos Aires", 'urbana');

// Mostrar la dirección completa
$direccion->mostrarDireccion();}

?>