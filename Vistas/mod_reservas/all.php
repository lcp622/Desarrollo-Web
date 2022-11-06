<?php
// Vista para la lista de reservas.
// Recuperamos la lista de las reservas.

extract($data);

$id = $mod_recursos[0]->id ?? ($_REQUEST["id"]);



// Si hay algún mensaje de feedback, lo mostramos
if (isset($data["info"])) {
  echo "<div style='color:blue'>".$data["info"]."</div>";
}

if (isset($data["error"])) {
  echo "<div style='color:red'>".$data["error"]."</div>";
}

 echo "Estás reservando '$id'";
echo "<form action='index.php'>
        <input type='hidden' name='action' value='buscarReservas'>
        <input type='hidden' name='controller' value='ReservasController'>
        <input type='text' name='textoBusqueda'>
        <input type='submit' value='Buscar'>
      </form><br>";
      echo "<p><a href='index.php?controller=RecursosController&action=mostrarListaRecursos'>Volver a recursos</a></p>";

    
  echo "<h2>Listado de reservas </h2>";

  echo "Horario: <select name='tramoHorario'>";
    foreach ($listadoTramosHorarios as $tramo ) 
   echo "<option value='$tramo->id'> $tramo->dayOfWeek - $tramo->startTime - $tramo->endTime</option>";
   echo "</select>";
   echo "</br>";
   echo "</br>";


    echo "Usuario: <select name='listadoDeUsuarios'>";
    foreach ($listadoUsuarios as $list) 
   echo "<option value='$list->id'>$list->username </option>";





 ?>



