<?php
    require_once '../classes/registerController.php';
    require_once '../classes/user.php';
    
    $object = new RegisterController();
    
    // checks if pass, uname or name are only spaces
    if ((!strlen(trim($_POST['password']))) || (!strlen(trim($_POST['username']))) || (!strlen(trim($_POST['name'])))) {
        echo json_encode(['success' => false]);
    } 
    else {
        
        /* 
         checking if uname exists in database, cant register new user with already taken uname
         returns 0 || 1 (not in db / in db)
        */
        $n = (int)$object->usernameExists($_POST['username']); 
        
        /*
         passwords should match
         true -> match ; false -> !match          
        */
        
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];
        
        $passCheck = $object->passwordsMatch($password, $confirm);
   
        /*
          original uname and pass match -> register, else return error
        */
        if (!$n && $passCheck) {
            /*
              create new user object and register
            */
            $hashedpw = sha1($password);
            $user = new User($_POST['username'], $hashedpw, $_POST['name']);
            $object->register($user->getUsername(), $user->getPassword(), $user->getName());
            echo json_encode(['success' => true]);
        }
        else {
            echo json_encode(['success' => false]);
        }       
    }
    