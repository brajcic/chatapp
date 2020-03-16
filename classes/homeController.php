<?php
require_once '../config/config.php';
require_once 'controller.php';

class HomeController extends Controller {
    
    private $db;
    
    public function __construct() {
       $this->db = new Database();
    }
    
    public function showUsers($id) {
        $sql = "SELECT id, username, name FROM users WHERE id != $id";
        $sqlData = $this->db->query($sql);
        $arrayData = $sqlData->fetchAll(PDO::FETCH_ASSOC);
        
        return json_encode($arrayData);
    }
    
    public function showChatMsg($sid, $rid) {
        $sql = "SELECT sender_id, receiver_id, message FROM private_chat WHERE (sender_id = $sid and receiver_id = $rid) OR (sender_id = $rid and receiver_id = $sid)";
        $sqlData = $this->db->query($sql);
        $dataArray = $sqlData->fetchAll(PDO::FETCH_ASSOC);
        
        return json_encode($dataArray);
        
    }
    public function findUsername($id) {
        $sql = "SELECT username FROM users WHERE id = $id";
        $sqlData = $this->db->query($sql);
        $dataArray = $sqlData->fetch(PDO::FETCH_ASSOC);
        
        return json_encode($dataArray['username']);
    }
    
    public function insertMessage($sid, $rid, $msg) {
        $sql = "INSERT INTO private_chat(sender_id, receiver_id, message) VALUES($sid, $rid, '$msg')";
        $this->db->exec($sql);
    }
    
}