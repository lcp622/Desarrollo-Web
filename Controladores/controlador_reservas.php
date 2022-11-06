
<?php
// Controlador de reservas. Aquí vamos a manejar todo el sistema de reservas
include_once("Modelos/mod_recursos.php");
include_once("Modelos/mod_usuarios.php");
include_once("Modelos/mod_franjas.php");
include_once("Modelos/mod_reservas.php");
include_once("view.php");

class ReservasController {

    private $db;
    private $mod_reservas; // Declaro el modelo
    private $mod_franjas; //Declaro el modelo

    public function __construct()
    {
        $this->mod_reservas = new Reservas(); // Instancio los modelos
        $this->mod_franjas = new Franjas();
        $this->mod_recursos = new Recursos();
        $this->mod_usuarios = new Usuario();

        
    }
//-------------- Me saca una vista con un desplegable con el usuario y la franja horaria------------------------------
    public function reservar()
    {
        $data["listadoTramosHorarios"] = $this->mod_franjas->getAll(); // $this->tramosHorarios es el modelo de Tramos Horarios. Debes instanciarlo antes (p. ej: en el constructor del controlador)
        $data["listadoUsuarios"] = $this->mod_usuarios->getAll();
        
        View::render("mod_reservas/all", $data);


        
    }

    public function insertarReservas(){
        
    }
   

}
?>