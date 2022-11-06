<?php

include_once "model.php";
// Modelo de Franjas Horarias

class Franjas extends Model {

    // Constructor. Especifica el nombre de la tabla de la base de datos
    public function __construct()
    {
        $this->table = "TimeSlots";
        $this->idColumn = "id"; 
        parent::__construct();
    }

    // -----------------Inserción en la tabla de las franjas horarias------------------
    public function insert($dayOfWeek, $startTime, $endTime)
    {
        return $this->db->dataManipulation("INSERT INTO TimeSlots (dayOfWeek,startTime,endTime) VALUES ('$dayOfWeek','$startTime', '$endTime')");
    }

    // -------------------Actualización de las franjas horarias----------------------
    public function update($id, $dayOfWeek, $startTime, $endTime)
    {


        $ok = $this->db->dataManipulation("UPDATE TimeSlots SET
                                dayOfWeek = '$dayOfWeek',
                                startTime = '$startTime',
                                endTime = '$endTime'
                                WHERE id = '$id'"); // CAMBIADO
        return $ok;
    }
//--------------------Función para buscar franjas horarias------------------
    public function search($textoBusqueda)
    {
        // Buscamos las franjas horarias  que coincidan con el texto de búsqueda
        $result = $this->db->dataQuery("SELECT * FROM TimeSlots
					                    WHERE TimeSlots.dayOfWeek LIKE '%$textoBusqueda%'
					                    OR TimeSlots.startTime LIKE '%$textoBusqueda%'
					                    OR TimeSlots.endTime LIKE '%$textoBusqueda%'
					                    ORDER BY TimeSlots.dayOfWeek");
        return $result;
    }
}

?>