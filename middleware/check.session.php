<?php

if($_SESSION == null || count($_SESSION) <= 0) {
    http_response_code(400);
    echo json_encode([
        "message" => "You have to be logged to make this action."
    ]);
    die();
}
?>