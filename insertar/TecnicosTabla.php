<!DOCTYPE html>
<html>
<head>
    <title>Lista De Técnicos</title>
    <style>
        .tablatecnicos{
            width: 40%;
            max-height: 400px; /* Altura máxima del contenedor */
            overflow-y: auto; /* Permitir desplazamiento vertical cuando sea necesario */
            margin: 0 auto; /* Centrar el contenedor */
            background-color: white; /* para darele un color de fondo al div*/ 
            position:absolute;
            left: 45%;
            top: 18%
        }

        table {
            border-collapse: collapse; /* Combina los bordes de las celdas contiguas */
            width: 100%; /* La tabla ocupa el 100% del ancho disponible de su contenedor */
        }

        th, td {
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

<div class="tablatecnicos">
<?php
include("../principal/conexion_bd.php"); 
$sql = "SELECT * FROM técnicos";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>
            <th class:'encabezado'>ID de Técnico</th>
            <th class:'encabezado'>Nombre del Técnico</th>  
            <th class:'encabezado'>Teléfono</th>
        </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>".$row["Id_tecnico"]."</td>
            <td>".$row["Nombre_tecnico"]."</td>
            <td>".$row["Teléfono"]."</td>
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
