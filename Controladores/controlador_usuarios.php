<?php

include_once ("Modelos/mod_usuarios.php");
include_once("view.php");


class UsuariosController {

    private $mod_usuarios;

    public function __construct() {
        $this->mod_usuarios = new Usuario();
    }

    // Muestra el formulario de login
    public function formLogin() {
        View::renderizado("mod_usuarios/login");
    }

    // Comprueba los datos de login. Si son correctos, el modelo iniciará la sesión y
    // desde aquí se redirige a otra vista. Si no, nos devuelve al formulario de login.
    public function procesarFormLogin() {
        $username = Seguridad::limpiar($_REQUEST["username"]);
        $password = Seguridad::limpiar($_REQUEST["password"]);
        $result = $this->mod_usuarios->login($username, $password);
        if ($result) { 
            header("Location: index.php?controller=RecursosController&action=mostrarListaRecursos");
        } else {
            $data["error"] = "Usuario o contraseña incorrectos";
            View::renderizado("mod_usuarios/login", $data);
        }
    }

    // Cierra la sesión y nos lleva a la vista de login
    public function cerrarSesion() {
        $this->mod_usuarios->cerrarSesion();
        $data["info"] = "Sesión cerrada con éxito";
        View::renderizado("mod_usuarios/login", $data);
    }

     // --------------------------------- Mostrar lista de usuarios----------------------------------------
    public function mostrarListaUsuarios()
    {
        if (Seguridad::haySesion()) {
            $data["listaUsuarios"] = $this->mod_usuarios->getAll();
            View::render("mod_usuarios/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::renderizado("mod_usuarios/login", $data);
        }
        
    }

      //----------------------Formulario de alta de usuarios-----------------------------------------

    public function formularioInsertarUsuarios()
    {
        if (Seguridad::haySesion()) {
            $data["listaUsuarios"] = $this->mod_usuarios->getAll();
            View::render("mod_usuarios/form", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::renderizado("mod_usuarios/login", $data);
        }
    }
        
    
// ------------------------------- Inserción de usuarios--------------------------------------
    public function insertarUsuarios()
    {
        if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario

            $username = Seguridad::limpiar($_REQUEST["username"]);
            $password = Seguridad::limpiar($_REQUEST["password"]);
            $realname = Seguridad::limpiar($_REQUEST["realname"]);
            $type = Seguridad::limpiar($_REQUEST["type"]);
        
            $result = $this->mod_usuarios->insert($username, $password, $realname, $type);
        

            $data["listaUsuarios"] = $this->mod_usuarios->getAll();
            View::render("mod_usuarios/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::renderizado("mod_usuarios/login", $data);
        }
    }

    // --------------------------------- Borrado de usuarios ---------------------------------

    public function borrarUsuarios()
    {
        if (Seguridad::haySesion()) {
            // Recuperamos el id del recurso que hay que borrar
            $id = Seguridad::limpiar($_REQUEST["id"]); 
            // Pedimos al modelo que intente borrar el usuario
            $result = $this->mod_usuarios->delete($id);
            // Comprobamos si el borrado ha tenido éxito
            if ($result == 0) {
                $data["error"] = "Ha ocurrido un error al borrar el usuario. Por favor, inténtelo de nuevo";
            } else {
                $data["info"] = "Usuario borrado con éxito";
            }

            $data["listaUsuarios"] = $this->mod_usuarios->getAll();
            View::render("mod_usuarios/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::renderizado("mod_usuarios/login", $data);
        }
    }

    // --------------------Formulario de modificación de recursos-----------------------
    public function formularioModificarUsuarios() {
        // Recuperamos los datos del libro a modificar
        $data["mod_usuarios"] = $this->mod_usuarios->get($_REQUEST["id"]); 
        // Renderizamos la vista de inserción de libros, pero enviándole los datos del usuario recuperado.
    
        View::render("mod_usuarios/form", $data);
    }
// -------------------------------Modificación de recursos------------------------
   
public function modificarUsuarios()
    {
       if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario
            $id = Seguridad::limpiar($_REQUEST["id"]); 
            $username = Seguridad::limpiar($_REQUEST["username"]);
            $password = Seguridad::limpiar($_REQUEST["password"]);
            $realname = Seguridad::limpiar($_REQUEST["realname"]);
            $type = Seguridad::limpiar($_REQUEST["type"]);
            

            // Pedimos al modelo que haga el update
            $result = $this->mod_usuarios->update($id, $username, $password, $realname, $type);
            if ($result == 1) {
                $data["info"] = "Libro actualizado con éxito";
            } else {
                // Si la modificación del usuario ha fallado, mostramos mensaje de error
                $data["error"] = "Ha ocurrido un error al modificar el usuario. Por favor, inténtelo más tarde";
            }
            $data["listaUsuarios"] = $this->mod_usuarios->getAll();
            View::render("mod_usuarios/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::renderizado("mod_usuarios/login", $data);
        }
        
    }
// -----------------------------Buscar un usuario ---------------------------
    public function buscarUsuarios()
    {
        if (Seguridad::haySesion()) {
            // Recuperamos el texto de búsqueda de la variable de formulario
            $textoBusqueda = Seguridad::limpiar($_REQUEST["textoBusqueda"]);
            // Buscamos los libros que coinciden con la búsqueda
            $data["listaUsuarios"] = $this->mod_usuarios->search($textoBusqueda);
            $data["info"] = "Resultados de la búsqueda: <i>$textoBusqueda</i>";
            // Mostramos el resultado en la misma vista que la lista completa de usuarios
            View::render("mod_usuarios/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::renderizado("mod_usuarios/login", $data);
        }
    }
         
 
}