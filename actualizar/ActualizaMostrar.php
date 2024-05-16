<!DOCTYPE html>
<html>
<head>
    <title>Actualizar</title>
    <link rel="stylesheet" href="../estilos/estiloTablas.css">
</head>
<body>
<form action="" method="POST">
<div class="contenedorAmplio" id = "contenedorMostrarTodo">
<h1>Lista de clientes</h1>
        <table id="TablaClientes">
        <tr><th class="encabezado">ID de cliente</th><th class="encabezado">Nombre</th><th class="encabezado">Teléfono</th><th> <input type="button" value="Regresar" class="regresar"  onclick="location.href='actualizarformulario.php';"></th></tr>
    <?php
    include 'ActualizaTodo.php';
    ?>
        </table>
    </div>
</form>
    <?php include '../principal/menu.html';?>
  
</body>
</html>