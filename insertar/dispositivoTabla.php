<!DOCTYPE html>
<html>
<head>
    <title>Lista De Pagos</title>
    <style>
        .tablapagos{
            width: 67%;
            max-height: 400px; /* Altura máxima del contenedor */
            overflow-y: auto; /* Permitir desplazamiento vertical cuando sea necesario */
            margin: 0 auto; /* Centrar el contenedor */
            background-color: white; /* para darele un color de fondo al div*/ 
            position:absolute;
            left: 33%;
            top: 18%
        }

        table {
            border-collapse: collapse; /* Combina los bordes de las celdas contiguas */
            width: 100%; /* La tabla ocupa el 100% del ancho disponible de su contenedor */
        }

        th, .fila {
            border-top: 2px solid #dddddd; /* Aumentar el grosor del borde */
            border-bottom: 2px solid #dddddd; /* Aumentar el grosor del borde */
            text-align: left; /* Alinea el contenido de las celdas a la izquierda */
            padding: 8px; /* Espacio interno de 8px dentro de cada celda */
        }


        .encabezado {
            background-color: #f2f2f2; /* Fondo para las celdas de encabezado */
        }
    </style>
</head>
<body>

<div class="tablapagos">
<?php
include("../principal/conexion_bd.php"); 

$sql = "SELECT * FROM dispositivos1";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>
            <th class:'encabezado'>Numero de Orden</th> 
            <th class:'encabezado'>ID de Técnico</th>
            <th class:'encabezado'>Técnico</th> 
            <th class:'encabezado'>Id de Cliente</th>
            <th class:'encabezado'>Cliente</th>
            <th class:'encabezado'>Modelo</th>
            <th class:'encabezado'>Tipo de Dispositivo</th>
            <th class:'encabezado'>Marca</th>
            <th class:'encabezado'>Imei</th>
            <th class:'encabezado'>Fecha de Ingreso</th>
            <th class:'encabezado'>Fecha de Entrega</th>
            <th class:'encabezado'>Detalles de Reparación</th>
            <th class:'encabezado'>Estado del Dispositivo</th>
        </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td class:'fila'>".$row["no_orden"]."</td>
            <td class:'fila'>".$row["ID_tecnico"]."</td>
            <td class:'fila'>".$row["Nombre_técnico"]."</td>
            <td class:'fila'>".$row["id_cliente"]."</td>
            <td class:'fila'>".$row["Nombre_cliente"]."</td>
            <td class:'fila'>".$row["Modelo"]."</td>
            <td class:'fila'>".$row["Tipo_dispositivo"]."</td>
            <td class:'fila'>".$row["Marca"]."</td>
            <td class:'fila'>".$row["IMEI"]."</td>
            <td class:'fila'>".$row["Fecha_ingreso"]."</td>
            <td class:'fila'>".$row["Fecha_entrega"]."</td>
            <td class:'fila'>".$row["detalles_reparaciones"]."</td>
            <td class:'fila'>".$row["estado_dispositivo"]."</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 resultados";
}
$conexion->close();
?>
</div>
</body>
</html>
