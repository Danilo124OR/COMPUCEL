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
                <h2>Buscar orden de Pago </h2>
            </td></tr>
            <tr><td>
                <label for="tipo_busqueda">Buscar por:</label>
                <select id="tipo_busqueda" name="tipo_busqueda">
                    <option value="id_pago">ID del cliente</option>
                    <option value="no_orden">Numero de orden</option>
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
        <h1>Lista de pagos</h1>
        <table id="TablaClientes" align='center'>
        </tr><th class="encabezado">ID de Pago</th>
        <th class="encabezado">Numero de orden</th>
        <th class="encabezado"s>Cantidad Reparada</th>
        <th class="encabezado"s>Detalles de Reparación</th>
        <th class="encabezado"s>Fecha del Pago</th>
        <th class="encabezado"s>Hora del Pago</th>
        <th class="encabezado"s>Precio</th>
    </tr>
    <?php
    include 'PagoBuscarConsulta.php';
    ?>
        </table>
        </div>
        </form>
<?php 
include '../principal/menu.html';
?>
    </body>
</html>
