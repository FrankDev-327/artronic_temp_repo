<?php
    include_once "../../env.info.php";

    $headers = null;
    if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
        http_response_code(401);
        echo json_encode([
            "message" => "Not authorizated!"
        ]);
        die();
    }

    $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    if($headers !== $constants['TOKEN']) {
        http_response_code(401);
        echo json_encode([
            "message" => "Token not valid!"
        ]);
        die();
    }

?>