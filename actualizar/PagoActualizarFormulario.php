<!DOCTYPE html>
<html>
<head>
    <title>Buscar Pagos</title>
    <link rel="stylesheet" href="../estilos/estiloTablas.css">
</head>
<body>
    <div class="contenedorOrdenes">
        <form method="POST">
            <table>
                <tr><td>
                    <h2>Buscar Pagos y Actualizar</h2>
                </td></tr>
                <tr><td>
                    <label for="tipo_busqueda">Buscar por:</label>
                    <select id="tipo_busqueda" name="tipo_busqueda">
                        <option value="id_pago" class="campo">ID de Pago</option>
                        <option value="no_orden" class="campo">Numero de Orden</option>
                    </select><br>
                </td></tr>
                <tr>
                <td><input type="search" id="valor_busqueda" name="valor_busqueda" class="campo" required placeholder = "Numero de Orden o Nombre del Cliente" value = "<?php include 'PagoActualizarConsulta.php'; if(isset($idpago)){echo $idpago;}?>"></td>
                <td><input type="submit" name = "buscar" value="Buscar" class="campo" id="btnInsertar"></td>
                </tr>
                <tr><td><br>
                <h4>Información</h4>
                </td></tr>

                <tr><td><br>
                <input type="text" name = "id_pago" placeholder = "ID del Pago" class = "campo" value = "<?php include 'PagoActualizarConsulta.php'; if(isset($idpago)){echo $idpago;}?>">
                </td></tr>

                <tr><td>
                <input type="text"name = "no_orden" readonly placeholder = "Numero de Orden" class = "campo" value = "<?php  if(isset($orden)){echo $orden;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "Cantidad" placeholder = "Cantidad Reparada" class = "campo" value = "<?php if(isset($cantidad)){echo $cantidad;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "detalles" placeholder = "Detalles de Reparación" class = "campo" value = "<?php if(isset($detalle)){echo $detalle;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "Fecha_pago" placeholder = "Fecha de Pago" class = "campo" value = "<?php if(isset($fecha)){echo $fecha;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "Hora_pago" placeholder = "Hora de Pago" class = "campo" value = "<?php if(isset($hora)){echo $hora;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "precio" placeholder = "Precio" class = "campo" value = "<?php if(isset($precio)){echo $precio;}?>">
                </td></tr>            
                <td>
                <input type="submit" name = "actualizar" value = "Editar" class = "campo">
                </td></tr>
                <tr><td>
                    <input type="button" value="Mostrar todos" class="campo"  onclick="location.href='PagoActualizaMostrar.php';">
                </td></tr>
            </table>
            <?php include 'PagoActualizarConsulta.php';?>
        </form>
    </div>
    <?php include '../principal/menu.html'; include 'PagoActualizarConsulta2.php';?>
    
</body>
</html>