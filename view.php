<?php

// PLANTILLA DE LAS VISTAS

class View {
    public static function render($nombreVista, $data = null) {
        include("Vistas/header.php");
        include("Vistas/nav.php");
        include("Vistas/$nombreVista.php");
        include("Vistas/footer.php");
    }

    public static function renderizado($nombreVista, $data = null) {
        
        include("Vistas/$nombreVista.php");
        
    }
}
?>