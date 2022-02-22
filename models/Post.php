<?php 

class Post {
    // Database stuff

    private $conn; // Dtabase connection
    private $table ='posts'; // Database table 
    
    // Post Properties 
    public $id;
    public $category_id;
    public $category_name;// we dont have category name in our posts table but we have the id so we can use joins to get the c_name also
    public $title;
    public $body;
    public $author;
    public $created_at;

    // Constructor with DB
    public function __construct($db){
        $this->conn = $db;
    }

    // Get Posts
    public function read(){
        // Create Query
        $query = 'SELECT
                 c.name as category_name,
                 p.id,
                 p.category_id,
                 p.title,
                 p.body,
                 p.author,
                 p.created_at
                 FROM
                 '.$this->table.' p
                 LEFT JOIN 
                 categories as c ON p.category_id = c.id
                 ORDER BY
                 p.created_at DESC
                 
                 ';

        // Prepared Statement 
        $stmt = $this->conn->prepare($query); //this is pdo right here 

        // Execute the query
        $stmt->execute();

        return $stmt;
    }


    // Get a single post
    public function read_single(){
        // Create Query
        // ? because we are using PDO's bind param , we are going to bind something to this
        $query = 'SELECT
                 c.name as category_name,
                 p.id,
                 p.category_id,
                 p.title,
                 p.body,
                 p.author,
                 p.created_at
                 FROM
                 '.$this->table.' p
                 LEFT JOIN 
                 categories as c ON p.category_id = c.id

                 WHERE p.id =?
                 LIMIT 0,1
                 ';

        // Prepared Statement 
        $stmt = $this->conn->prepare($query); //this is pdo right here 
        // Bind values (ID)

        $stmt->bindParam(1,$this->id); // First parameter should bind to $this->id (using positional params ther are also named)

        // Execute the query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // SET PROPERTIES 
        $this->title = $row['title'];
        $this->author = $row['author'];
        $this->body = $row['body'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];

    }

    // CREATE POST
    public function create(){
        // Create Query 

        $query = 'INSERT INTO '.$this->table.'
                  SET 
                    title = :title,
                    body =:body,
                    author=:author,
                    category_id =:category_id
                ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // BIND NAMED PARAMS 
        $stmt->bindParam(':title',$this->title);
        $stmt->bindParam(':body',$this->body);
        $stmt->bindParam(':author',$this->author);
        $stmt->bindParam(':category_id',$this->category_id);

        // Execute query
        
        if($stmt->execute()){
            return true;
        }

        // Print error if something goes wrong
        printf("ERROR: %s.\n", $stmt->error);

        return false;
    }

    //Update Post
    public function update(){
                // Create Query 

                $query = 'UPDATE  '.$this->table.'
                SET 
                  title = :title,
                  body =:body,
                  author=:author,
                  category_id =:category_id
                
                WHERE id=:id
              ';

               // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // BIND NAMED PARAMS 
        $stmt->bindParam(':title',$this->title);
        $stmt->bindParam(':body',$this->body);
        $stmt->bindParam(':author',$this->author);
        $stmt->bindParam(':category_id',$this->category_id);
        $stmt->bindParam(':id',$this->id);

        // Execute query
        
        if($stmt->execute()){
            return true;
        }

        // Print error if something goes wrong
        printf("ERROR: %s.\n", $stmt->error);

        return false;
    }
    // Delete the Post
    
    // Delete Post
    public function delete() {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
  }


}