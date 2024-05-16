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
                    <h2>Buscar Técnicos</h2>
                </td></tr>
                <tr><td>
                    <label for="tipo_busqueda">Buscar por:</label>
                    <select id="tipo_busqueda" name="tipo_busqueda">
                        <option value="id_tecnico" class="campo">ID de Técnico</option>
                        <option value="nombre" class="campo">Nombre del Técnico</option>
                    </select><br>
                </td></tr>
                <tr>
                <td><input type="search" id="valor_busqueda" name="valor_busqueda" class="campo" required placeholder = "ID o Nombre del Técnico" value = "<?php include 'TecnicosActualizarConsulta.php'; if(isset($Id)){echo $Id;}?>"></td>
                <td><input type="submit" name = "buscar" value="Buscar" class="campo" id="btnInsertar"></td>
                </tr>
                <tr><td><br>
                <h4>Información</h4>
                </td></tr>

                <tr><td><br>
                <input type="text"name = "Id_tecnico" readonly placeholder = "Id de Técnico" class = "campo" value = "<?php include 'TecnicosActualizarConsulta.php'; if(isset($Id)){echo $Id;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "Nombre_tecnico" placeholder = "Nombre de Técnico" class = "campo" value = "<?php if(isset($Nombre)){echo $Nombre;}?>">
                </td></tr>

                <tr><td>
                <input type="text" name = "Teléfono" placeholder = "Teléfono" class = "campo" value = "<?php if(isset($Tel)){echo $Tel;}?>">
                </td>
                
                <td>
                <input type="submit" name = "actualizar" value = "Editar" class = "campo">
                </td></tr>
                <tr><td>
                    <input type="button" value="Mostrar todos" class="campo"  onclick="location.href='TecnicosActualizaMostrar.php';">
                </td></tr>
            </table>
            <?php include 'TecnicosActualizarConsulta2.php';?>
        </form>
    </div>
    <?php include '../principal/menu.html'; include 'TecnicosActualizarConsulta.php';?>
    
</body>
</html>