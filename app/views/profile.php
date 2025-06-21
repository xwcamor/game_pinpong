<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: /pingpong_game/app/views/login.php");
    exit();
}

// Conexión a la base de datos
require_once __DIR__ . "/../../config/database.php";

// Obtener datos del usuario
$usuario_id = $_SESSION['usuario_id'];
$query = "SELECT nombre, avatar, victorias, derrotas, partidas_jugadas FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de <?= htmlspecialchars($usuario['nombre']) ?></title>
    <link rel="stylesheet" href="/pingpong_game/public/css/profile.css">
</head>
<body>
    <div class="profile-container">
        <h1 class="profile-title">Perfil de <?= htmlspecialchars($usuario['nombre']) ?></h1>

        <div class="avatar-container">
            <img src="<?= htmlspecialchars($usuario['avatar']) ?>" alt="Avatar de <?= htmlspecialchars($usuario['nombre']) ?>" class="avatar">
            <form action="/pingpong_game/app/controllers/update_avatar.php" method="POST" enctype="multipart/form-data">
                <label for="avatarUpload" class="btn-upload">Cambiar Avatar</label>
                <input type="file" id="avatarUpload" name="avatar" accept="image/*">
                <button type="submit" class="btn-save">Guardar Cambios</button>
            </form>
        </div>

        <div class="stats-container">
            <h2>Estadísticas</h2>
            <p>🏆 **Victorias:** <?= htmlspecialchars($usuario['victorias']) ?></p>
            <p>🔴 **Derrotas:** <?= htmlspecialchars($usuario['derrotas']) ?></p>
            <p>🎮 **Partidas Jugadas:** <?= htmlspecialchars($usuario['partidas_jugadas']) ?></p>
        </div>

        <a href="/pingpong_game/app/views/lobby.php" class="btn-lobby">Volver al Lobby</a>
    </div>
</body>
</html>
