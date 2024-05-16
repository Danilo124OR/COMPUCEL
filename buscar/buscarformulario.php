<!DOCTYPE html>
<html>
<head>
    <title>Buscar Cliente</title>
    <link rel="stylesheet" href="../estilos/estiloTablas.css">
</head>
<body>
<form action="" method="POST">
    <div class="contenedor">
        <table>
            <tr><td>
                <h2>Buscar Cliente</h2>
            </td></tr>
            <tr><td>
                <label for="tipo_busqueda">Buscar por:</label>
                <select id="tipo_busqueda" name="tipo_busqueda">
                    <option value="id_cliente">ID del cliente</option>
                    <option value="nombre">Nombre del cliente</option>
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
        <div class="contenedorMuestraClientes">
        <h1>Lista de clientes</h1>
        <table id="TablaClientes" align='center'>
        <tr><th class="encabezado">ID de Cliente</th><th class="encabezado">Nombre</th><th class="encabezado"s>Teléfono</th></tr>
    <?php
    include 'buscarconsulta.php';
    ?>
        </table>
        </div>
        </form>
<?php 
include '../principal/menu.html';
?>
    </body>
</html>
