<?php

include_once "../../dto/users/create.dto.php";

interface RepositoryInterface {
    public function findById($id): array;
    public function findAll(): array;
    public function save($data): bool;
    public function update($id, $data) : bool ;
    public function delete($id): array;
}

?>