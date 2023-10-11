<?php
session_start();
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "../../middleware/check.authorizare.token.php";
include "../../middleware/check.role.user.php";
include_once "../../services/users/user.service.php";
include_once "../../dto/users/create.dto.php";

$userService = new UserService();
$data = json_decode(file_get_contents("php://input"));
$createDto = new CreateDto(
    $data->name,
    $data->password,
    $data->last_name,
    $data->email,
    $data->role,
    $data->active
);
$userCreated = $userService->createNewRegister($createDto);

if ($userCreated) {
    http_response_code(200);
    echo 'User created successfully.';
} else{
    http_response_code(401);
    echo 'User could not be created.';
}

?>