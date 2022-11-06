<?php
// Vista para edición/inserción de recursos.

extract($data);   // Extrae el contenido de $data y lo convierte en variables individuales.

// Misma vista para insertar y modificar. Para saber si hacemos una cosa u otra,
// usaremos la variable $mod_recursos: si existe, es porque estamos modificando un recurso. Si no, estamos insertando uno nuevo.
if (isset($mod_recursos)) {   
    echo "<h1>Modificación de recursos</h1>";
} else {
    echo "<h1>Inserción de recursos</h1>";
}

// Sacamos los datos del recurso (si existe) a variables individuales para mostrarlo en los inputs del formulario.
$id = $mod_recursos[0]->id ?? ""; 
$name = $mod_recursos[0]->name ?? "";
$description = $mod_recursos[0]->description ?? "";
$location = $mod_recursos[0]->location ?? "";
$image = $mod_recursos[0]->image ?? "";


// Creamos el formulario con los campos de los recursos.
    echo "<form action = 'index.php' method = 'post' enctype='multipart/form-data'>
        <input type='hidden' name='id' value='".$id."'>
        Nombre:<input type='text' name='name' value='".$name."'><br>
        Descripción:<input type='text' name='description' value='".$description."'><br>
        Localización:<input type='text' name='location' value='".$location."'><br>
        Imagen:<input type='file' name='image' value='".$image."'><br>
        <input type = 'hidden' name = 'controller' value = 'RecursosController'>";

        

// Finalizamos el formulario. 
if (isset($mod_recursos)) {   
    echo "  <input type='hidden' name='action' value='modificarRecursos'>"; //nombre función
} else {
    echo "  <input type='hidden' name='action' value='insertarRecursos'>";
}

echo "	<input type='submit'></form>";
echo "<p><a href='index.php'>Volver</a></p>";