<?php

interface RepositoryInterface {
    public function findById($id);
    public function findAll();
    public function save($data);
    public function update($id, $data);
    public function delete($id);
}

?>