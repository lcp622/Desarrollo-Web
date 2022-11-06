<?php

// MODELO DE USUARIOS

include_once "model.php";

class Usuario extends Model
{

    // Constructor. Especifica el nombre de la tabla de la base de datos
    public function __construct()
    {
        $this->table = "Users";
        $this->idColumn = "id";
        parent::__construct();
    }

    // Comprueba si $uername y $password corresponden a un usuario registrado. Si es así, inicia usa sesión creando
    // una variable de sesión y devuelve true. Si no, de vuelve false.
    public function login($username, $password) {
        $result = $this->db->dataQuery("SELECT * FROM Users WHERE username ='$username' AND password ='$password'");
        if (count($result) == 1) {
            Seguridad::iniciarSesion($result[0]->id);
            return true;
        } else {
            return false;
        }
    }

      //Inserta un usuario. 
      public function insert($username, $password, $realname, $type)
      {
          return $this->db->dataManipulation("INSERT INTO Users (username,password,realname,type) VALUES ('$username','$password', '$realname', '$type')");
      }

      // Actualiza un usuario
    public function update($id, $username, $password, $realname, $type)
   {


       $ok = $this->db->dataManipulation("UPDATE Users SET
                               username = '$username',
                               password = '$password',
                               realname = '$realname',
                               type = '$type'
                               WHERE id = '$id'"); 
       return $ok;
   }

   public function search($textoBusqueda)
   {
       // Buscamos los usuarios que coincidan con el texto de búsqueda

       $result = $this->db->dataQuery("SELECT * FROM Users
                                       WHERE Users.username LIKE '%$textoBusqueda%'
                                       OR Users.password LIKE '%$textoBusqueda%'
                                       OR Users.realname LIKE '%$textoBusqueda%'
                                       OR Users.type LIKE '%$textoBusqueda%'
                                       ORDER BY Users.username");
       return $result;
   }


    // Cierra una sesión (destruye variables de sesión)
    public function cerrarSesion() {
        Seguridad::cerrarSesion();
    }

}