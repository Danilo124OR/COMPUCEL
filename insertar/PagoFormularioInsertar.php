<?php
include("../principal/conexion_bd.php");

// Consulta para obtener el siguiente ID de pago
$sql = "SELECT MAX(id_pago) as max_id FROM pagos";
$result = $conexion->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    $next_id = $row['max_id'] + 1;
} else {
    $next_id = 1;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../estilos/estiloTablas.css">
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }

        .campo {
            width: 100%;
            padding: 8px;
        }

        .contenedordispositivos {
            width: 80%;
            margin: auto;
        }
    </style>
    <script>
        let pagos = [];

        function calcularTotalIndividual() {
            let cantidad = parseFloat(document.getElementById('cantidad').value) || 0;
            let precio = parseFloat(document.getElementById('precio').value) || 0;
            let total = cantidad * precio;
            document.getElementById('totalIndividual').value = total.toFixed(2);
        }

        function calcularTotalGeneral() {
            let totalGeneral = 0;

            pagos.forEach(pago => {
                totalGeneral += parseFloat(pago.total);
            });

            document.getElementById('total').value = totalGeneral.toFixed(2);
            calcularCambio();
        }

        function calcularCambio() {
            let total = parseFloat(document.getElementById('total').value) || 0;
            let pago = parseFloat(document.getElementById('pago').value) || 0;
            let cambio = pago - total;
            document.getElementById('cambio').value = cambio.toFixed(2);
        }

        function addPago(event) {
            event.preventDefault();

            let idPago = document.getElementById('idpago').value;
            let noOrden = document.getElementById('no_orden').value;
            let detalle = document.getElementById('detalle').value;
            let cantidad = document.getElementById('cantidad').value;
            let fecha = document.getElementById('fecha').value;
            let hora = document.getElementById('hora').value;
            let precio = document.getElementById('precio').value;
            let total = document.getElementById('totalIndividual').value;

            // Verificación de campos requeridos
            if (!noOrden || !detalle || !cantidad || !fecha || !hora || !precio) {
                alert("Por favor, complete todos los campos antes de agregar un pago.");
                return;
            }

            let pagoObj = {
                idPago,
                noOrden,
                detalle,
                cantidad,
                fecha,
                hora,
                precio,
                total
            };

            pagos.push(pagoObj);
            mostrarPagos();
            document.getElementById('formPago').reset();
            document.getElementById('idpago').value = parseInt(idPago) + 1; // Incrementa el ID de pago
            calcularTotalGeneral();
        }

        function mostrarPagos() {
            let table = document.getElementById('tablaPagos').getElementsByTagName('tbody')[0];
            table.innerHTML = '';

            pagos.forEach((pago, index) => {
                let newRow = table.insertRow();
                newRow.insertCell(0).innerText = pago.idPago;
                newRow.insertCell(1).innerText = pago.noOrden;
                newRow.insertCell(2).innerText = pago.detalle;
                newRow.insertCell(3).innerText = pago.cantidad;
                newRow.insertCell(4).innerText = pago.fecha;
                newRow.insertCell(5).innerText = pago.hora;
                newRow.insertCell(6).innerText = pago.precio;
                newRow.insertCell(7).innerText = pago.total;
            });
        }

        function enviarPagos() {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = 'PagoConsultaInsertar.php';

            pagos.forEach((pago, index) => {
                for (let key in pago) {
                    let input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = `${key}[]`;
                    input.value = pago[key];
                    form.appendChild(input);
                }
            });

            let totalInput = document.createElement('input');
            totalInput.type = 'hidden';
            totalInput.name = 'total';
            totalInput.value = document.getElementById('total').value;
            form.appendChild(totalInput);

            let pagoInput = document.createElement('input');
            pagoInput.type = 'hidden';
            pagoInput.name = 'pago';
            pagoInput.value = document.getElementById('pago').value;
            form.appendChild(pagoInput);

            let cambioInput = document.createElement('input');
            cambioInput.type = 'hidden';
            cambioInput.name = 'cambio';
            cambioInput.value = document.getElementById('cambio').value;
            form.appendChild(cambioInput);

            document.body.appendChild(form);
            form.submit();
        }
    </script>
</head>
<body>
    <div class="contenedorpagos">
        <form id="formPago" onsubmit="addPago(event)">
            <table align="center">
                <tr>
                    <td colspan="2">
                        <div><h2>Pago de Reparación</h2></div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="idpago">Id de Pago</label><br>
                        <input type="text" id="idpago" class="campo" name="id_pago" value="<?php echo $next_id; ?>" readonly><br><br>
                    </td>
                    <td>
                        <label for="no_orden">Número de orden</label><br>
                        <input type="text" id="no_orden" class="campo" name="no_orden" required><br><br>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="detalle">Detalles de Reparación</label><br>
                        <input type="text" id="detalle" class="campo" name="detalles_reparacion" required><br><br>
                    </td>
                    <td>
                        <label for="cantidad">Cantidad Reparada</label><br>
                        <input type="number" id="cantidad" class="campo" name="Cantidad_reparada" oninput="calcularTotalIndividual()" required><br><br>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="fecha">Fecha de Pago</label><br>
                        <input type="date" id="fecha" class="campo" name="Fecha_pago" required><br><br>
                    </td>
                    <td>
                        <label for="hora">Hora de Pago</label><br>
                        <input type="time" id="hora" class="campo" name="Hora_pago" required><br><br>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="precio">Precio</label><br>
                        <input type="number" step="0.01" id="precio" class="campo" name="precio" oninput="calcularTotalIndividual()" required><br><br>
                    </td>
                    <td>
                        <label for="totalIndividual">Total Individual</label><br>
                        <input type="text" id="totalIndividual" class="campo" readonly><br><br>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <button type="submit" class="campo" id="btnInsertar">Agregar Pago</button>
                    </td>
                </tr>
            </table>
        </form>

        <table id="tablaPagos" align="center">
            <thead>
                <tr>
                    <th>Id de Pago</th>
                    <th>Número de Orden</th>
                    <th>Detalles de Reparación</th>
                    <th>Cantidad</th>
                    <th>Fecha de Pago</th>
                    <th>Hora de Pago</th>
                    <th>Precio</th>
                    <th>Total Individual</th>
                </tr>
            </thead>
            <tbody>
                <!-- Pagos will be inserted here dynamically -->
            </tbody>
        </table>

        <form id="formTotales" onsubmit="event.preventDefault(); enviarPagos();">
            <table align="center">
                <tr>
                    <td>
                        <label for="total">Total</label><br>
                        <input type="text" id="total" class="campo" readonly><br><br>
                    </td>
                    <td>
                        <label for="pago">Pago</label><br>
                        <input type="number" id="pago" class="campo" oninput="calcularCambio()"><br><br>
                    </td>
                    <td>
                        <label for="cambio">Cambio</label><br>
                        <input type="text" id="cambio" class="campo" readonly><br><br>
                    </td>
                    <td>
                        <button type="submit" class="campo" id="btnCalcularCambio">Insertar Pago</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <?php include '../principal/menu.html'; ?>

</body>
</html>
