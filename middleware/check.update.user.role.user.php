<?php
include "../../env.info.php";

if($_SESSION == null || count($_SESSION) <= 0) {
    http_response_code(400);
    echo json_encode([
        "message" => "You have to be logged to make this action."
    ]);
    die();
}

if($_SESSION['user_role'] !== $constants['MAIN_ROLE'] && $_GET['id']) {
    http_response_code(400);
    echo json_encode([
        "message" => "You are not admin to make this action."
    ]);
    die();
}

?>