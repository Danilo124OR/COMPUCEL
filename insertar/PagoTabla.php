<!DOCTYPE html>
<html>
<head>
    <title>Lista De Pagos</title>
    <style>
        .tablapagos{
            width: 65%;
            max-height: 400px; /* Altura máxima del contenedor */
            overflow-y: auto; /* Permitir desplazamiento vertical cuando sea necesario */
            margin: 0 auto; /* Centrar el contenedor */
            background-color: white; /* para darele un color de fondo al div*/ 
            position:absolute;
            left: 35%;
            top: 18%
        }

        table {
            border-collapse: collapse; /* Combina los bordes de las celdas contiguas */
            width: 100%; /* La tabla ocupa el 100% del ancho disponible de su contenedor */
        }

        th, .fila {
            border: 1px solid #dddddd; /* Define un borde de 1px sólido con el color #dddddd */
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

$sql = "SELECT * FROM pagos";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>
            <th class:'encabezado'>ID de Pago</th>
            <th class:'encabezado'>Numero de Orden</th>  
            <th class:'encabezado'>Cliente</th>
            <th class:'encabezado'>Dispositivos</th>
            <th class:'encabezado'>Cantidad Reparada</th>
            <th class:'encabezado'>Detalle de Reparación</th>
            <th class:'encabezado'>Fecha de Pago</th>
            <th class:'encabezado'>Hora de Pago</th>
            <th class:'encabezado'>Precio</th>
            <th class:'encabezado'>Total</th>
        </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td class:'fila'>".$row["id_pago"]."</td>
            <td class:'fila'>".$row["no_orden"]."</td>
            <td class:'fila'>".$row["Nombre_cliente"]."</td>
            <td class:'fila'>".$row["Dispositivos"]."</td>
            <td class:'fila'>".$row["Cantidad"]."</td>
            <td class:'fila'>".$row["detalles"]."</td>
            <td class:'fila'>".$row["Fecha_pago"]."</td>
            <td class:'fila'>".$row["Hora_pago"]."</td>
            <td class:'fila'>".$row["precio"]."</td>
            <td class:'fila'>".$row["total"]."</td>
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
