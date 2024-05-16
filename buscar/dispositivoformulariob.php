<!DOCTYPE html>
<html>
<head>
    <title>Buscar Ordenes</title>
    <link rel="stylesheet" href="../estilos/estiloTablas.css">

</head>
<body>
<form action="" method="POST">
    <div class="contenedor">
        <table>
            <tr><td>
                <h2>Buscar orden del cliente </h2>
            </td></tr>
            <tr><td>
                <label for="tipo_busqueda">Buscar por:</label>
                <select id="tipo_busqueda" name="tipo_busqueda">
                    <option value="no_orden">ID del cliente</option>
                    <option value="Nombre_cliente">Nombre del cliente</option>
                </select><br><br>
            </td></tr>
            <tr><td>
                <label for="valor_busqueda">Valor:</label>
                <input type="text" id="valor_busqueda" name="valor_busqueda" class="campo"><br><br>
            </td></tr>
            <tr><td>
                <input type="submit" value="Buscar" class="campo" id="btnInsertar"><br>
            </td></tr>
        </table>    
    </div>
        <div class="contenedorMuestraOrdenes">
        <h1>Lista de Ordenes</h1>
        <table id="TablaClientes" align='center'>
        <tr><th class="encabezado">Numero de orden</th><th class="encabezado">ID de tecnico</th><th class="encabezado"s>Nomdre de técnico</th>
        <th class="encabezado"s>Id de cliente</th>
        <th class="encabezado"s>Nombre de Cliente</th>
        <th class="encabezado"s>Modelo</th>
        <th class="encabezado"s>Tipo de Dispositivo</th>
        <th class="encabezado"s>Marca</th>
        <th class="encabezado"s>IMEI</th>
        <th class="encabezado"s>Fecha de Ingreso</th>
        <th class="encabezado"s>Fecha de Entrega</th>
        <th class="encabezado"s>Detalle de Reparación</th>
        <th class="encabezado"s>Estado del Dispositivo</th>   
    </tr>
    <?php
    include 'dispositivobuscar.php';
    ?>
        </table>
        </div>
        </form>
<?php 
include '../principal/menu.html';
?>
    </body>
</html>
