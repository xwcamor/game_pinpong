<?php
session_start();
if (!isset($_SESSION["usuario_nombre"])) {
    header("Location: /pingpong_game/app/views/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lobby - Ping Pong Retro</title>
    <link rel="stylesheet" href="/pingpong_game/public/css/lobby.css">
</head>
<body>
    <header class="lobby-header">
        <h1 class="lobby-title">PING PONG RETRO</h1>
        <h2 class="username-display">Jugador: <?= htmlspecialchars($_SESSION["usuario_nombre"]) ?></h2>
    </header>

    <main class="lobby-content">
        <a href="/pingpong_game/app/views/game.php" class="btn-lobby">Jugar</a>
        <a href="/pingpong_game/app/views/profile.php" class="btn-lobby">Perfil</a>
        <a href="/pingpong_game/app/controllers/logout.php" class="btn-lobby logout-btn">Cerrar Sesión</a>
    </main>
</body>
</html>



















