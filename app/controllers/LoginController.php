<?php
session_start();
require_once __DIR__ . "/../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST["nombre_usuario"]);
    $password = trim($_POST["contrasena"]);

    if (empty($usuario) || empty($password)) {
        header("Location: /pingpong_game/app/views/login.php?error=Usuario no registrado");
        exit();

    }

    $sql = "SELECT id, nombre, contrasena FROM usuarios WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["contrasena"])) {
            $_SESSION["usuario_id"] = $user["id"];
            $_SESSION["usuario_nombre"] = $user["nombre"];
            header("Location: /pingpong_game/app/views/lobby.php");
            exit();
        } else {
            header("Location: /pingpong_game/app/views/login.php?error=Contraseña incorrecta");
            exit();
        }
    } else {
        header("Location: /pingpong_game/app/views/login.php?error=Usuario no registrado");
        exit();
    }
}
?>





