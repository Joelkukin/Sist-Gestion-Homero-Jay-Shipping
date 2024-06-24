<?php
    include_once "../Lista.php";
    include_once "../Autoparte.php";
    include_once "../utils.php";

     $autopartes = new Lista(
        new Autoparte("motor"), 
        new Autoparte("transmision"),
        new Autoparte("rueda"),
        new Autoparte("rueda"),
        new Autoparte("rueda"),
        new Autoparte("rueda"),
        new Autoparte("chasis"),
        new Autoparte("freno"),
        new Autoparte("freno"),
        new Autoparte("freno")
    );

    

    
    $freno = new Autoparte("freno");
    $valor = "nombre";
    $propiedad = "nombre";
    var_dump($freno->$propiedad)."\n";
    
    print_r("<h3>Metodo ver</h3>");
    echo json_encode($autopartes->ver(), JSON_PRETTY_PRINT)."<br>";
    
    print_r("<h3>Metodo agregar</h3>");
    echo json_encode($autopartes->agregar(new Autoparte("freno")), JSON_PRETTY_PRINT)."<br>";
    
    print_r("<h3>Metodo buscar</h3>");
    echo json_encode($autopartes->buscar("nombre", "freno"), JSON_PRETTY_PRINT)."<br>";

    print_r("<h3>Metodo reemplazar</h3>");
    echo json_encode($autopartes->reemplazar($autopartes->buscar("nombre", "freno",2), new Autoparte("frBrandstorm")), JSON_PRETTY_PRINT)."<br><br>";
    
    print_r("<h3>Metodo eliminar</h3>");
    # typeof $arg = array
    echo json_encode($autopartes->eliminar($autopartes->buscar("nombre", "frBrandstorm")), JSON_PRETTY_PRINT)."<br>"; 
    echo "<br>".json_encode($autopartes->eliminar([9,8]), JSON_PRETTY_PRINT)."<br>"; 
    # typeof $arg = int
    echo "<br>".json_encode($autopartes->eliminar(9), JSON_PRETTY_PRINT)."<br>"; 
    # typeof $arg = obj
    echo "<br>".json_encode($autopartes->eliminar(new Autoparte("motor")), JSON_PRETTY_PRINT)."<br>"; 
?>