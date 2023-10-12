<?php 
    session_start();
    include_once "../../config/database.php";
    include_once "../../interfaces/repository.interface.php";
    include "../../services/users/user.service.php";
    include_once "../../dto/users/update.dto.php";
    include_once "../../utils/util.php";

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

        public function save($data) {
            try {
                $queryExecute = false;
                $query = "INSERT INTO " . $this->db_table 
                . " SET id = :id,
                title = :title,
                description = :description,
                publisher = :publisher";
                $stmt = $this->connection->prepare($query);

                $title = $data->getTitle();
                $description = $data->getDescription();
                $publisher = $data->getPublisher();

                $uuid = Util::guidv4();

                $stmt->bindParam(":id", $uuid);
                $stmt->bindParam(":title", $title);
                $stmt->bindParam(":description", $description);
                $stmt->bindParam(":publisher", $publisher);

                if($stmt->execute()) {
                    $userId = !empty($data->getUserId()) 
                    ?  $data->getUserId() 
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
        public function findAll() {
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

        public function findById($id) {
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

        public function update($id, $data) {
            try {
                return true;
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

        public function getIdByTitle(string $title) {
            try {
                $query = "SELECT id FROM " . $this->db_table . " WHERE title = :title";
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