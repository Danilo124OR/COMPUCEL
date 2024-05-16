<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../estilos/estiloTablas.css">
</head>
<body>
    <div class="contenedor">
        <form action="TecnicosConsultaInsertar.php" method="POST">
            <Table align="center">
                <tr><td>
                    <div> <h2>Insertar Técnicos</h2></div>
                </td></tr>
                <tr><td>
                     <label for="id">ID de Técnico</label><br>
                     <!-- Incluir el próximo ID de cliente generado por PHP -->
                     <input type="text" id="id" class="campo" name="Id_tecnico" value="<?php include('TecnicosConsultaInsertar.php'); echo $next_id; ?>"><br>
                </td></tr>
                <tr><td>
                    <label for="nombre">Nombre del Técnico</label><br>
                    <input type="text" id="nombre" class="campo" name="Nombre_tecnico" value=""><br>
                </td></tr>
                <tr><td>
                    <label for="telefono">Teléfono</label><br>
                    <input type="text" id="telefono" class="campo" name="Telefono" value=""><br><br>
                </td></tr>
                <tr><td>
                    <input type="submit" name="" value="Insertar" class="campo" id="btnInsertar"><br>
                </td></tr>
            </Table>    
        </form>
    </div>
    <?php include '../principal/menu.html'; ?>
    <?php include '../insertar/TecnicosTabla.php'; ?>
</body>
</html>
