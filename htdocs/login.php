<?php
session_start();
$usuario_valido = "admin";
$contrasena_valida = "1234";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    if ($usuario === $usuario_valido && $contrasena === $contrasena_valida) {
        $_SESSION['admin'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }
    .container {
        width: 90%;
        max-width: 600px;
        margin: auto;
        padding: 1em;
    }
    input[type="text"], input[type="password"], button {
        width: 100%;
        padding: 0.8em;
        margin: 0.5em 0;
        box-sizing: border-box;
        font-size: 1em;
    }
    @media (max-width: 600px) {
        h1, h2, h3 {
            font-size: 1.5em;
        }
    }
</style>

    <meta charset="UTF-8">
    <title>Login Administrador</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>Usuario:</label><br>
        <input type="text" name="usuario" required><br><br>
        <label>Contraseña:</label><br>
        <input type="password" name="contrasena" required><br><br>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>