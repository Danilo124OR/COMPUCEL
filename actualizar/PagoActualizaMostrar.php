<!DOCTYPE html>
<html>
<head>
    <title>Actualizar</title>
    <link rel="stylesheet" href="../estilos/estiloTablas.css">
</head>
<body>
<form action="" method="POST">
<div class="contenedorMostrarTodo" id = "contenedorMostrarTodo">
<h1>Lista de Pagos</h1>
       <tr><table id="TablaClientes">
        <th class="encabezado">Id de Pago</th> 
        <th class="encabezado">Numero de Orden</th> 
        <th class="encabezado">Cantidad Reparada</th>
        <th class="encabezado">Detalles de Reparación</th>
        <th class="encabezado">Fecha de pago</th>
        <th class="encabezado">Hora de Pago</th>
        <th class="encabezado">Precio</th>
        <th> <input type="button" value="Regresar" class="regresar"  onclick="location.href='PagoActualizarFormulario.php';"></th></tr>
    <?php
    include 'PagoActualizaTodo.php';
    ?>
        </table>
    </div>
</form>
    <?php include '../principal/menu.html';?>
  
</body>
</html>