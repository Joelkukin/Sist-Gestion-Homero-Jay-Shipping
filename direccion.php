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
    function __construct($calle, $numero, $localidad, $provincia, $codigoPostal, $tipoArea) {
        $this->calle = $calle;
        $this->numero = $numero;
        $this->localidad = $localidad;
        $this->provincia = $provincia;
        $this->codigoPostal = $codigoPostal;
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

        // Validar código postal (formato numérico de 5 dígitos)
        if (!is_numeric($this->codigoPostal) || strlen($this->codigoPostal) != 5) {
            throw new Exception("El código postal debe ser un número de 5 dígitos");
        }

        // Validar tipoArea (debe ser "rural" o "urbana")
        if ($this->tipoArea != "rural" && $this->tipoArea != "urbana") {
            throw new Exception("El tipo de área debe ser 'rural' o 'urbana'");
        }
    }

    // Método para obtener la dirección completa
    function getDireccionCompleta() {
        return $this->calle . " " . $this->numero . ", " . $this->localidad . ", " . $this->provincia . ", " . $this->codigoPostal . " (" . $this->tipoArea . ")";
    }

    // Método para mostrar la dirección completa por pantalla
    function mostrarDireccion() {
        echo $this->getDireccionCompleta() . "\n";
    }
}

// Crear una instancia para comprobar funcionamiento
$direccion = new Direccion("Av. Siempreviva", 123, "La Ciudad", "Buenos Aires", 01414, 'urbana');

// Mostrar la dirección completa
$direccion->mostrarDireccion();

?>