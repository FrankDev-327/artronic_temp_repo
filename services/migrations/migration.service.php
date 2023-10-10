<?php
include "../../repository/migration.repository.php";

class MigrationService {
    protected $migrationRepository;

    public function __construct() {
        $this->migrationRepository = new MigrationRepository();
    }

    public function addNewColumnIntoUsersTable() {
        return $this->migrationRepository->addRoleColumnToUserTable();
    }

    public function deleteRoleColumnToUsersTable() {
        return $this->migrationRepository->deleteRoleColumnToUserTable();
    }
}

?>