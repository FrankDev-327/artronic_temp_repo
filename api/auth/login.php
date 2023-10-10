<?php
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

include_once "../../services/auth/auth.service.php";

$authService = new AuthService();
$data = json_decode(file_get_contents("php://input"));
$userLogged = $authService->login($data);

if($userLogged['check']) {
    $_SESSION['user_id'] = $userLogged['data']->id;
    $_SESSION['user_role'] = $userLogged['data']->role;
    http_response_code(200);
    echo json_encode($userLogged);
} else {
    http_response_code(401);
    echo json_encode($userLogged);
}
?>