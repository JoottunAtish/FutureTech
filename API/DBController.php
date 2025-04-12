<?php
class DBController{
    private $servername = "localhost";
    private $username = "admin";
    private $password = "admin";
    private $conn = null;

    function __construct(){
        try
        {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=futuretech", $this->username, $this->password);
        }
        catch(PDOException $e)
        {
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConn(){
        return $this->conn;
    }

    function executeSelectQuery($sql, $params = []) {
        $conn = $this->getConn();
        if ($conn == null){
            return [];
        }
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
}

?>