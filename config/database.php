<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "localhost";
$user = "root"; 
$pass = ""; 
$dbname = "pingpong_db";

try {
    $conn = new mysqli($host, $user, $pass, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Error de conexión: " . $conn->connect_error);
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    exit("Problema al conectar con la base de datos.");
}
?>


