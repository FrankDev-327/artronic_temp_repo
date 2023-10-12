<?php 
    session_start();
    include_once "../../config/database.php";
    include "../../interfaces/repository.interface.php";
    include "../../services/users/user.service.php";
    include "../../dto/users/update.dto.php";

    /**
     * Summary of BookRepository
     */
    class BookRepository extends Database implements RepositoryInterface  {

        private $connection;

        private $db_table = "books";

        private $userService;

        /**
         * Summary of __construct
         */
        public function __construct() {
            $this->userService = new UserService();
            $this->connection = $this->gettingConnection();
        }

        public function save($data): bool {
            try {
                $queryExecute = false;
                $query = "INSERT INTO " . $this->db_table 
                . "SET 
                title = :title,
                description = :description,
                publisher = :publisher 
                ";

                $title = $data->getTitle();
                $description = $data->getDescription();
                $publisher = $data->getPublisher();

                $stmt = $this->connection->prepare($query);
                $stmt->bindParam(":title", $title);
                $stmt->bindParam(":description", $description);
                $stmt->bindParam(":publisher", $publisher);

                if($stmt->execute()){
                    $userId = !isset($data->userId) 
                    ?  $data->userId 
                    : $_SESSION['user_id'];

                    $user = $this->userService->getDetailsRegister($userId);
                    $previousUserBook = $user->bookId;

                    if($previousUserBook) {
                        $this->delete($previousUserBook);
                    }

                    $book = $this->getIdByTitle($title);
                    $data = new UpdateDto(
                        $user->name,
                        $user->lastName,
                        $user->email,
                        $user->role,
                        $user->active,
                        $book->id
                    );
                    
                    $this->userService->updateExistingRegister($user->id, $data);

                    $queryExecute = true;
                }
    
                return $queryExecute;

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
                $queryExecute = false;
                $query = "SELECT * FROM " 
                . $this->db_table 
                . " WHERE id = :id
                LIMIT 0,1";

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

        public function update($id, $data): bool {
            try {
                return true;
            } catch (PDOException $pDOException) {
                print "Error in " . $pDOException->getMessage();
                $this->closeConnection();
                throw new Exception("Error in " . $pDOException->getMessage());
            }
        }

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

        public function getIdByTitle(string $title) {
            try {
                $query = "SELECT id FROM " . $this->db_table . "WHERE title = :title";
                $stmt = $this->connection->prepare($query);

                $stmt->bindParam(":title", $title);
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_OBJ);
            }  catch (PDOException $pDOException) {
                print "Error in " . $pDOException->getMessage();
                $this->closeConnection();
                throw new Exception("Error in " . $pDOException->getMessage());
            }
        }
    }
?>