<?php 
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "../../services/migrations/migration.service.php";

$migration = new MigrationService();

http_response_code(200);
echo json_encode($migration->deleteRoleColumnToUsersTable());

?>