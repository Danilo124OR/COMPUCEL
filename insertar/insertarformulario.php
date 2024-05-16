<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../estilos/estiloTablas.css">
</head>
<body>
    <div class="contenedor">
        <form action="insertarconsulta.php" method="POST">
            <Table align="center">
                <tr><td>
                    <div> <h2>Insertar clientes</h2></div>
                </td></tr>
                <tr><td>
                     <label for="id">ID de Cliente</label><br>
                     <!-- Incluir el próximo ID de cliente generado por PHP -->
                     <input type="text" id="id" class="campo" name="id_cliente" value="<?php include('insertarconsulta.php'); echo $next_id; ?>"><br>
                </td></tr>
                <tr><td>
                    <label for="nombre">Nombre</label><br>
                    <input type="text" id="nombre" class="campo" name="nombre" value=""><br>
                </td></tr>
                <tr><td>
                    <label for="telefono">Telefono</label><br>
                    <input type="text" id="telefono" class="campo" name="telefono" value=""><br><br>
                </td></tr>
                <tr><td>
                    <input type="submit" name="" value="Insertar" class="campo" id="btnInsertar"><br>
                </td></tr>
            </Table>    
        </form>
    </div>
    <?php include '../principal/menu.html'; ?>
    <?php include '../insertar/insertarclientesMostrar.php'; ?>
</body>
</html>
