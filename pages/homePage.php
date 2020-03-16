<?php
    session_start();
    if (!isset ($_SESSION['id'])) {
        header('location:loginPage.php');
    }
?>

<?php
    require_once '../classes/homeController.php';
    $object = new HomeController();
?>

<html>
    <head>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
       <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    </head>
    <body>
        
        <div class="container">
            <?php
                require_once '../headers/header.php';
            ?>
        </div>
        
        <input type="hidden" value="<?php echo $_SESSION['id'];?>" id="userId">
        
        <div class="container col-md-6 mt-5">
            <div id="userList"></div>
            
        </div>
        
        <script type="text/javascript">  
        
        $(document).ready(function () {
            showUsers();  
            setInterval(function(){
                showUsers();
                updateChatHistory();
            }, 1100);
            
            function showUsers() {
                var userId = $("#userId").val();
                $.ajax({
                     type: "POST",
                     url: "../requests/homeRequest.php",
                     dataType: "text",
                     data: {
                         id: userId,
                     },
                     success: function (data) {
                        document.getElementById("userList").innerHTML = data;
                     }
                 });
             }
     
            function chatDialog(rid, rname) {
                var modal = '<div id="user_dialog_'+rid+'" class="user_dialog" title="Chat with '+rname+'">';
                modal += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+rid+'" id="chat_history_'+rid+'">';
                modal += chat(rid);
                modal += '</div>';
                modal += '<div class="form-group">';
                modal += '<textarea name="chat_message_'+rid+'" id="chat_message_'+rid+'" class="form-control"></textarea>';
                modal += '</div><div class="form-group" align="right">';
                modal += '<button name="send_chat" id="'+rid+'" class="btn btn-info send_chat">Send</button></div></div>';
                $('#userList').html(modal);
            }
            
            $(document).on('click', '.sc', function() {
                var rid = $(this).data('torid');
                var rname = $(this).data('torname');
                chatDialog(rid, rname);
                $("#user_dialog_"+rid).dialog({
                 autoOpen: false,
                 width: 400
                });
                $('#user_dialog_'+rid).dialog('open');
            });

            $(document).on('click', '.send_chat', function() {
                    var sid = $("#userId").val();
                    var rid = $(this).attr('id');
                    var message = $('#chat_message_'+rid).val();
                    $.ajax({
                     type: "POST",
                     url: "../requests/chatRequest.php",
                     dataType: "text",
                     data: {
                         sc: 1,
                         sender: sid,
                         receiver: rid,
                         msg: message
                     },
                     success: function (data) {
                        $('#chat_message_'+rid).val('');
                        $('#chat_history_'+rid).html(data);
                     }
                 });    
               
            });
            
            function chat(receiverId)
            {
             var sid = $("#userId").val();
             $.ajax({
              url:"../requests/chatRequest.php",
              method:"POST",
              data:{
                  receiver: receiverId,
                  sender: sid
              },
              success:function(data){
                  $('#chat_history_'+receiverId).html(data);
                }
             })
            }
            
            function updateChatHistory() {
             $('.chat_history').each(function(){
              var to_user_id = $(this).data('touserid');
              chat(to_user_id);
             });
            }           
      });
  
        </script>
        
        
    </body>
</html>