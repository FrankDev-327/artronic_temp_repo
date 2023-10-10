<?php
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "../../services/users/user.service.php";

if(!isset($_GET['id'])) {
    http_response_code(404);
    echo json_encode("Id cannot be empty.");
}

$userService = new UserService();
$userDetails = $userService->getDetailsRegister($_GET['id']);

if(isset($userDetails)) {
    http_response_code(200);
    echo json_encode($userDetails);
} else {
    http_response_code(404);
    echo json_encode("User does not exist");
}

?>