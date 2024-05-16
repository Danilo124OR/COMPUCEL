<?php
session_start();
//Codigo para cerrar la sesion en caso de haber pasado 3 minutos
$tiempo_inactivo_maximo = 1 * 60;//tiempo permitido

// Verifica si el elemento "ultimo_acceso" está establecido en $_SESSION.
if (isset($_SESSION['ultimo_acceso']) && (time() - $_SESSION['ultimo_acceso']) > $tiempo_inactivo_maximo) {
    // Si ha pasado más tiempo del permitido, cerrar la sesión.
    session_unset();     // Eliminar variables de sesión.
    session_destroy();   // Destruir la sesión.
    header('Location: ../Index.php'); // Redirigir al login.
    exit();
}
echo time();
//Actualiza el tiempo de ultimo Acceso
$_SESSION['ultimo_acceso'] = time();
echo time();
?>