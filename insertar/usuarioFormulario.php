<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../estilos/estiloTablas.css">
</head>
<body>
    <div class="contenedor">
        <form action="usuarioInserta.php" method="POST">
            <Table align="center">
                <tr><td>
                    <div> <h2>Nuevo usuario</h2></div>
                </td></tr>
                <tr><td>
                     <label for="id">ID de usuario</label><br>
                     <!-- Incluir el próximo ID de cliente generado por PHP -->
                     <input type="text" id="id" required class="campo" name="id_usuario" value="" placeHolder = "ID disponible: <?php include('usuarioInserta.php'); echo $next_id; ?>">
                <input type="submit" name = "buscar" value = "buscar" class = "campo">
                </td>
                </tr>
                <tr><td>
                    <label for="nombre">Nombre</label><br>
                    <input type="text" id="id" class="campo" name="nombre"><br>
                </td></tr>
                <tr><td>
                    <label for="telefono">Contraseña</label><br>
                    <input type="text" id="Clave" class="campo" name="clave"><br><br>
                </td></tr>
                <tr><td>
                    <input type="submit" name="insertar" value="Insertar" class="campo" id="btnInsertar"><br>
                </td></tr>
            </Table>   
        </form>
    </div>
    <?php include '../principal/menu.html';?>
</body>
</html>