<?php 
class Database{
    //Database parameters
    private $host = 'localhost';
    private $db_name = 'blog';
    private $username = 'root';
    private $password = '';
    private $conn;

    // DB Connect
    public function connect() {
      $this->conn = null;
        
      // Connect through PDO
      try{
            // takes in DSN (type and host) , username, password etc.
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);

            // Set the error mode to get the exceptions for example when we make queries if anything goes wrong we will be able to look at it
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); // PDO has lot of attributes that we can set (visit docs)
      }catch(PDOException $e){
            echo 'Connection Error' .$e->getMessage(); 
      }

      return $this->conn; // Return the connection to database
    }
}