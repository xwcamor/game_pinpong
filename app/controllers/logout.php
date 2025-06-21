<?php
session_start();

if (isset($_SESSION["usuario_id"])) {
    $_SESSION = []; // Limpiar la sesión
    session_destroy(); // Cierra la sesión
}

header("Location: /pingpong_game/app/views/login.php");
exit();
?>

