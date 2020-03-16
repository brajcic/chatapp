<?php
    require_once '../classes/homeController.php';
    $object = new HomeController();

    /*
     homeRequest is used to display user table when somebody logs in
     showUsers returns all users with id != id logged user
    */
    $data = json_decode($object->showUsers($_POST['id']), true);

    $table = "<table class='table table-hover'>";
    $table .= "<tr><th> Username </th><th> Name </th><th> Chat </th></tr>";
    
        foreach ($data as $item) {
            $table .= "<tr><td>".$item['username']."</td><td>";
            $table .= $item['name']."</td><td>";
            $table .= "<button type='button' data-torid='".$item['id']."' data-torname='".$item['name']."' class='btn btn-primary sc' > Start chat </td></tr>";
        }
    $table .= "</table>";
    echo $table;