<?php
include_once "../../config/database.php";

/**
 * Summary of MigrationRepository
 */
class MigrationRepository extends Database {
    /**
     * Summary of connection
     * @var 
     */
    protected $connection;

    /**
     * Summary of db_table
     * @var string
     */
    private $db_table = "users";

    /**
     * Summary of __construct
     */
    public function __construct() {
        $this->connection = $this->gettingConnection();
    }

    /**
     * Summary of addRoleColumnToUserTable
     * @throws \Exception
     * @return array
     */
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

    /**
     * Summary of deleteRoleColumnToUserTable
     * @throws \Exception
     * @return array
     */
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

    /**
     * Summary of addActiveColumnIntoUserTable
     * @throws \Exception
     * @return array
     */
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

    /**
     * Summary of deleteActiveColumnIntoUserTable
     * @throws \Exception
     * @return array
     */
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