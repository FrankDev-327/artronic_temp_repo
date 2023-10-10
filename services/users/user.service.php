<?php

include "../../repository/user.repository.php";

/**
 * Summary of UserService
 */
class UserService {

    private $userRepository;


    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function getListRegisters() {
        return $this->userRepository->findAll();
    }

    public function createNewRegister($data) {
        return $this->userRepository->save($data);
    }

    public function updateExistingRegister($id, $data) {
        return $this->userRepository->update($id, $data);
    }

    public function deleteRegister($id) {

    }
    
    public function getDetailsRegister($id) {
        return $this->userRepository->findById($id);
    }   

    public function getUserByEmail($email) {
        return $this->userRepository->getByEmail($email);
    }
}

?>