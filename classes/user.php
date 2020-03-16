<?php

class User {
    
    private $username;
    private $password;
    private $name;
    
    function __construct($username, $password, $name) {
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;
    }
   
    public function getUsername() {
        return $this->username;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function setUsername($username) {
        $this->username = $username;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
    
    
}