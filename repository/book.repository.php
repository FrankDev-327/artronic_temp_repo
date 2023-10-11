<?php 
    include_once "../../config/database.php";
    include "../../interfaces/repository.interface.php";

    /**
     * Summary of BookRepository
     */
    class BookRepository extends Database implements RepositoryInterface  {

        private $connection;

        private $db_table = "books";

        /**
         * Summary of __construct
         */
        public function __construct() {
            $this->connection = $this->gettingConnection();
        }

        public function save($data): bool {
            try {
          
            } catch (PDOException $pDOException) {
                print "Error in " . $pDOException->getMessage();
                $this->closeConnection();
                throw new Exception("Error in " . $pDOException->getMessage());
            }
        }

        /**
         * Summary of findAll
         * @return array
         */
        public function findAll(): array {
            try {
                $query = "SELECT * FROM " . $this->db_table;
                $stmt = $this->connection->prepare($query);
    
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $pDOException) {
                print "Error in " . $pDOException->getMessage();
                $this->closeConnection();
                throw new Exception("Error in " . $pDOException->getMessage());
            }
        }

        public function findById($id): array {
            try {
          
            } catch (PDOException $pDOException) {
                print "Error in " . $pDOException->getMessage();
                $this->closeConnection();
                throw new Exception("Error in " . $pDOException->getMessage());
            }
        }

        public function update($id, $data): bool {
            try {
          
            } catch (PDOException $pDOException) {
                print "Error in " . $pDOException->getMessage();
                $this->closeConnection();
                throw new Exception("Error in " . $pDOException->getMessage());
            }
        }

        public function delete($id): array {
            try {
          
            } catch (PDOException $pDOException) {
                print "Error in " . $pDOException->getMessage();
                $this->closeConnection();
                throw new Exception("Error in " . $pDOException->getMessage());
            }
        }
    }
?>