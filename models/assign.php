<?php 
  class Assign{
        
    private $conn;
    private $table = 'assigned-todo';

   public $assign;
    public $todo_id;
    public $user_id;
    public function __construct($db)
    {
        $this->conn = $db;
    }
public function assignUser()
    {
        Create query
        if (!empty($this->item)) {
            $query = 'UPDATE ' . $this->table . ' SET todo_id = todo_id+1 WHERE todoStatu = 1';

            // Prepare statement
            $stmtUpdate = $this->conn->prepare($query);

            // Execute query
            if ($stmtUpdate->execute()) {
            
                $query = 'INSERT INTO ' . $this->table . ' SET todo_id = :todo_id, user_id = :user_id';

                // Prepare statement
                $stmt = $this->conn->prepare($query);

                // Clean data
                $this->todo_id = filter_var(1, FILTER_SANITIZE_NUMBER_INT);
                $this->user_id = filter_var(1, FILTER_SANITIZE_NUMBER_INT);
              
                // Bind data
                $stmt->bindParam(':todo_id', $this->todo_id);
                $stmt->bindParam(':user_id', $this->user_id);
               
                if ($stmt->execute()) {
                    return true;
                }

        
              }

        return false;
    }
  }
?>