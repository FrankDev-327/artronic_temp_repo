<?php
include_once "../../config/database.php";

class MigrationRepository extends Database {
    protected $connection;

    private $db_table = "users";

    public function __construct() {
        $this->connection = $this->gettingConnection();
    }

    public function addRoleColumnToUserTable() {
        try {
            $query = "ALTER TABLE ". $this->db_table . " ADD role VARCHAR(20)";
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
            $query = "ALTER TABLE ". $this->db_table . " DROP role";
            $stmt = $this->connection->prepare($query);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $pDOException) {
            print "Error in " . $pDOException->getMessage();
            $this->closeConnection();
            throw new Exception("Error in " . $pDOException->getMessage());
        }
    }

    public function addActiveColumnIntoUserTable() {
        try {
            $query = "ALTER TABLE ". $this->db_table . " ADD active BOOLEAN";
            $stmt = $this->connection->prepare($query);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $pDOException) {
            print "Error in " . $pDOException->getMessage();
            $this->closeConnection();
            throw new Exception("Error in " . $pDOException->getMessage());
        }
    }

    public function deleteActiveColumnIntoUserTable() {
        try {
            $query = "ALTER TABLE ". $this->db_table . " DROP active";
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