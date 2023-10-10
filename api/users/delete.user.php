<?php 
    session_start();
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include "../../middleware/check.authorizare.token.php";
    include "../../middleware/check.update.user.role.user.php";

    if(!isset($_GET['id'])) {
        http_response_code(401);
        echo json_encode([
            "message" => "This value cant be empty."
        ]);
    }

    include_once "../../services/users/user.service.php";
    $userService = new UserService();
    $data = $userService->getDetailsRegister($_GET['id']);

    if(!isset($data)) {
        http_response_code(401);
        echo json_encode([
            "message" => "This user does not exist"
        ]);
        die();
    }

    $data = $userService->deleteRegister($data->id);
    http_response_code(200);
    echo json_encode($data);

?>