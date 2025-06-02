
<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$host = "localhost";
$usuario = "root";
$contrasena = "";
$basededatos = "portal_cautivo";

$conn = new mysqli($host, $usuario, $contrasena, $basededatos);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$resultado = $conn->query("SELECT * FROM empleados ORDER BY fecha_ingreso DESC");

// Gráfico de accesos por día
$datos_por_dia = [];
$consulta_dias = $conn->query("SELECT DATE(fecha_ingreso) as fecha, COUNT(*) as total FROM empleados GROUP BY DATE(fecha_ingreso)");
while ($fila = $consulta_dias->fetch_assoc()) {
    $datos_por_dia[] = $fila;
}

// Gráfico de accesos por número de empleado
$datos_por_empleado = [];
$consulta_empleados = $conn->query("SELECT numero_empleado, COUNT(*) as total FROM empleados GROUP BY numero_empleado");
while ($fila = $consulta_empleados->fetch_assoc()) {
    $datos_por_empleado[] = $fila;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador - Accesos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f3;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #0066cc;
            color: white;
        }
        canvas {
            width: 100% !important;
            max-width: 1000px;
            height: 500px !important;
            width: 100% !important;
            max-width: 1000px;
            height: 500px !important;
            margin: 40px auto;
            display: block;
            max-width: 800px;
        }
        .logout {
            float: right;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h2>Panel de Administrador - Historial de Accesos</h2>
    <a class="logout" href="logout.php">Cerrar sesión</a>

    <canvas id="graficoPorDia"></canvas>
    <canvas id="graficoPorEmpleado"></canvas>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Número de Empleado</th>
                <th>Nombre Completo</th>
                <th>Económico</th>
                <th>Fecha de Ingreso</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['numero_empleado'] ?></td>
                <td><?= $row['nombre_completo'] ?></td>
                <td><?= $row['eco_empleado'] ?></td>
                <td><?= $row['fecha_ingreso'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script>
        const datosPorDia = <?php echo json_encode($datos_por_dia); ?>;
        const datosPorEmpleado = <?php echo json_encode($datos_por_empleado); ?>;

        const ctx1 = document.getElementById('graficoPorDia').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: datosPorDia.map(item => item.fecha),
                datasets: [{
                    label: 'Accesos por Día',
                    data: datosPorDia.map(item => item.total),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2
                }]
            }
        ,
        options: {
            animation: {
                duration: 1500,
                easing: 'easeOutBounce'
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

        const ctx2 = document.getElementById('graficoPorEmpleado').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: datosPorEmpleado.map(item => item.numero_empleado),
                datasets: [{
                    label: 'Accesos por Número de Empleado',
                    data: datosPorEmpleado.map(item => item.total),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2
                }]
            }
        ,
        options: {
            animation: {
                duration: 1500,
                easing: 'easeOutBounce'
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
</body>
</html>
