<?php 
    session_start();
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include "../../services/users/user.service.php";
    include_once "../../dto/users/update.status.dto.php";

    $userService = new UserService();
    $data = json_decode(file_get_contents("php://input"));
    $statusDto = new UpdateStatusDto($data->active);
    $user = $userService->updateUserStatus($_SESSION['user_id'], $statusDto);

    http_response_code(200);
    echo json_encode([
        "message" => "User was updated."
    ]);
?>