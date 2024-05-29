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
                    <h2>Buscar usuario</h2>
                </td></tr>
                <tr><td>
                    <label for="tipo_busqueda">Buscar por:</label>
                    <select id="tipo_busqueda" name="tipo_busqueda">
                        <option value="id_usuario" class="campo">ID del usuario</option>
                        <option value="nombre" class="campo">Nombre del usuario</option>
                    </select><br>
                </td></tr>
                <tr>
                <td><input type="search" id="valor_busqueda" name="valor_busqueda" class="campo" required placeholder = "ID o Nombre del usuario" value = "<?php include 'usuarioActualizar.php'; if(isset($Id)){echo $Id;}?>"></td>
                <td><input type="submit" name = "buscar" value="Buscar" class="campo" id="btnInsertar"></td>
                </tr>
                <tr><td><br>
                <h4>Información</h4>
                </td></tr>
                <tr><td><br>
                <input type="text"name = "id_usuario" readonly placeholder = "Id del usuario" class = "campo" value = "<?php include 'usuarioActualizar.php'; if(isset($Id)){echo $Id;}?>">
                </td></tr>
                <tr><td>
                <input type="text" name = "nombre" placeholder = "Nombre" class = "campo" value = "<?php if(isset($Nombre)){echo $Nombre;}?>">
                </td></tr>
                <tr><td>
                <input type="text" name = "clave" placeholder = "Clave" class = "campo" value = "<?php if(isset($clave)){echo $clave;}?>">
                </td>
                <td>
                <input type="submit" name = "actualizar" value = "Editar" class = "campo">
                </td></tr>
                <tr><td>
                    <input type="button" value="Mostrar todos" class="campo"  onclick="location.href='usuarioActualizaMostrar.php';">
                </td></tr>
            </table>
            <?php include 'usuarioActualizar2.php';?>
        </form>
    </div>
    <?php include '../principal/menu.html'; include 'usuarioActualizar.php';?>
    
</body>
</html>