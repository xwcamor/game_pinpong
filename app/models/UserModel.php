<?php
class UserModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function verificarUsuario($nombre_usuario) {
        $sql = "SELECT id, nombre, nombre_usuario, contrasena FROM usuarios WHERE nombre_usuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $nombre_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $user = $result->fetch_assoc();
        $stmt->close(); // Cerramos la consulta

        return $user ? $user : null; // Retornar null si no existe el usuario
    }

    public function registrarUsuario($nombre, $nombre_usuario, $contrasena) {
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nombre, nombre_usuario, contrasena) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $nombre, $nombre_usuario, $hashed_password);
        
        $resultado = $stmt->execute();
        $stmt->close(); // Cerramos la consulta

        return $resultado; // Retorna true si el registro es exitoso
    }
}
?>


