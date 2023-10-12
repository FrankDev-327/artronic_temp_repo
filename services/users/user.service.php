<?php

include "../../repository/user.repository.php";
include_once "../../dto/users/create.dto.php";
include_once "../../dto/users/update.dto.php";
include_once "../../dto/users/update.status.dto.php";

/**
 * Summary of UserService
 */
class UserService {

    /**
     * Summary of userRepository
     * @var 
     */
    private $userRepository;


    /**
     * Summary of __construct
     */
    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    /**
     * Summary of getListRegisters
     * @return array
     */
    public function getListRegisters() {
        return $this->userRepository->findAll();
    }

    /**
     * Summary of createNewRegister
     * @param CreateDto $data
     * @return bool
     */
    public function createNewRegister(CreateDto $data) {
        return $this->userRepository->save($data);
    }

    /**
     * Summary of updateExistingRegister
     * @param string $id
     * @param UpdateDto $data
     * @return bool
     */
    public function updateExistingRegister(string $id, UpdateDto $data) {
        return $this->userRepository->update($id, $data);
    }

    /**
     * Summary of updateUserStatus
     * @param string $id
     * @param UpdateStatusDto $data
     * @return mixed
     */
    public function updateUserStatus(string $id, UpdateStatusDto $data) {
        return $this->userRepository->updateStatus($id, $data);
    }

    /**
     * Summary of deleteRegister
     * @param string $id
     * @return mixed
     */
    public function deleteRegister(string $id) {
        return $this->userRepository->delete($id);
    }

    /**
     * Summary of deleteAllAuthors
     * @return mixed
     */
    public function deleteAllAuthors() {
        return $this->userRepository->deleteAuthors();
    }
    
    /**
     * Summary of getDetailsRegister
     * @param string $id
     * @return mixed
     */
    public function getDetailsRegister(string $id) {
        return $this->userRepository->findById($id);
    }   

    /**
     * Summary of getUserByEmail
     * @param string $email
     * @return mixed
     */
    public function getUserByEmail(string $email) {
        return $this->userRepository->getByEmail($email);
    }
}

?>