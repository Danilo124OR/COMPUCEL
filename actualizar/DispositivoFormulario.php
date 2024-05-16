<!DOCTYPE html>
<html>
<head>
    <title>Buscar Cliente</title>
    <link rel="stylesheet" href="../estilos/estiloTablas.css">
</head>
<body>
    <div class="contenedorOrdenes">
        <form method="POST">
            <table>
                <tr><td>
                    <h2>Buscar Ordenes y Actualizar</h2>
                </td></tr>
                <tr><td>
                    <label for="tipo_busqueda">Buscar por:</label>
                    <select id="tipo_busqueda" name="tipo_busqueda">
                        <option value="no_orden" class="campo">Numero de Orden</option>
                        <option value="Nombre_cliente" class="campo">Nombre del cliente</option>
                    </select><br>
                </td></tr>
                <tr>
                <td><input type="search" id="valor_busqueda" name="valor_busqueda" class="campo" required placeholder = "Numero de Orden o Nombre del Cliente" value = "<?php include 'DispositivoConsulta.php'; if(isset($orden)){echo $orden;}?>"></td>
                <td><input type="submit" name = "buscar" value="Buscar" class="campo" id="btnInsertar"></td>
                </tr>
                <tr><td><br>
                <h4>Información</h4>
                </td></tr>
                <tr><td><br>
                <input type="text"name = "no_orden" readonly placeholder = "no_orden" class = "campo" value = "<?php include 'DispositivoConsulta.php'; if(isset($orden)){echo $orden;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "Id_tecnico" placeholder = "ID_tecnico" class = "campo" value = "<?php if(isset($idtecnico)){echo $idtecnico;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "Nombre_técnico" placeholder = "Nombre_técnico" class = "campo" value = "<?php if(isset($nomtecnico)){echo $nomtecnico;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "id_cliente" placeholder = "id_cliente" class = "campo" value = "<?php if(isset($idcliente)){echo $idcliente;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "Nombre_cliente" placeholder = "Nombre_cliente" class = "campo" value = "<?php if(isset($nomcliente)){echo $nomcliente;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "Modelo" placeholder = "Modelo" class = "campo" value = "<?php if(isset($mol)){echo $mol;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "Tipo_dispositivo" placeholder = "Tipo_dispositivo" class = "campo" value = "<?php if(isset($tipodis)){echo $tipodis;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "Marca" placeholder = "Marca" class = "campo" value = "<?php if(isset($mar)){echo $mar;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "IMEI" placeholder = "IMEI" class = "campo" value = "<?php if(isset($imei)){echo $imei;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "Fecha_ingreso" placeholder = "Fecha_ingreso" class = "campo" value = "<?php if(isset($ingreso)){echo $ingreso;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "Fecha_entrega" placeholder = "Fecha_entrega" class = "campo" value = "<?php if(isset($entrega)){echo $entrega;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "detalles_reparaciones" placeholder = "detalles_reparaciones" class = "campo" value = "<?php if(isset($detalle)){echo $detalle;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "estado_dispositivo" placeholder = "estado_dispositivo" class = "campo" value = "<?php if(isset($estado)){echo $estado;}?>">
                </td>

                <td>
                <input type="submit" name = "actualizar" value = "Editar" class = "campo">
                </td></tr>
                <tr><td>
                    <input type="button" value="Mostrar todos" class="campo"  onclick="location.href='DispositivoMostrar.php';">
                </td></tr>
            </table>
            <?php include 'DispositivoConsulta2.php';?>
        </form>
    </div>
    <?php include '../principal/menu.html'; include 'DispositivoConsulta.php';?>
    
</body>
</html>