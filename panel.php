<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$basededatos = "portal_cautivo";

$conn = new mysqli($host, $usuario, $contrasena, $basededatos);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$numero_empleado = $_POST['numero_empleado'] ?? '';
$nombre_completo = $_POST['nombre_completo'] ?? '';
$eco_empleado = $_POST['eco_empleado'] ?? '';

if (empty($numero_empleado) || empty($nombre_completo) || $eco_empleado !== "0117") {
    echo "<h3>Error: Datos inválidos o incompletos.</h3>";
    echo "<a href='index.html'>Volver</a>";
    exit;
}

$stmt = $conn->prepare("INSERT INTO empleados (numero_empleado, nombre_completo, eco_empleado) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $numero_empleado, $nombre_completo, $eco_empleado);

if ($stmt->execute()) {
    echo "<h3>Registro exitoso. Bienvenido, $nombre_completo.</h3>";
} else {
    echo "Error al guardar: " . $conn->error;
}

$stmt->close();
$conn->close();
?>