<?php
session_start();
include_once "../../env.info.php";
include_once "./check.session.php";

if($_SESSION['user_role'] !== $constants['MAIN_ROLE'] && $_GET['id']) {
    http_response_code(400);
    echo json_encode([
        "message" => "You are not admin to make this action."
    ]);
    die();
}

?>