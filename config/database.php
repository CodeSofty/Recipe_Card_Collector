<?php 


class Database {
    // //DB Params
    // private $host = 'us-cdbr-east-06.cleardb.net';
    // private $db_name = 'heroku_ae9138c33b4413d';
    // private $username = 'b8aa0663acecb1';
    // private $pass =  'a7faeb32';
    // private $conn;

        //DB Params
        private $host = 'crud-database-do-user-13269986-0.b.db.ondigitalocean.com';
        private $db_name = 'defaultdb';
        private $username = 'doadmin';
        private $pass =  'AVNS_o0g1qS2iFRLoy9UbqPd';
        private $port = '8080';
        private $conn;
    

    //DB Connect
    public function connect()
        {
        $this->conn = null;

        try
    {
        $this->conn = new PDO('mysql:host=' . $this->host . ';port=' . $this-port . ';dbname=' . $this->db_name,
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