<?php
// Modelo de reservas.

include_once "model.php";


class Reservas extends Model

{

    // Constructor. Especifica el nombre de la tabla de la base de datos
    public function __construct()
    {
        $this->table = "Reservations";
        $this->idColumn = "id";
        $this->idResource = "idResource";
        $this->idTimeSlot = "idTimeSlot";
        $this->idUser = "idUser";
        parent::__construct();
    }

  
}
?>