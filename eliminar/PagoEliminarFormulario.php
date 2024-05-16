<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../estilos/estiloTablas.css">
    <title>Buscar Pagos</title>
</head>
<body>
    <div class="contenedor">
        <form action="PagoEliminarConsulta.php" method="POST">
        <table>
            <tr><td>
                <h2>Buscar y Eliminar Pago</h2>
            </td></tr>
            <tr><td>
                <label for="tipo_busqueda">Buscar por:</label>
                <select id="tipo_busqueda" name="tipo_busqueda">
                    <option value="id_pago">Numero de Orden</option>
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
    </form>
    <?php include '../principal/menu.html'; ?>
</body>
</html>
