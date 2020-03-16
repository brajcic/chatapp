<?php

    require_once '../classes/homeController.php';
    $object = new HomeController();
    
    $sid = $_POST['sender'];
    $rid = $_POST['receiver'];
    
    /*
     if user clicked on sc (send chat), we're inserting a new message
     else we are only displaying chatlogs
    */
    if (isset ($_POST['sc'])) {
        $object->insertMessage($sid, $rid, $_POST['msg']);
        $data = json_decode($object->showChatMsg($sid, $rid), true);

        $result = "<ul class='list-unstyled'>";

        foreach ($data as $item) {
            $name = '';
            if ($item['sender_id'] == $sid) {
                $name = "<b> You </b>";
            }
            else {
                /*
                 finds username for chat modal 
                */
                $rname = json_decode($object->findUsername($item['sender_id']), true);
                $name = "<b class='text-danger'>".$rname."</b>";
            }
            $result .= "<li style='border-bottom: 1px black'>";
            $result .= "<p>".$name." - ".$item['message']."</p></li>";
        }

        $result .= "</ul>";
        echo $result;
    }
    else {
       $data = json_decode($object->showChatMsg($_POST['sender'], $_POST['receiver']), true);

        $result = "<ul class='list-unstyled'>";

        foreach ($data as $item) {
            $name = '';
            if ($item['sender_id'] == $sid) {
                $name = "<b> You </b>";
            }
            else {
                /*
                 finds username for chat modal 
                */
                $rname = json_decode($object->findUsername($item['sender_id']), true);
                $name = "<b class='text-danger'>".$rname."</b>";
            }
            $result .= "<li style='border-bottom: 1px black'>";
            $result .= "<p>".$name." - ".$item['message']."</p></li>";
        }

        $result .= "</ul>";
        echo $result;
    }
   