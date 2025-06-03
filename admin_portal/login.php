<?php
session_start();
$usuario_valido = "axel";
$contrasena_valida = "0117";

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f7941d, #fff07c);
            background-size: 300% 300%;
            animation: shift 10s ease infinite;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        @keyframes shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container-login {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 40px;
            width: 400px;
            border-radius: 16px;
            text-align: center;
            z-index: 1;
            animation: aparecer 1.2s ease-out forwards;
            transform: scale(0.9);
            opacity: 0;
        }

        @keyframes aparecer {
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .side-figure {
            position: absolute;
            height: 100vh;
            opacity: 1;
            z-index: 0;
            object-fit: contain;
            pointer-events: none;
        }

        .side-figure.left {
            left: 0;
            top: 0;
        }

        .side-figure.right {
            right: 0;
            top: 0;
        }

        .btn-primary {
            background-color: #ff6f61;
            border: none;
            font-weight: bold;
            transition: transform 0.2s ease, background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #d35400;
            transform: scale(1.05);
        }

        .spinner-border {
            display: none;
        }

        .btn-loading .spinner-border {
            display: inline-block !important;
        }

        .btn-loading .btn-text {
            visibility: hidden;
        }
    </style>
</head>
<body>
<img src="empleado_hombre.png" class="side-figure left" alt="Empleado Hombre">
<img src="empleada_mujer.gif" class="side-figure right" alt="Empleada Mujer">

<div class="container-login">
    <img src="tienda_neto.png" alt="Logo" width="150">
    <h3 class="mt-3">Acceso Administrador</h3>
    <?php if (isset($error)) echo "<div class='alert alert-danger mt-2'>$error</div>"; ?>
    <form method="POST" class="text-start mt-3" onsubmit="return animarBoton();">
        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <input type="text" name="usuario" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" name="contrasena" class="form-control" required>
        </div>
        <div class="d-grid">
            <button id="btnLogin" type="submit" class="btn btn-primary">
                <span class="btn-text">Iniciar Sesión</span>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            </button>
        </div>
    </form>
</div>

<script>
function animarBoton() {
    const btn = document.getElementById('btnLogin');
    btn.classList.add('btn-loading');
    return true;
}
</script>
</body>
</html>