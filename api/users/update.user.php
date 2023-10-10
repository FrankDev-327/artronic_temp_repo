<?php 
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    if(!isset($_GET['id'])) {
        http_response_code(401);
        echo json_encode([
            "message" => "This value cant be empty."
        ]);
    }

    include_once "../../services/users/user.service.php";
    $userService = new UserService();
    $data = json_decode(file_get_contents("php://input"));

    $user = $userService->getDetailsRegister($_GET['id']);

    if(empty($user)) {
        http_response_code(401);
        echo json_encode([
            "message" => "This user does not exist."
        ]);
    } else {
        $user = $userService->updateExistingRegister($_GET['id'], $data);
        http_response_code(401);
        echo json_encode([
            "message" => "User was updated."
        ]);
    }
?>