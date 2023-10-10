<?php
session_start();
include_once "../../config/database.php";
include "../../interfaces/repository.interface.php";
include "../../utils/util.php";

class UserRepository extends Database implements RepositoryInterface {

      private $connection;

      private $db_table = "users";

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
            FROM ". $this->db_table  ."
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
            $query = "SELECT 
            DISTINCT id,
            email,
            lastName,
            name,
            role,
            active
            FROM ". $this->db_table ;
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
            $query = "INSERT INTO ". $this->db_table  
            ." SET id = :id, 
            name = :name, 
            email = :email, 
            active = :active,
            role = :role,
            password = :password, 
            lastName = :last_name";
            $stmt = $this->connection->prepare($query);

            $uuid = Util::guidv4();
            $plainPassword = Util::hashPassword($data->password);
      
            $stmt->bindParam(":id", $uuid);
            $stmt->bindParam(":name", $data->name);
            $stmt->bindParam(":active", $data->active);
            $stmt->bindParam(":role", $data->role);
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
    public function update($id, $data) {
        try {
            $query = "UPDATE " . $this->db_table 
            ." SET role = :role,
               lastName = :lastName,
               name = :name,
               email = :email
               role = :role
            WHERE id = :id";

            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":role", $data->role);
            $stmt->bindParam(":email", $data->email);
            $stmt->bindParam(":name", $data->name);
            $stmt->bindParam(":lastName", $data->lastName);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $pDOException) {
            print "Error in " . $pDOException->getMessage();
            $this->closeConnection();
            throw new Exception("Error in " . $pDOException->getMessage());
        }
    }

    public function updateStatus($id, $data) {
        try {
            $query = "UPDATE " . $this->db_table 
            ." SET active = :active
            WHERE id = :id";

            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":active", $data->active);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $pDOException) {
            print "Error in " . $pDOException->getMessage();
            $this->closeConnection();
            throw new Exception("Error in " . $pDOException->getMessage());
        }
    }

    public function delete($id) {
        try {
            $query = "DELETE FROM " . $this->db_table . " WHERE id = :id";
            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $pDOException) {
            print "Error in " . $pDOException->getMessage();
            $this->closeConnection();
            throw new Exception("Error in " . $pDOException->getMessage());
        }
    }

    public function deleteAuthors() {
        try {
            $query = "DELETE FROM " . $this->db_table . " WHERE role = :role";
            $stmt = $this->connection->prepare($query);

            $role_user = "AUTHOR";
            $stmt->bindParam(":role", $role_user);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $pDOException) {
            print "Error in " . $pDOException->getMessage();
            $this->closeConnection();
            throw new Exception("Error in " . $pDOException->getMessage());
        }
    }

    public function getByEmail($email) {
        try {
            $query = "SELECT 
            id,
            name,
            lastName,
            email,
            role,
            password
            FROM ". $this->db_table ."
            WHERE email = :email
            LIMIT 0,1";
    
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(":email", $email);
    
            $stmt->execute();
    
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $pDOException) {
            print "Error in " . $pDOException->getMessage();
            $this->closeConnection();
            throw new Exception("Error in " . $pDOException->getMessage());
        }
    }
}

?>