<?php
include "../../env.info.php";
include "./check.session.php";

if($_SESSION['user_role'] !== $constants['MAIN_ROLE'] && $_GET['id']) {
    http_response_code(400);
    echo json_encode([
        "message" => "You are not admin to make this action."
    ]);
    die();
}

?>