<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../estilos/estiloTablas.css">
</head>
<body>
    <div class="contenedordispositivos">
        <form action="PagoConsultaInsertar.php" method="POST">
            <Table align="center">
                <tr><td>
                    <div> <h2>Insertar Pagos</h2></div>
                </td></tr>


                <tr><td>
                     <label for="idpago">Id de Pago</label><br>
                     <!-- Incluir el próximo ID de cliente generado por PHP  -->
                     <input type="text" id="idpago" class="campo" name="id_pago" value="<?php include('PagoConsultaInsertar.php'); echo $next_id; ?>"><br><br>
                </td></tr>

                <tr><td>
                     <label for="no_orden">Número de orden</label><br>
                     <!-- Incluir el próximo ID de cliente generado por PHP  -->
                     <input type="text" id="no_orden" class="campo" name="no_orden" value=""><br><br>
                </td></tr>

                

                <tr><td>
                    <label for="id_cliente">ID de cliente</label><br>
                    <input type="text" id="id_cliente" class="campo" name="Id_cliente" value=""><br><br>
                </td></tr>

                <tr><td>
                    <label for="nombre_cliente">Nombre del cliente</label><br>
                    <input type="text" id="nombre_cliente" class="campo" name="Nombre_cliente" value=""><br><br>
                </td></tr>

                <tr><td>
                    <label for="dis">Dispositivos</label><br>
                    <input type="text" id="dis" class="campo" name="Dispositivos" value=""><br><br>
                </td></tr>

                <tr><td>
                    <label for="detalle">Detalles de Reparación</label><br>
                    <input type="text" id="detalle" class="campo" name="detalles_reparacion" value=""><br><br>
                </td></tr>

                <tr><td>
                    <label for="cantidad">Cantidad Reparada</label><br>
                    <input type="text" id="cantidad" class="campo" name="Cantidad_reparada" value=""><br><br>
                </td></tr>


                <tr><td>
                    <label for="fecha">Fecha de Pago</label><br>
                    <input type="text" id="fecha" class="campo" name="Fecha_pago" value=""><br><br>
                </td></tr>

                <tr><td>
                    <label for="hora">Hora de Pago</label><br>
                    <input type="time" id="hora" class="campo" name="Hora_pago" value=""><br><br>
                </td></tr>

                <tr><td>
                    <label for="precio">Precio</label><br>
                    <input type="text" id="precio" class="campo" name="precio" value=""><br><br>
                </td></tr>

                <tr><td>
                    <label for="total">Total a Pagar</label><br>
                    <input type="text" id="total" class="campo" name="total" value=""><br><br>
                </td></tr><br>


                <tr><td>
                    <input type="submit" name="" value="Insertar" class="campo" id="btnInsertar"><br>
                </td></tr>

                

            </Table>    
        </form>
    </div>
    <?php include '../principal/menu.html'; ?>
    <?php include '../insertar/PagoTabla.php'; ?>
</body>
</html>