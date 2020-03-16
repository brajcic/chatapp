<?php
require_once 'user.php';
require_once '../config/config.php';
require_once 'controller.php';

class RegisterController  extends Controller {
    
    private $db;
    
    public function __construct() {
       $this->db = new Database();
    }
    
    public function usernameExists($username) {
        $sql = "SELECT COUNT(*) as total_rows FROM users WHERE username = '$username'";
        $sqlData = $this->db->query($sql);
        $arrayData = $sqlData->fetch(PDO::FETCH_ASSOC);
       
        return $arrayData['total_rows'];
    }
    
    public function register($username, $password, $name) {
            $sql = "INSERT INTO users(username, password, name) VALUES('$username', '$password', '$name')";
            $this->db->exec($sql);
    }
    
    public function passwordsMatch($password, $confirm) {
         if (!strcmp($password, $confirm)) {
            return true;
        }
        return false;
    }
    
 
    
}