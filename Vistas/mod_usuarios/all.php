<?php
// Vista para la lista de usuarios

// Recuperamos la lista de usuarios
$listaUsuarios = $data["listaUsuarios"];

// Si hay algún mensaje de feedback, lo mostramos
if (isset($data["info"])) {
  echo "<div style='color:blue'>".$data["info"]."</div>";
}

if (isset($data["error"])) {
  echo "<div style='color:red'>".$data["error"]."</div>";
}

echo "<form action='index.php'>
        <input type='hidden' name='action' value='buscarUsuarios'>
        <input type='hidden' name='controller' value='UsuariosController'>
        <input type='text' name='textoBusqueda'>
        <input type='submit' value='Buscar'>
      </form><br>";

// Ahora, la tabla con los datos de los usuarios
if (count($listaUsuarios) == 0) {
  echo "No hay datos";
} else {
  echo "<table border ='1'>";
  echo "<h2>Lista de usuarios</h2>";
  foreach ($listaUsuarios as $fila) {
    
    echo "<tr>";
    echo "<td>" . $fila->username . "</td>";
    echo "<td>" . $fila->password . "</td>";
    echo "<td>" . $fila->realname . "</td>";
    echo "<td>" . $fila->type . "</td>";
    echo "<td><a href='index.php?controller=UsuariosController&action=formularioModificarUsuarios&id=" . $fila->id . "'>Modificar</a></td>"; 
    echo "<td><a href='index.php?controller=UsuariosController&action=borrarUsuarios&id=". $fila->id."'>Borrar</a></td>"; 
    echo "</tr>";
  }
  echo "</table>";
}
echo "<p><a href='index.php?controller=UsuariosController&action=formularioInsertarUsuarios'>Nuevo</a></p>";