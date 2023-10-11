<?php

include "../../repository/user.repository.php";
include_once "../../dto/users/create.dto.php";

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

    public function createNewRegister(CreateDto $data) {
        return $this->userRepository->save($data);
    }

    public function updateExistingRegister($id, $data) {
        return $this->userRepository->update($id, $data);
    }

    public function updateUserStatus($id, $data) {
        return $this->userRepository->updateStatus($id, $data);
    }

    public function deleteRegister($id) {
        return $this->userRepository->delete($id);
    }

    public function deleteAllAuthors() {
        return $this->userRepository->deleteAuthors();
    }
    
    public function getDetailsRegister($id) {
        return $this->userRepository->findById($id);
    }   

    public function getUserByEmail($email) {
        return $this->userRepository->getByEmail($email);
    }
}

?>