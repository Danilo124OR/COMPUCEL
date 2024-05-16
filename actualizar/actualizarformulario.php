<!DOCTYPE html>
<html>
<head>
    <title>Buscar Cliente</title>
    <link rel="stylesheet" href="../estilos/estiloTablas.css">
</head>
<body>
    <div class="contenedor">
        <form method="POST">
            <table>
                <tr><td>
                    <h2>Buscar clientes</h2>
                </td></tr>
                <tr><td>
                    <label for="tipo_busqueda">Buscar por:</label>
                    <select id="tipo_busqueda" name="tipo_busqueda">
                        <option value="id_cliente" class="campo">ID del cliente</option>
                        <option value="nombre" class="campo">Nombre del cliente</option>
                    </select><br>
                </td></tr>
                <tr>
                <td><input type="search" id="valor_busqueda" name="valor_busqueda" class="campo" required placeholder = "ID o Nombre del cliente" value = "<?php include 'actualizarconsulta.php'; if(isset($Id)){echo $Id;}?>"></td>
                <td><input type="submit" name = "buscar" value="Buscar" class="campo" id="btnInsertar"></td>
                </tr>
                <tr><td><br>
                <h4>Información</h4>
                </td></tr>

                <tr><td><br>
                <input type="text"name = "id_cliente" readonly placeholder = "Id del cliente" class = "campo" value = "<?php include 'actualizarconsulta.php'; if(isset($Id)){echo $Id;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "nombre" placeholder = "Nombre" class = "campo" value = "<?php if(isset($Nombre)){echo $Nombre;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "telefono" placeholder = "Teléfono" class = "campo" value = "<?php if(isset($Tel)){echo $Tel;}?>">
                </td>
                
                <td>
                <input type="submit" name = "actualizar" value = "Editar" class = "campo">
                </td></tr>
                <tr><td>
                    <input type="button" value="Mostrar todos" class="campo"  onclick="location.href='ActualizaMostrar.php';">
                </td></tr>
            </table>
            <?php include 'actualizarconsulta2.php';?>
        </form>
    </div>
    <?php include '../principal/menu.html'; include 'actualizarconsulta.php';?>
    
</body>
</html>