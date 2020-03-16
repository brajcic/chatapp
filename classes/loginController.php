<?php
require_once 'user.php';
require_once '../config/config.php';
require_once 'controller.php';

class LoginController extends Controller {
    
    private $db;
    
    public function __construct() {
       $this->db = new Database();
    }
    
    public function checkUser($username, $npassword) {
        $password = sha1($npassword);
        $sql = "SELECT * FROM users WHERE username ='$username'";
        $sqlData = $this->db->query($sql);
        $arraySql = $sqlData->fetchAll(PDO::FETCH_ASSOC);   
        
        foreach ($arraySql as $item) {
            if ($item['password'] == $password) {
                return json_encode(array(['id' => $item['id'], 'name' => $item['name']]));
                }
            }
        return false;
        
        /*
         returns false if passwords dont match or array if user is found
        */
    }
           
}