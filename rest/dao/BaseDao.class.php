<?php
class BaseDao{

    private $conn;
    private $table_name;


public function __construct($table_name){
    $this->table_name = $table_name;
    try {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $port = "3308"; // Change this to your specific port
        $schema = "flightdb";
    
        $this->conn = new PDO("mysql:host=$servername;port=$port;dbname=$schema", $username, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

/**
    * Method used to get all entities from database
    */
    public function get_all(){
        $stmt = $this->conn->prepare("SELECT * FROM  $this->table_name");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
    * Method used to get entity by id from database
    */
    public function get_by_id($id){
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE id=:id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll();
    }

    /**
    * Method used to get add entity to database
    * string $first_name: First name is the first name of the course
    */
    public function add($entity){
        $query = "INSERT INTO " . $this->table_name . " (";
        foreach($entity as $column => $value){
            $query.= $column . ', ';
        }
        $query = substr($query, 0, -2);
        $query.= ") VALUES (";
        foreach($entity as $column => $value){
            $query.= ":" . $column . ', ';
        }
        $query = substr($query, 0, -2);
        $query.= ")";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute($entity);
        $entity['id'] = $this->conn->lastInsertId();
        return $entity;
    }

    
    /**
    * Method used to update entity in database
    */
    public function update($entity, $id, $id_column = "id"){
        $query = "UPDATE " . $this->table_name . " SET ";
        foreach($entity as $column => $value){
            $query.= $column . "=:" . $column . ", ";
        }
        $query = substr($query, 0, -2);
        $query.= " WHERE ${id_column} = :id";
        $stmt = $this->conn->prepare($query);
        $entity['id'] = $id;
        $stmt->execute($entity);
        return $entity;
    }


    /**
    * Method used to delete entity from database
    */
    public function delete($id){
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE id = :id");
        $stmt->bindParam(':id', $id); #prevent SQL injection
        $stmt->execute();
    }

    public function search($departureLocation = null, $arrivalLocation = null, $departureDate = null, $arrivalDate = null){
        $query = "SELECT * FROM " . $this->table_name . " WHERE 1=1";
        $params = array();
    
        if ($departureLocation !== null) {
            $query .= " AND departureLocation = :departureLocation";
            $params['departureLocation'] = $departureLocation;
        }
        if ($arrivalLocation !== null) {
            $query .= " AND arrivalLocation = :arrivalLocation";
            $params['arrivalLocation'] = $arrivalLocation;
        }
        if ($departureDate !== null) {
            $query .= " AND departureDate = :departureDate";
            $params['departureDate'] = $departureDate;
        }
        if ($arrivalDate !== null) {
            $query .= " AND arrivalDate = :arrivalDate";
            $params['arrivalDate'] = $arrivalDate;
        }
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function login($email, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email AND password = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array('email' => $email, 'password' => $password));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // If user is found, return user data. Otherwise, return null.
        return $user ? $user : null;
    }
}
 ?>
 

