<?php
// Controlador de franjas horarias.
include_once("Modelos/mod_franjas.php");
include_once("view.php");

class FranjasController {

    private $db;
    private $mod_franjas; // Declaro el modelo

    public function __construct()
    {
        $this->mod_franjas = new Franjas(); // Instancio los modelos
        
    }

    public function mostrarListaFranjas() // Muestro la lista de las franjas horarias.
    {
        if (Seguridad::haySesion()) {
            $data["listaFranjas"] = $this->mod_franjas->getAll();
            View::render("mod_franjas/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::renderizado("mod_usuarios/login", $data);
        }
        
    }


// ---------------------------------Formulario de alta de franjas horarias ---------------------
public function formularioInsertarFranjas()
    {
        if (Seguridad::haySesion()) {
            $data["listaFranjas"] = $this->mod_franjas->getAll();
            View::render("mod_franjas/form", $data);
       } else {
            $data["error"] = "No tienes permiso para eso";
            View::renderizado ("mod_usuarios/login", $data);
        }
        
    }
// --------------------------- Inserción de Franjas horarias -------------------------
    public function insertarFranjas()
    {
        if (Seguridad::haySesion()) {
          

            $dayOfWeek = Seguridad::limpiar($_REQUEST["dayOfWeek"]);
            $startTime = Seguridad::limpiar($_REQUEST["startTime"]);
            $endTime = Seguridad::limpiar($_REQUEST["endTime"]);
            
        
            $result = $this->mod_franjas->insert($dayOfWeek, $startTime, $endTime);


            $data["listaFranjas"] = $this->mod_franjas->getAll();
            View::render("mod_franjas/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("mod_usuarios/login", $data);
        }
    }
//-------------------------- Borrado de Franjas-----------------------------
    public function borrarFranjas()
    {
        if (Seguridad::haySesion()) {
            // Recuperamos el id de la franja que queremos borrar
            $id = Seguridad::limpiar($_REQUEST["id"]); 
            // Pedimos al modelo que intente borrar la franja horaria
            $result = $this->mod_franjas->delete($id);
            // Comprobamos si el borrado ha tenido éxito
            if ($result == 0) {
                $data["error"] = "Ha ocurrido un error al borrar la franja horaria. Por favor, inténtelo de nuevo";
            } else {
                $data["info"] = "Franja horaria borrada con éxito";
            }

            $data["listaFranjas"] = $this->mod_franjas->getAll();
            View::render("mod_franjas/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("mod_usuarios/login", $data);
        }
    }

    // --------------------Formulario de modificación de franjas horarias-----------------------
    public function formularioModificarFranjas() {
        // Recuperamos los datos de la franja a modificar
        $data["mod_franjas"] = $this->mod_franjas->get($_REQUEST["id"]);
        // Renderizamos la vista de inserción de franjas horarias, pero enviándole los datos de la franja horaria.
        
        View::render("mod_franjas/form", $data);
    }
// -------------------------------Modificación de franjas horarias------------------------
   
public function modificarFranjas()
    {
        if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario
            $id = Seguridad::limpiar($_REQUEST["id"]); 
            $dayOfWeek = Seguridad::limpiar($_REQUEST["dayOfWeek"]);
            $startTime = Seguridad::limpiar($_REQUEST["startTime"]);
            $endTime = Seguridad::limpiar($_REQUEST["endTime"]);
            

            // Pedimos al modelo que haga el update
            $result = $this->mod_franjas->update($id, $dayOfWeek, $startTime, $endTime);
            if ($result == 1) {
                $data["info"] = "Horario actualizado con éxito";
            } else {
                // Si la modificación de la franja ha fallado, mostramos mensaje de error
                $data["error"] = "Ha ocurrido un error al modificar el horario. Por favor, inténtelo más tarde";
            }
            $data["listaFranjas"] = $this->mod_franjas->getAll();
            View::render("mod_franjas/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("mod_usuarios/login", $data);
        }
        
    }
// ---------------------- Buscar una franja horaria -------------------
    public function buscarFranjas()
    {
        if (Seguridad::haySesion()) {
            // Recuperamos el texto de búsqueda de la variable de formulario
            $textoBusqueda = Seguridad::limpiar($_REQUEST["textoBusqueda"]);
            // Buscamos los libros que coinciden con la búsqueda
            $data["listaFranjas"] = $this->mod_franjas->search($textoBusqueda);
            $data["info"] = "Resultados de la búsqueda: <i>$textoBusqueda</i>";
            // Mostramos el resultado en la misma vista que la lista completa de franjas
            View::render("mod_franjas/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::renderizado("mod_usuarios/login", $data);
        }
    }
}
?>