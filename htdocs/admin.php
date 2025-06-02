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
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador - Accesos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Historial de Accesos</h2>
    <a href="logout.php">Cerrar sesión</a>
    <canvas id="graficoAccesos"></canvas>
    <table border="1" cellpadding="10" cellspacing="0">
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
            <?php while ($fila = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $fila['id'] ?></td>
                    <td><?= htmlspecialchars($fila['numero_empleado']) ?></td>
                    <td><?= htmlspecialchars($fila['nombre_completo']) ?></td>
                    <td><?= htmlspecialchars($fila['eco_empleado']) ?></td>
                    <td><?= $fila['fecha_ingreso'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <script>
    fetch('chart-data.php')
        .then(res => res.json())
        .then(data => {
            const ctx = document.getElementById('graficoAccesos').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.fechas,
                    datasets: [{
                        label: 'Accesos por día',
                        data: data.accesos,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        });
    </script>
</body>
</html>