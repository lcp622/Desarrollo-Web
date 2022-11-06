<?php
// Vista para la lista de recursos

// Recuperamos la lista de recursos
$listaRecursos = $data["listaRecursos"];

// Si hay algún mensaje de feedback, lo mostramos
if (isset($data["info"])) {
  echo "<div style='color:blue'>".$data["info"]."</div>";
}

if (isset($data["error"])) {
  echo "<div style='color:red'>".$data["error"]."</div>";
}

echo "<form action='index.php'>
        <input type='hidden' name='action' value='buscarRecursos'>
        <input type='hidden' name='controller' value='RecursosController'>
        <input type='text' name='textoBusqueda'>
        <input type='submit' value='Buscar'>
      </form><br>";

// Ahora, la tabla con los datos de los recursos.
if (count($listaRecursos) == 0) {
  echo "No hay datos";
} else {
  echo "<table border ='1'>";
  echo "<h2>Lista de recursos</h2>";
  foreach ($listaRecursos as $fila) {
    
    echo "<tr>";
    echo "<td>" . $fila->name . "</td>";
    echo "<td>" . $fila->description . "</td>";
    echo "<td>" . $fila->location . "</td>";
    echo "<td><img src=" . $fila->image . "></td>";
    echo "<td><a href='index.php?controller=RecursosController&action=formularioModificarRecursos&id=" . $fila->id . "'>Modificar</a></td>"; 
    echo "<td><a href='index.php?controller=RecursosController&action=borrarRecursos&id=". $fila->id."'>Borrar</a></td>";
    echo "<td><a href='index.php?controller=ReservasController&action=reservar&id=". $fila->id."'>Reservar</a></td>"; 
    echo "</tr>";
  }
  echo "</table>";
}
echo "<p><a href='index.php?controller=RecursosController&action=formularioInsertarRecursos'>Nuevo</a></p>";