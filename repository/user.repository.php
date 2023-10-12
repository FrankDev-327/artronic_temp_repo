<?php

session_start();
include_once "../../dto/users/create.dto.php";
include_once "../../config/database.php";
include "../../interfaces/repository.interface.php";
include "../../utils/util.php";

/**
 * Summary of UserRepository
 */
class UserRepository extends Database implements RepositoryInterface {

      /**
       * Summary of connection
       * @var 
       */
      private $connection;

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
     * Summary of findById
     * @param mixed $id
     * @throws \Exception
     * @return mixed
     */
    public function findById($id) : array {
        try {
            $query = "SELECT 
            id,
            name,
            lastName,
            email
            FROM ". $this->db_table ."
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

    /**
     * Summary of findAll
     * @throws \Exception
     * @return array
     */
    public function findAll(): array {
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
    /**
     * Summary of save
     * @param CreateDto $data
     * @throws \Exception
     * @return bool
     */
    public function save($data): bool {
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
    
            $name = $data->getName();
            $active = $data->getActive();
            $role = $data->getRole();
            $lastName = $data->getLastName();
            $email = $data->getEmail();
            $hashedPassword = Util::hashPassword($data->getPassword());

            $stmt->bindParam(":id", $uuid);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":active", $active);
            $stmt->bindParam(":role", $role);
            $stmt->bindParam(":last_name", $lastName);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $hashedPassword);

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

    /**
     * Summary of update
     * @param mixed $id
     * @param mixed $data
     * @throws \Exception
     * @return bool
     */
    public function update($id, $data): bool {
        try {
            $bindParams = array(
                ":id" => $id,
                ":name" => $data->getName(),
                ":lastName" => $data->getLastName(),
                ":email" => $data->getEmail(),
                ":active" => $data->getActive(),
                ":book_id" => $data->getBookId()
            );

            $query = "UPDATE " . $this->db_table ." SET ";
            if($_SESSION['user_role'] === "ADMIN") {
                $query .= "role = :role, ";
                $bindParams[':role'] = $data->role;
            }

            $query .= "lastName = :lastName, 
            name = :name, 
            email = :email, 
            active = :active, 
            book_id = :book_id 
            WHERE id = :id";
            
            $stmt = $this->connection->prepare($query);
            
            foreach($bindParams as $paramName => $paramValue) {
                $stmt->bindParam($paramName, $paramValue);
            }
            
            if($stmt->execute()) {
                return true;
            }

            return false;
              
        } catch (PDOException $pDOException) {
            print "Error in " . $pDOException->getMessage();
            $this->closeConnection();
            throw new Exception("Error in " . $pDOException->getMessage());
        }
    }

    /**
     * Summary of updateStatus
     * @param string $id
     * @param mixed $data
     * @throws \Exception
     * @return mixed
     */
    public function updateStatus($id, $data): bool {
        try {
            $query = "UPDATE " . $this->db_table 
            ." SET active = :active
            WHERE id = :id";

            $status = $data->getActive();

            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":active", $status);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $pDOException) {
            print "Error in " . $pDOException->getMessage();
            $this->closeConnection();
            throw new Exception("Error in " . $pDOException->getMessage());
        }
    }

    /**
     * Summary of delete
     * @param mixed $id
     * @throws \Exception
     * @return mixed
     */
    public function delete($id): array {
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

    /**
     * Summary of deleteAuthors
     * @throws \Exception
     * @return mixed
     */
    public function deleteAuthors() : array {
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

    /**
     * Summary of getByEmail
     * @param mixed $email
     * @throws \Exception
     * @return mixed
     */
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