<!DOCTYPE html>
<html>
<head>
    <title>Actualizar</title>
    <link rel="stylesheet" href="../estilos/estiloTablas.css">
</head>
<body>
<form action="" method="POST">
<div class="contenedorMostrarTodo" id = "contenedorMostrarTodo">
<h1>Lista de clientes</h1>
        <table id="TablaClientes">
    <tr>
        <th class="encabezado">Numero de Orden</th> 
        <th class="encabezado">Id de Técnico</th> 
        <th class="encabezado">Nombre de Técnico</th> 
        <th class="encabezado">ID de cliente</th>
        <th class="encabezado">Nombre de Cliente</th>
        <th class="encabezado">Modelo</th>
        <th class="encabezado">Tipo de Dispositivo</th>
        <th class="encabezado">Marca</th>
        <th class="encabezado">IMEI</th>
        <th class="encabezado">Fecha de Ingreso</th>
        <th class="encabezado">Fecha de Entrega</th>
        <th class="encabezado">Detalles de Reparaciones</th>
        <th class="encabezado">Estado del Dispositivo</th>
        <th> <input type="button" value="Regresar" class="regresar"  onclick="location.href='DispositivoFormulario.php';"></th>
    </tr>
    <?php
    include 'DispositivoActualizaTodo.php';
    ?>
        </table>
    </div>
</form>
    <?php include '../principal/menu.html';?>
  
</body>
</html>