<?php
session_start();
$error = isset($_GET["error"]) ? $_GET["error"] : "";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ping Pong - Retro Game</title>
    <link rel="stylesheet" href="/pingpong_game/public/css/login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="login-container">
        <!-- Título del juego -->
        <h1 class="login-title">PING PONG RETRO</h1>

        <!-- Formulario de inicio de sesión -->
        <form action="/pingpong_game/app/controllers/LoginController.php" method="POST">
            <div class="input-group">
                <input type="text" name="nombre_usuario" class="login-input" placeholder="Usuario" required>
            </div>
            <div class="input-group">
                <input type="password" name="contrasena" class="login-input" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn-login">Iniciar Sesión</button>
        </form>

        <div class="footer-links">
            <a href="register.php">¿No tienes cuenta? Registrarse</a>
        </div>
    </div>

    <script>
        let errorMsg = "<?= htmlspecialchars($error) ?>";
        if (errorMsg) {
            Swal.fire({
                icon: 'error',
                title: 'Error de inicio de sesión',
                text: errorMsg,
                confirmButtonColor: '#d33'
            });
        }

        document.querySelector("form").addEventListener("submit", function(event) {
            let usuario = document.querySelector("[name='nombre_usuario']").value.trim();
            let contrasena = document.querySelector("[name='contrasena']").value.trim();

            if (!usuario || !contrasena) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Campos vacíos',
                    text: 'Por favor, completa todos los campos.',
                    confirmButtonColor: '#d33'
                });
                event.preventDefault();
            }
        });
    </script>
</body>
</html>











