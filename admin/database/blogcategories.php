<?php  
class blogcategories {
    private $conn;
    private $table = "blogcategories";

    public $id;
    public $title;
    public $status;
    public $created_at;
    public $updated_at;

    public function __construct($db){
        $this->conn = $db;
    }

    /*read all blogcategories*/
    public function readAll(){
        $sql = "SELECT * FROM $this->table";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    /*read blogcategory by id*/
    public function read(){
        $sql = "SELECT * FROM $this->table
                WHERE id = :get_id";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":get_id", $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->title = $row['title'];
            $this->status = $row['status'];
            $this->created_at = $row['created_at'];
            $this->updated_at = $row['updated_at'];
        } else {
            // Handle the case where no data was found
            $this->title = null;
            $this->status = null;
            $this->created_at = null;
            $this->updated_at = null;
        }
    }

    public function create(){
        $sql = "INSERT INTO $this->table
                SET title = :get_title,
                    status = 1,
                    created_at = :get_created_date,
                    updated_at = :get_updated_date";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":get_title", $this->title);
        $stmt->bindParam(":get_created_date", $this->created_at);
        $stmt->bindParam(":get_updated_date", $this->updated_at);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function update(){
        $sql = "UPDATE $this->table
                SET title = :get_title,
                    status = :get_status
                WHERE id = :get_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":get_id", $this->id);
        $stmt->bindParam(":get_title", $this->title);
        $stmt->bindParam(":get_status", $this->status);
        
        if($stmt->execute()){
            return true;
        }    
        return false;
    }

    public function delete(){
        $sql = "DELETE FROM $this->table
                WHERE id = :get_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":get_id", $this->id);
        
        if($stmt->execute()){
            return true;
        }
        return false;    
    }
}
?>
