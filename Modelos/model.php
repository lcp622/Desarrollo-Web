<?php

include_once "db.php";

// MODELO GENÉRICO

class Model {

  protected $table;    // Aquí guardaremos el nombre de la tabla a la que estamos accediendo
  protected $idColumn; // Aquí guardaremos el nombre de la columna que contiene el id (por defecto, "id")
  protected $db;       // Y aquí la capa de abstracción de datos

  public function __construct()  {
    $this->db = new Db();
  }

  public function getAll() { // Recupera todos los datos de la tabla que queremos de la base de datos.
    
    $list = $this->db->dataQuery("SELECT * FROM ".$this->table);
    return $list;
  }

  public function get($id) { //Me selecciona el elemento que quiero teniendo en cuenta el id.
    $record = $this->db->dataQuery("SELECT * FROM ".$this->table." WHERE ".$this->idColumn."= $id");
    return $record;
  } 

  public function delete($id) { // Me borra el elemento de la tabla seleccionada de la base de datos.

    $result = $this->db->dataManipulation("DELETE FROM ".$this->table." WHERE ".$this->idColumn." = $id");
    return $result;
  }
}