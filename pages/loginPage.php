<?php
    session_start();
    if (isset ($_SESSION['id'])) {
        header('location:homePage.php');
    }
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
   
            <form method="post" class="form-group" id="myForm">
                <label for="username" class="mt-2"> Username: </label>
                <input type="text" class="form-control mt-2" id="username" name="username" required="true">                
                <label for="password" class="mt-2"> Password: </label>
                <input type="password" class="form-control mt-1" id="password" name="password" required="true">
                <input type="submit" id="login" value="Login" class="btn btn-primary mt-2">
            </form>
            <p class="text-info" id="msg" style='text-align: center'></p>
        </div>

  
        <script type="text/javascript">
        
        $(document).ready(function () {
          $('#myForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "../requests/loginRequest.php",
                dataType: "json",
                data: $("#myForm").serialize(),
                success: function (data) {
                    if (data) {
                        if (data.success) {
                            window.location.href = "homePage.php";
                        }
                        else {
                            document.getElementById("msg").innerHTML = "Could not log you in. Please try again.";
                        }                    
                    }
                }
            })
            })
        })

        </script>
        
    
    </body>
</html>