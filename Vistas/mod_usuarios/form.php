<?php
// Vista para inserción/modificación de usuarios

extract($data);   // Extrae el contenido de $data y lo convierte en variables individuales.

// Vamos a usar la misma vista para insertar y modificar. Para saber si hacemos una cosa u otra,
if (isset($mod_usuarios)) {   
    echo "<h1>Modificación de usuarios</h1>";
} else {
    echo "<h1>Inserción de usuarios</h1>";
}

// Sacamos los datos del usuario (si existe) a variables individuales para mostrarlo en los inputs del formulario.

$id = $mod_usuarios[0]->id ?? ""; 
$username = $mod_usuarios[0]->username ?? "";
$password = $mod_usuarios[0]->password ?? "";
$realname = $mod_usuarios[0]->realname ?? "";
$type = $mod_usuarios[0]->type ?? "";


// Creamos el formulario con los campos del libro
echo "<form action = 'index.php' method = 'get'>
        <input type='hidden' name='id' value='".$id."'>
        Usuario:<input type='text' name='username' value='".$username."'><br>
        Contraseña:<input type='text' name='password' value='".$password."'><br>
        Nombre real:<input type='text' name='realname' value='".$realname."'><br>
        Tipo:<input type='text' name='type' value='".$type."'><br>
        <input type = 'hidden' name = 'controller' value = 'UsuariosController'>";

        

// Finalizamos el formulario. ESTO LO VEO DESPUÉS
if (isset($mod_usuarios)) {  //aqui ponia libro. No sé de momento que hay que poner
    echo "  <input type='hidden' name='action' value='modificarUsuarios'>"; //nombre función
} else {
    echo "  <input type='hidden' name='action' value='insertarUsuarios'>";
}

echo "	<input type='submit'></form>";
echo "<p><a href='index.php'>Volver</a></p>";