<?php
session_start();
require_once __DIR__ . "/../../config/database.php";

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /pingpong_game/app/views/login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
    $avatar = $_FILES['avatar'];
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

    // Validar el formato del archivo y el tamaño
    if (in_array($avatar['type'], $allowedTypes) && $avatar['size'] <= 500000) {
        $extension = pathinfo($avatar['name'], PATHINFO_EXTENSION);
        $avatarPath = "/pingpong_game/public/avatars/" . $usuario_id . "." . $extension;
        $serverPath = $_SERVER['DOCUMENT_ROOT'] . $avatarPath;

        // Crear la carpeta si no existe
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/pingpong_game/public/avatars")) {
            mkdir($_SERVER['DOCUMENT_ROOT'] . "/pingpong_game/public/avatars", 0777, true);
        }

        // Mover el archivo correctamente
        if (move_uploaded_file($avatar['tmp_name'], $serverPath)) {
            // Actualizar la ruta en la base de datos
            $query = "UPDATE usuarios SET avatar = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $avatarPath, $usuario_id);
            $stmt->execute();

            header("Location: /pingpong_game/app/views/profile.php");
            exit();
        } else {
            echo "<script>alert('Error al guardar la imagen. Verifica permisos de la carpeta.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Formato o tamaño no permitido. Usa JPG o PNG, máximo 500KB.'); window.history.back();</script>";
    }
}
?>

