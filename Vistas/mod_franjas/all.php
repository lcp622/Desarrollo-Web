<?php
// Vista para la lista de franjas horarias.

// Recuperamos la lista de franjas
$listaFranjas = $data["listaFranjas"];

// Si hay algún mensaje de feedback, lo mostramos
if (isset($data["info"])) {
  echo "<div style='color:blue'>".$data["info"]."</div>";
}

if (isset($data["error"])) {
  echo "<div style='color:red'>".$data["error"]."</div>";
}

echo "<form action='index.php'>
        <input type='hidden' name='controller' value='FranjasController'>
        <input type='hidden' name='action' value='buscarFranjas'>
        <input type='text' name='textoBusqueda'>
        <input type='submit' value='Buscar'>
      </form><br>";

// Ahora, la tabla con los datos de las franjas horarias.
if (count($listaFranjas) == 0) {
  echo "No hay datos";
} else {
  echo "<table border ='1'>";
  echo "<h2>Listado de franjas horarias</h2>";
  foreach ($listaFranjas as $fila) {
    echo "<tr>";
    echo "<td>" . $fila->dayOfWeek . "</td>";
    echo "<td>" . $fila->startTime . "</td>";
    echo "<td>" . $fila->endTime . "</td>";
    echo "<td><a href='index.php?controller=FranjasController&action=formularioModificarFranjas&id=" . $fila->id . "'>Modificar</a></td>"; // CAMBIADO
    echo "<td><a href='index.php?controller=FranjasController&action=borrarFranjas&id=". $fila->id."'>Borrar</a></td>"; // CAMBIADO
    echo "</tr>";
  }
  echo "</table>";
}
echo "<p><a href='index.php?controller=FranjasController&action=formularioInsertarFranjas'>Nuevo</a></p>";
?>