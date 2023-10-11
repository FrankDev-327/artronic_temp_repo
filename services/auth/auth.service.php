<?php

include_once "../../dto/auth/login.dto.php";
include "../../services/users/user.service.php";
class AuthService {
    protected $userService;

    public function __construct() {
        $this->userService = new UserService();
    }
    
    public function login(AuthDto $data) {
        $existUser = $this->userService->getUserByEmail($data->getEmail());
        if(empty($existUser)) {
            return [
                "check" => false,
                "data" => null,
                "message" => "Wrong email or password"
            ];
        }

        $checkPassword = Util::verifyingPasswords($data->getPassword(), $existUser->password);

        if($checkPassword == false) {
            return [
                "check" => false,
                "data" => null,
                "message" => "Wrong email or password"
            ];
        }

        unset($existUser->password);
        return [
            "check" => true,
            "data" => $existUser,
            "message" => "Logging successfully."
        ];

    }
}

?>