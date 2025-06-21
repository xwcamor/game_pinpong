<?php
require_once __DIR__ . "/../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"]);
    $nombre_usuario = trim($_POST["nombre_usuario"]);
    $contrasena = trim($_POST["contrasena"]);

    if (empty($nombre) || empty($nombre_usuario) || empty($contrasena)) {
        header("Location: ../views/register.php?error=Completa todos los campos");
        exit();
    }

    // Verificar si el usuario ya existe
    $sql = "SELECT id FROM usuarios WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        header("Location: ../views/register.php?error=Usuario ya registrado");
        exit();
    }
    
    $stmt->close(); // Cerrar consulta previa

    // Hash de la contraseña y registro
    $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (nombre, nombre_usuario, contrasena) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $nombre_usuario, $hashed_password);

    if ($stmt->execute()) {
        header("Location: ../views/login.php?registro=exitoso");
        exit();
    } else {
        header("Location: ../views/register.php?error=Error al registrar usuario");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>



