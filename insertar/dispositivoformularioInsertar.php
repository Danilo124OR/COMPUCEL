<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../estilos/estiloTablas.css">
</head>
<body>
    <div class="contenedordispositivos">
        <form action="dispositivoconsultainsertar.php" method="POST">
            <Table align="center">
                <tr><td>
                    <div> <h2>Insertar Dispositivo</h2></div>
                </td></tr>

                <tr><td>
                     <label for="no_orden">Número de orden</label><br>
                     <!-- Incluir el próximo ID de cliente generado por PHP  -->
                     <input type="text" id="no_orden" class="campo" name="no_orden" value="<?php include('dispositivoconsultainsertar.php'); echo $next_id; ?>"><br>
                </td></tr>

                <tr><td>
                    <label for="id_tecnico">ID de técnico</label><br>
                    <input type="text" id="id_tecnico" class="campo" name="id_tecnico" value=""><br>
                </td></tr>

                <tr><td>
                    <label for="nombre_tecnico">Nombre de Técnico</label><br>
                    <input type="text" id="nombre_tecnico" class="campo" name="nombre_tecnico" value=""><br><br>
                </td></tr>

                <tr><td>
                    <label for="id_cliente">ID de cliente</label><br>
                    <input type="text" id="id_cliente" class="campo" name="id_cliente" value=""><br><br>
                </td></tr>

                <tr><td>
                    <label for="nombre_cliente">Nombre del cliente</label><br>
                    <input type="text" id="nombre_cliente" class="campo" name="nombre_cliente" value=""><br><br>
                </td></tr>

                <tr><td>
                    <label for="modelo">Modelo del Dispositivo</label><br>
                    <input type="text" id="modelo" class="campo" name="modelo" value=""><br><br>
                </td></tr>

                <tr><td>
                    <label for="tipo_dispositivo">Tipo de Dispositivo</label><br>
                    <input type="text" id="tipo_dispositivo" class="campo" name="tipo_dispositivo" value=""><br><br>
                </td></tr>

                <tr><td>
                    <label for="marca">Marca del Dispositivo</label><br>
                    <input type="text" id="marca" class="campo" name="marca" value=""><br><br>
                </td></tr>

                <tr><td>
                    <label for="imei">IMEI</label><br>
                    <input type="text" id="imei" class="campo" name="imei" value=""><br><br>
                </td></tr>

                <tr><td>
                    <label for="fecha_ingreso">Fecha de Ingreso</label><br>
                    <input type="text" id="fecha_ingreso" class="campo" name="fecha_ingreso" value=""><br><br>
                </td></tr>

                <tr><td>
                    <label for="fecha_entrega">Fecha de entrega</label><br>
                    <input type="text" id="fecha_entrega" class="campo" name="fecha_entrega" value=""><br><br>
                </td></tr>

                <tr><td>
                    <label for="detalles_reparaciones">Detalle de Reparación</label><br>
                    <input type="text" id="detalles_reparaciones" class="campo" name="detalles_reparaciones" value=""><br><br>
                </td></tr>

                <tr><td>
                <label for="estado_dispositivo">Estado del Dispositivo</label><br>
                    <select id='estado_dispositivo' name='estado_dispositivo'>
                    <option value="Reparado">Reparado</option>
                    <option value="En Reparación">En Reparación</option>
                    <option value="No Reparado">No Reparado</option>
                    </select> <br>
                </td></tr><br>

                <tr><td>
                    <input type="submit" name="" value="Insertar" class="campo" id="btnInsertar"><br>
                </td></tr>

                

            </Table>    
        </form>
    </div>
    <?php include '../principal/menu.html'; ?>
    <?php include '../insertar/dispositivoTabla.php'; ?>

</body>
</html>