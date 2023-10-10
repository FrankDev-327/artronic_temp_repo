<?php 
    session_start();
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include "../../middleware/check.authorizare.token.php";
    include "../../middleware/check.update.user.role.user.php";
    include_once "../../services/users/user.service.php";

    $userService = new UserService();
    $data = $userService->deleteAllAuthors();

    http_response_code(200);
    echo json_encode($data);

?>