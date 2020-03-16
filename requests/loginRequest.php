<?php
    session_start();
?>
<?php
    require_once '../classes/loginController.php';
    $object = new LoginController();
    
    /*
      check if there's a user with sent credentials
    */
    
    $exists = $object->checkUser($_POST['username'], $_POST['password']);
    
    if ($exists) {
        // there is, start session, will use it for chat page
        $user = json_decode($exists, true);
        $_SESSION['id'] = $user[0]['id'];
        $_SESSION['name'] = $user[0]['name'];
        echo json_encode(['success' => true]);
    } 
   else {
       echo json_encode(['success' => false]);
   }
    
   
    
