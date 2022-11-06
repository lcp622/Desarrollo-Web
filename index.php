<?php

session_start();

include_once("Modelos/seguridad.php");

/*include_once "models/seguridad.php";*/ // -->Momentaneamente no lo voy a usar

// Hacemos include de todos los controladores
foreach (glob("Controladores/*.php") as $file) {
    include $file;
}

// Miramos el valor de la variable "controller", si existe. Si no, le asignamos un controlador por defecto
if (isset($_REQUEST["controller"])) {
    $controller = $_REQUEST["controller"];
} else {
    $controller = "UsuariosController";  // Controlador por defecto. Es el nombre de la
}

// Miramos el valor de la variable "action", si existe. Si no, le asignamos una acción por defecto
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    $action = "formLogin";  // Acción por defecto. Este método me va a devolver la lista de recursos
}

// Creamos un objeto de tipo $controller y llamamos al método $action()
$gestionrecursos = new $controller();
$gestionrecursos->$action();
?>