<?php
    session_start();
?>
<html>
    <head>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
            <?php
                require_once '../headers/header.php';
            ?>
        </div>
        
        <div class="container col-md-6 mt-5">
            <form class="form-group" method="post" id="rform">
                <label for="name"> Name: </label>
                <input type="text" class="form-control mb-2" name="name" id="name" required="true">
                <label for="username"> Username: </label>
                <input type="text" class="form-control mb-2" name="username" id="username" required="true">
                <label for="password"> Password: </label>
                <input type="password" class="form-control mb-2" name="password" id="password" required="true">
                <label for="confirm"> Confirm password: </label>
                <input type="password" class="form-control mb-3" name="confirm" id="confirm" required="true">
                <input type="submit" class="btn btn-primary" value="Register">
            </form>
            <p class="text-info" id="msg" style='text-align: center'></p>

        </div>
        
        
         <script type="text/javascript">
        
        $(document).ready(function () {
          $('#rform').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "../requests/registerRequest.php",
                dataType: "json",
                data: $("#rform").serialize(),
                success: function (data) {
                    if (data) {
                        if (data.success) {
                            document.getElementById("msg").innerHTML = "Successful registration!";
                        }
                        else {
                            document.getElementById("msg").innerHTML = "There was a problem with registration. Please try again.";
                        }                    
                    }
                }
                })
            })
        })

        </script>
        
        
        
    </body>
</html>