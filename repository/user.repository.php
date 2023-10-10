<?php

include_once "../../config/database.php";
include "../../interfaces/repository.interface.php";
include "../../utils/util.php";

class UserRepository extends Database implements RepositoryInterface {

      private $connection;

      public function __construct() {
        $this->connection = $this->gettingConnection();
      }


    public function findById($id) {
        try {
            $query = "SELECT 
            id,
            name,
            lastName,
            email
            FROM ". $this->gettingTableName() ."
            WHERE id = ?
            LIMIT 0,1";

            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(1, $id);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $pDOException) {
            print "Error in " . $pDOException->getMessage();
            $this->closeConnection();
            throw new Exception("Error in " . $pDOException->getMessage());
        }
    }

    public function findAll() {
        try {
            $query = "SELECT * FROM ". $this->gettingTableName();
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
    
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $pDOException) {
            print "Error in " . $pDOException->getMessage();
            $this->closeConnection();
            throw new Exception("Error in " . $pDOException->getMessage());
        }
    }
    public function save($data) {
        try {
            $query = "INSERT INTO ". $this->gettingTableName() ." SET id = :id, name = :name, email = :email, password = :password, lastName = :last_name";
            $stmt = $this->connection->prepare($query);

            $uuid = Util::guidv4();
            $plainPassword = Util::hashPassword($data->password);
      
            $stmt->bindParam(":id", $uuid);
            $stmt->bindParam(":name", $data->name);
            $stmt->bindParam(":last_name", $data->last_name);
            $stmt->bindParam(":email", $data->email);
            $stmt->bindParam(":password", $plainPassword);

            if($stmt->execute()){
                return true;
            }
            return false;

        } catch (PDOException $pDOException) {
            print "Error in " . $pDOException->getMessage();
            $this->closeConnection();
            throw new Exception("Error in " . $pDOException->getMessage());
        }
    }
    public function update($id, $data) {}
    public function delete($id) {}

    public function getByEmail($email) {
        $query = "SELECT 
        id,
        name,
        lastName,
        email,
        password
        FROM ". $this->gettingTableName() ."
        WHERE email = :email
        LIMIT 0,1";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":email", $email);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}

?>