<?php
session_start();
// Inicializa el contador de intentos fallidos
if (!isset($_SESSION['intentos_fallidos'])) {
    $_SESSION['intentos_fallidos'] = 0;
}

//Se obtiene de la base de datos el usuario
$sql=$conexion->query("SELECT usuarios.Nombre,usuarios.Clave from usuarios");
while($row = $sql->fetch_assoc()) {
    $Nombre = $row['Nombre'];
    $Clave = $row['Clave'];
}

// Verifica las credenciales del usuario
if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {
    $usuario_correcto = $Nombre;
    $contrasena_correcta = $Clave;

    if ($_POST['usuario'] == $usuario_correcto && $_POST['contrasena'] == $contrasena_correcta) {
        // Credenciales correctas, reinicia el contador
        $_SESSION['intentos_fallidos'] = 0;
        // Redirige al usuario a la página segura
        header('location: principal/menu.html');
        $Nombre = ' ';
        $Clave = ' ';
    } else {
        // Credenciales incorrectas, incrementa el contador
        $_SESSION['intentos_fallidos']++;
        if ($_SESSION['intentos_fallidos'] >= 3) {
            //detemos la pagina y cuando finalice el tiempo de envia un mensaje
            echo "<script>alert('Intentalo de nuevo');</script>";
            sleep(30);
            $_SESSION['intentos_fallidos'] = 0; // Opcional: reinicia el contador después del bloqueo
        } else {
            // Muestra los intentos restantes
            $intentos_restantes = 3 - $_SESSION['intentos_fallidos'];
            echo "<script>alert('Te quedan $intentos_restantes intentos, una vez utilizados se bloqueara la pagina durante un minuto.');</script>";    
        }
    }
}
?>
