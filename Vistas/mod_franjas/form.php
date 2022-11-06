<?php
// Vista para edición/inserción de franjas horarias.

extract($data);   // Extrae el contenido de $data y lo convierte en variables individuales 
// Vamos a usar la misma vista para insertar y modificar. Para saber si hacemos una cosa u otra,
// usaremos la variable $mod_franjas: si existe, es porque estamos modificando un libro. Si no, estamos insertando uno nuevo.
if (isset($mod_franjas)) {   
    echo "<h1>Modificación de franjas horarias</h1>";
} else {
    echo "<h1>Inserción de franjas horarias</h1>";
}

// Sacamos los datos de la franja horaria (si existe) a variables individuales para mostrarlo en los inputs del formulario.
$id = $mod_franjas[0]->id?? ""; 
$dayOfWeek = $mod_franjas[0]->dayOfWeek ?? "";
$startTime = $mos_franjas[0]->startTime ?? "";
$endTime = $mod_franjas[0]->endTime ?? "";


// Creamos el formulario con los campos de la franja horaria
echo "<form action = 'index.php' method = 'get'>
        <input type='hidden' name='id' value='".$id."'>
        Día de la semana:<input type='text' name='dayOfWeek' value='".$dayOfWeek."'><br>
        Hora de inicio:<input type='text' name='startTime' value='".$startTime."'><br>
        Hora de fin:<input type='text' name='endTime' value='".$endTime."'><br>
        <input type = 'hidden' name = 'controller' value = 'FranjasController'>";

        

// Finalizamos el formulario. 
if (isset($mod_franjas)) {  
    echo "  <input type='hidden' name='action' value='modificarFranjas'>"; //nombre función
} else {
    echo "  <input type='hidden' name='action' value='insertarFranjas'>";
}

echo "	<input type='submit'></form>";
echo "<p><a href='index.php'>Volver</a></p>";