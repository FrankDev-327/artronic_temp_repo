<?php
include_once "../../config/database.php";

class MigrationRepository extends Database {
    protected $connection;

    public function __construct() {
        $this->connection = $this->gettingConnection();
    }

    public function addRoleColumnToUserTable() {
        try {
            $query = "ALTER TABLE ". $this->gettingTableName() . " ADD role VARCHAR(20)";
            $stmt = $this->connection->prepare($query);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $pDOException) {
            print "Error in " . $pDOException->getMessage();
            $this->closeConnection();
            throw new Exception("Error in " . $pDOException->getMessage());
        }
    }

    public function deleteRoleColumnToUserTable() {
        try {
            $query = "ALTER TABLE ". $this->gettingTableName() . " DROP role";
            $stmt = $this->connection->prepare($query);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $pDOException) {
            print "Error in " . $pDOException->getMessage();
            $this->closeConnection();
            throw new Exception("Error in " . $pDOException->getMessage());
        }
    }
}

?>