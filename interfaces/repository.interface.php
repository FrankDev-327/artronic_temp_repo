<?php

include_once "../../dto/users/create.dto.php";
interface RepositoryInterface {
    public function findById($id);
    public function findAll();
    public function save(CreateDto $data);
    public function update($id, $data);
    public function delete(string $id);
}

?>