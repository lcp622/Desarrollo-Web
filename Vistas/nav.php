<hr/>
<nav>
    Menú de navegación: 
    <a href='index.php'>Home</a>
    <a href='index.php?controller=RecursosController&action=mostrarListaRecursos'>Recursos</a>
    <a href='index.php?controller=FranjasController&action=mostrarListaFranjas'>Franjas horarias</a> 
    <a href='index.php?controller=UsuariosController&action=mostrarListaUsuarios'>Usuarios</a> 
    <a href='index.php?controller=ReservasController&action=reservar'>Reservas</a> 
    
    <?php
        if (Seguridad::haySesion()) {
            echo "<a href='index.php?controller=UsuariosController&action=cerrarSesion'>Cerrar sesión</a>";
        }
        
    ?>
</nav>
<hr/>