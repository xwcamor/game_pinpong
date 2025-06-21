<?php

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request = str_replace("/pingpong_game", "", $request);

switch ($request) {
    case "/":
    case "/login":
        require __DIR__ . "/app/views/login.php";
        break;
    case "/lobby":
        require __DIR__ . "/app/views/lobby.php";
        break;
    case preg_match("/^\/perfil\/[a-zA-Z0-9]+$/", $request) ? true : false:
        require __DIR__ . "/app/views/profile.php";
        break;
    default:
        http_response_code(404);
        echo "Página no encontrada";
        break;
}

?>

