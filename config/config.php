<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'chat');

class Database {
    
    private $db;
    
    function __construct() {
        try{
            $string = "mysql:host=".DB_SERVER.";dbname=".DB_NAME;
            $this->db = new PDO($string, DB_USERNAME, DB_PASSWORD);
        } catch(PDOException $exc) {
            return json_encode(['success' => false, 'error' => $exc->getMessage()]);
        }
    }
    
    function __destruct() {
        $this->db = null;
    }
    
    public function query($query) {
        return $this->db->query($query);
    }
    
    public function exec($query) {
        $this->db->exec($query);
    }

    public function createDb() {
        
        $sqlU = "create table users(
                    id int PRIMARY KEY IDENTITY(1,1),
                    username varchar(255) NOT NULL,
                    password varchar(255) NOT NULL,
                    name varchar(255) NOT NULL
                )";
        
        $this->db->exec($sqlU);
        
        $sqlPC = "create table private_chat(
                    id int PRIMARY KEY IDENTITY(1,1),
                    sender_id int NOT NULL,
                    receiver_id int NOT NULL,
                    message varchar(255) NOT NULL
                 )";
        
        $this->db->exec($sqlPC);
    }
    
    public function insertUsers() {
        
        $pass1 = sha1('test123');
        $pass2 = sha1('john123');
        $pass3 = sha1('doe123');
        
        $sql1 = "INSERT INTO users(username, password, name) VALUES('test','$pass1', 'Test')";
        $sql2 = "INSERT INTO users(username, password, name) VALUES('john','$pass2', 'John')";
        $sql3 = "INSERT INTO users(username, password, name) VALUES('doe','$pass3', 'Doe')";
        
        $this->db->exec($sql1);
        $this->db->exec($sql2);
        $this->db->exec($sql3);
    } 
}

