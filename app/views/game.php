<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: /pingpong_game/app/views/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ping Pong Retro</title>
    <link rel="stylesheet" href="/pingpong_game/public/css/game.css">
</head>
<body>
    <h1 class="game-title">Bienvenido al Ping Pong Retro, <?= htmlspecialchars($_SESSION['usuario_nombre']) ?>!</h1>

    <form id="gameSettings">
        <label for="pointLimit">Límite de Puntos:</label>
        <input type="number" id="pointLimit" name="pointLimit" min="1" max="20" value="10">
        <button type="button" id="startGame">Jugar</button>
    </form>

    <!-- Contenedor de puntuaciones con mejor distribución -->
    <div class="score-container">
        <div class="player-label">Player 1</div>
        <div class="score-value"><span id="score1">0</span> - <span id="score2">0</span></div>
        <div class="player-label">Player 2</div>
    </div>

    <div class="game-container">
        <canvas id="gameCanvas" width="800" height="400"></canvas>
    </div>

    <a href="/pingpong_game/app/views/lobby.php" class="btn-lobby">Volver al Lobby</a>

    <script src="/pingpong_game/public/js/game.js"></script>

</body>
</html>




