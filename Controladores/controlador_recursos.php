<?php

// CONTROLADOR DE RECURSOS
include_once("Modelos/mod_recursos.php");  // Modelos. De momento, solo voy a tener el modelo de recursos
include_once("view.php"); // Esta es la vista

class RecursosController
{
    private $db;             // Conexión con la base de datos
    private $mod_recursos;  // Modelos

    public function __construct()
    {
        $this->mod_recursos = new Recursos(); // Instancio los modelos
        
    }

    // --------------------------------- Mostrar lista de recursos ----------------------------------------
    public function mostrarListaRecursos()
    {
        if (Seguridad::haySesion()) {
            $data["listaRecursos"] = $this->mod_recursos->getAll();
            View::render("mod_recursos/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::renderizado("mod_usuarios/login", $data);
        }
        
    }


    //----------------------Formulario de alta de recursos-----------------------------------------

    public function formularioInsertarRecursos()
    {
        if (Seguridad::haySesion()) {
            $data["listaRecursos"] = $this->mod_recursos->getAll();
            View::render("mod_recursos/form", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::renderizado("mod_usuarios/login", $data);
        }
    }
        
    
// ------------------------------- Inserción de recursos--------------------------------------
    public function insertarRecursos()
    {
        if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario

            $name = Seguridad::limpiar($_REQUEST["name"]);
            $description = Seguridad::limpiar($_REQUEST["description"]);
            $location = Seguridad::limpiar($_REQUEST["location"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], "Images/".$_FILES["image"]["name"]);
        
            $result = $this->mod_recursos->insert($name, $description, $location, "Images/".$_FILES["image"]["name"]);
        

            $data["listaRecursos"] = $this->mod_recursos->getAll();
            View::render("mod_recursos/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::renderizado("mod_usuarios/login", $data);
        }
    }

    // --------------------------------- Borrado de recursos ---------------------------------
    public function borrarRecursos()
    {
        if (Seguridad::haySesion()) {
            // Recuperamos el id del recurso que hay que borrar
            $id = Seguridad::limpiar($_REQUEST["id"]); 
            // Pedimos al modelo que intente borrar el recurso
            $result = $this->mod_recursos->delete($id);
            // Comprobamos si el borrado ha tenido éxito
            if ($result == 0) {
                $data["error"] = "Ha ocurrido un error al borrar el recurso. Por favor, inténtelo de nuevo";
            } else {
                $data["info"] = "Recurso borrado con éxito";
            }

            $data["listaRecursos"] = $this->mod_recursos->getAll();
            View::render("mod_recursos/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::renderizado("mod_usuarios/login", $data);
        }
    }
// --------------------Formulario de modificación de recursos-----------------------
    public function formularioModificarRecursos() {
        // Recuperamos los datos del recurso a modificar
        $data["mod_recursos"] = $this->mod_recursos->get($_REQUEST["id"]); // CAMBIADO
        // Renderizamos la vista de inserción de recursos, pero enviándole los datos del recurso recuperado.
    
        View::renderizado("mod_recursos/form", $data);
    }
// -------------------------------Modificación de recursos------------------------
   
public function modificarRecursos()
    {
       if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario
            $id = Seguridad::limpiar($_REQUEST["id"]); //CAMBIADO
            $name = Seguridad::limpiar($_REQUEST["name"]);
            $description = Seguridad::limpiar($_REQUEST["description"]);
            $location = Seguridad::limpiar($_REQUEST["location"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], "Images/".$_FILES["image"]["name"]);
            

            // Pedimos al modelo que haga el update
            $result = $this->mod_recursos->update($id, $name, $description, $location, "Images/".$_FILES["image"]["name"]);
            if ($result == 1) {
                $data["info"] = "Libro actualizado con éxito";
            } else {
                // Si la modificación del recurso ha fallado, mostramos mensaje de error
                $data["error"] = "Ha ocurrido un error al modificar el libro. Por favor, inténtelo más tarde";
            }
            $data["listaRecursos"] = $this->mod_recursos->getAll();
            View::render("mod_recursos/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::renderizado("mod_usuarios/login", $data);
        }
        
    }

    //-----------------------------Buscar recursos-----------------------------------
    public function buscarRecursos()
    {
        if (Seguridad::haySesion()) {
            // Recuperamos el texto de búsqueda de la variable de formulario
            $textoBusqueda = Seguridad::limpiar($_REQUEST["textoBusqueda"]);
            // Buscamos los recursos que coinciden con la búsqueda
            $data["listaRecursos"] = $this->mod_recursos->search($textoBusqueda);
            $data["info"] = "Resultados de la búsqueda: <i>$textoBusqueda</i>";
            // Mostramos el resultado en la misma vista que la lista completa de recursos
            View::render("mod_recursos/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::renderizado("mod_usuarios/login", $data);
        }
    }
}

?>