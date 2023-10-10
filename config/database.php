<?php 
include_once "../../env.info.php";

class Database {
    private $host = "172.19.0.2";
    private $database_name = "users_test";
    private $username = "root";
    private $password = "root";
    public $conn = null;
    public $port = 3006;

    private function connectionDB() {
        $options = array(
			PDO::MYSQL_ATTR_INIT_COMMAND 	=> 'SET NAMES utf8',
			PDO::ATTR_ERRMODE 				=> PDO::ERRMODE_EXCEPTION,
			PDO::MYSQL_ATTR_FOUND_ROWS 		=> true,
			PDO::ATTR_PERSISTENT 			=> true
		);
        
        try {
            $this->conn = new PDO(
                "mysql:host=". $this->host . ";dbname=". $this->database_name, 
                $this->username, 
                $this->password, 
                $options
            );
        } catch (PDOException $e) {
            print 'Error: '. $e->getMessage();
			die();
        }
        
        return $this->conn;
    }

    public function gettingConnection() {
        return $this->connectionDB();
    }

    public function closeConnection() {
        $this->conn = null;
    }
}

?>