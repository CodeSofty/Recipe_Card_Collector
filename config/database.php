<?php 


class Database {
    //DB Params
    private $host = 'us-cdbr-east-06.cleardb.net';
    private $db_name = 'heroku_ae9138c33b4413d';
    private $username = 'b8aa0663acecb1';
    private $pass =  'a7faeb32';
    private $conn;
    

    //DB Connect
    public function connect()
        {
        $this->conn = null;

        try
    {
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
        $this->username, $this->pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
        catch(PDOException $e)
        {
            echo 'Connection Error: ' . $e->getMessage();
        }

    return $this->conn;
        }


}


?>