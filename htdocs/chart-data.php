<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$basededatos = "portal_cautivo";

$conn = new mysqli($host, $usuario, $contrasena, $basededatos);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$query = "SELECT DATE(fecha_ingreso) AS fecha, COUNT(*) AS total FROM empleados GROUP BY DATE(fecha_ingreso) ORDER BY fecha ASC";
$result = $conn->query($query);

$fechas = [];
$accesos = [];
while ($row = $result->fetch_assoc()) {
    $fechas[] = $row['fecha'];
    $accesos[] = $row['total'];
}

echo json_encode([ "fechas" => $fechas, "accesos" => $accesos ]);
?>