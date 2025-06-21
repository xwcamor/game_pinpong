<?php
session_start();
$error = isset($_GET["error"]) ? $_GET["error"] : "";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Ping Pong Retro</title>
    <link rel="stylesheet" href="/pingpong_game/public/css/register.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="register-container">
        <!-- Título del registro -->
        <h1 class="register-title">CREAR CUENTA</h1>

        <!-- Formulario de registro -->
        <form action="/pingpong_game/app/controllers/RegisterController.php" method="POST">
            <div class="input-group">
                <input type="text" name="nombre" class="register-input" placeholder="Nombre" required>
            </div>
            <div class="input-group">
                <input type="text" name="nombre_usuario" class="register-input" placeholder="Nombre de Usuario" required>
            </div>
            <div class="input-group">
                <input type="password" name="contrasena" class="register-input" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn-register">Registrarse</button>
        </form>

        <div class="footer-links">
            <a href="login.php">¿Ya tienes cuenta? Iniciar sesión</a>
        </div>
    </div>

    <script>
        let errorMsg = "<?= htmlspecialchars($error) ?>";
        if (errorMsg) {
            Swal.fire({
                icon: 'error',
                title: 'Error en el registro',
                text: errorMsg,
                confirmButtonColor: '#d33'
            });
        }

        document.querySelector("form").addEventListener("submit", function(event) {
            let nombreReal = document.querySelector("[name='nombre']").value.trim();
            let usuario = document.querySelector("[name='nombre_usuario']").value.trim();
            let contrasena = document.querySelector("[name='contrasena']").value.trim();

            if (!nombreReal || !usuario || !contrasena) {
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



