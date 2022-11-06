<?php

// Modelo de recursos

include_once "model.php";

class Recursos extends Model
{

    // Constructor. Especifica el nombre de la tabla de la base de datos
    public function __construct()
    {
        $this->table = "Resources";
        $this->idColumn = "id"; //CAMBIADO
        parent::__construct();
    }


     //Inserta un recurso.
    public function insert($name, $description, $location, $image)
    {
        return $this->db->dataManipulation("INSERT INTO Resources (name,description,location,image) VALUES ('$name','$description', '$location', '$image')");
    }
    

    // Actualiza un recurso.
   public function update($id, $name, $description, $location, $image)
    {


        $ok = $this->db->dataManipulation("UPDATE Resources SET
                                name = '$name',
                                description = '$description',
                                location = '$location',
                                image = '$image'
                                WHERE id = '$id'"); 
        return $ok;
    }

    public function search($textoBusqueda)
    {
        // Buscamos los recursos que coincidan con la búsqueda.
        $result = $this->db->dataQuery("SELECT * FROM Resources
					                    WHERE Resources.name LIKE '%$textoBusqueda%'
					                    OR Resources.description LIKE '%$textoBusqueda%'
					                    OR Resources.location LIKE '%$textoBusqueda%'
					                    OR Resources.image LIKE '%$textoBusqueda%'
					                    ORDER BY Resources.name");
        return $result;
    }

}
?>