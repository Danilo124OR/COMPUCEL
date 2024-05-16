<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMPUCEL</title>
    <link rel="stylesheet" href="estilos\design.css">
</head>
<body>
<img src="image\LOGO.png" class ="logo">
<div Id="ini"><H1 id="bienv">¡ Bienvenido !</H1></div>
<div class = "ConAcs">
    <form action="" method="post" id = "login-form">
    <?php
        include("principal/conexion_bd.php"); 
        include("principal/controlador.php");
        ?>
        <table class="datosIngresar">
            <tr><td><input type="text" name="usuario" id="ing" align = "center" required autofocus placeholder = "Usuario"/></td></tr>
            <tr><td><input type="password" id="ing" name="contrasena" required placeholder = "Contraseña"/></td></tr>
            <tr><td><input type="submit" id= "enviar" name="ingresar" value="Ingresar" /></td></tr>
        </table>
        <br/>
    </form>
</div>
<img src="image\USER.png" id="mUs">
</body>
</html>
