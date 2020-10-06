<?php
class News{
  
    // database connection and table name
    private $conn;
    private $table_name = "news";
  
    // object properties
    public $id;
    public $author;
    public $title;
    public $category;
    public $date_added;
    public $content;
    public $short_description;
    public $picture;
    public $picture_source;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read armies
    function read(){
    
        // select all query
        $query = "SELECT * FROM " . $this->table_name . ";";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create army
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    author=:author, title=:title, category=:category, date_added=:date_added, content=:content,
                    short_desciption=:short_description, picture=:picture, picture_source=:picture_source;";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->author=htmlspecialchars(strip_tags($this->author));
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->category=htmlspecialchars(strip_tags($this->category));
        $this->date_added=htmlspecialchars(strip_tags($this->date_added));
        $this->content=htmlspecialchars(strip_tags($this->content));
        $this->short_description=htmlspecialchars(strip_tags($this->short_description));
        $this->picture=htmlspecialchars(strip_tags($this->picture));
        $this->picture_source=htmlspecialchars(strip_tags($this->picture_source));
    
        // bind values
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":date_added", $this->date_added);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":short_description", $this->short_description);
        $stmt->bindParam(":picture", $this->picture);
        $stmt->bindParam(":picture_source", $this->picture_source);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

    // delete the army
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
}