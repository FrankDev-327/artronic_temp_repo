<?php
    session_start();
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Content-Type: application/json; charset=UTF-8");

    include "../../middleware/check.role.user.php";

    include_once "../../services/users/user.service.php";

    $userService = new UserService();
    $stmts = $userService->getListRegisters();
    
    if($stmts !== null) {
        http_response_code(200);
        echo json_encode($stmts);
    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }

?>