<?php 
    session_start();
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once "../../services/users/user.service.php";

    $userService = new UserService();
    $data = json_decode(file_get_contents("php://input"));

    $user = $userService->updateUserStatus($_SESSION['user_id'], $data);
    http_response_code(200);
    echo json_encode([
        "message" => "User was updated."
    ]);
?>