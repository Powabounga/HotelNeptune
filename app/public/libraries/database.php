<?php

class Database {
    private $host = 'mysql';
    private $user = 'tutorial';
    private $pass = 'secret';
    private $dbname = 'tutorial';

    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
        //Set DSN
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        //Create PDO instance
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
    ');';
    }

    // public function connect() {
    //     try {
    //         $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name, $this->user, $this->pass);
    //         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //         return $conn;
    //     } catch(PDOException $e) {
    //         echo $e->getMessage();
    //         echo $this->error;
    //     }
    // }

    //Prepare statement with query
    public function query($sql) {
        $this->console_log($sql);
        $this->stmt = $this->dbh->prepare($sql);
    }
    
    //Bind values to prepared statement using named values
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    //Execute the prepared statement
    public function execute(){
        return $this->stmt->execute();
    }

    public function fetchColumn(){
        $this->stmt->execute();
        return $this->stmt->fetchColumn();
    }

    //Return multiple records
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //Return a single record
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //Get row count
    public function rowCount(){
        return $this->stmt->rowCount();
    }
}