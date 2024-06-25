<?php

#mostrar mensaje por consola
function console_log($mensaje) {
    $STDERR = fopen("php://stderr", "w");
    fwrite($STDERR, "\n" . $mensaje . "\n\n");
    fclose($STDERR);
}

// Luego puedes usarla así:
console_log("Este es un mensaje de prueba");

// validar si un dato es de un tipo determinado
 function validar_dato($dato, $tipo){
    if (gettype($tipo) !== "string") {
        return new Exception("el parámetro $tipo debe ser un string ");
    }
    if (gettype($dato) !== $tipo) {
        return false;
    }
    if (gettype($dato) !== $tipo) {
        return true;
    }
}

/* function ver_objeto(Object $objeto){
    $html = "";
    $headers;
    $filas;

    foreach( $objeto as $key => $value){
        $html .= "<tr><td>$key</td><td>$value</td></tr>";
    }
    
    $html = "
    <table>
        <thead>
            <th>Propiedad</th><th>Valor</th>
        </thead>
        <tbody>
            ".$filas."
        </tbody>
    </table>
    ";
    return $html;
} */

?>