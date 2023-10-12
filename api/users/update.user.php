<?php 
    session_start();
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include "../../middleware/check.authorizare.token.php";

    $data = json_decode(file_get_contents("php://input"));
    if($_SESSION['user_role'] === "AUTHOR" && $data->role && $data->role !== null) {
        http_response_code(401);
        echo json_encode([
            "message" => "Only admin can update roles."
        ]);
        die();
    }

    $id = $_SESSION['user_id'];
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        include_once "../../services/users/user.service.php";
        $userService = new UserService();
    
        $user = $userService->getDetailsRegister($id);
        if(empty($user)) {
            http_response_code(404);
            echo json_encode([
                "message" => "This user does not exist."
            ]);
            die();
        } 
    }
    
    include "../../dto/users/update.dto.php";
    $updateDto = new UpdateDto(
        $data->name,
        $data->$lastName,
        $data->email,
        $data->role,
        $data->active,
        $data->bookId
    );

    $userUpdated = $userService->updateExistingRegister($id, $updateDto);
    if (!$userUpdated) {
        http_response_code(401);
        echo json_encode([
            'message' => 'User was not updated successfully.'
        ]);
        die();
    } 

    http_response_code(200);
    echo json_encode([
        'message' => 'User updated successfully.'
    ]);
?>