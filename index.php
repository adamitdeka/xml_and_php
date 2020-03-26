<?php
    //user authentication and deciding whether the user is a client or an admin
    $username = "";
    $password = "";
    $errorMsg = "";

    if(isset($_POST['login'])){
        $users = simplexml_load_file("xml/users.xml"); 
        $i = 0;
        $result = true;
        $endOfArray = 0;
        $username = $_POST['loginBox_username'];
        $password = $_POST['loginBox_password']; 
        while($result){
            $result = $users->user[$i]->username != $username || $users->user[$i]->password != $password;
            if($result == true){
                if($i < sizeof($users)-1){
                    $i = $i+1;
                }
                else{
                    $endOfArray = 1;
                    $result = false;
                }
            }
        }
        
        if($endOfArray == 1){
            $errorMsg = "Wrong username and password";
        }
        else{
            session_start();
            $_SESSION['userid'] = (string)$users->user[$i]['id'];
            if($users->user[$i]['type'] == 'client'){
                header("Location: client.php"); 
            }
            else{
                header("Location: staff.php");
            }
        }

        
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Login page</title>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <h1>Login Page</h1>
        <form class="formBox" name="loginForm" method="post">
            <fieldset class="formBox_fieldset">
                <legend>User Authentication</legend>
                <div class="loginBox">
                    <label for="loginBox_username" class="loginBox_label">Username:</label>
                    <input type="text" id="loginBox_username" name="loginBox_username" class="loginBox_text">
                </div>
                <div class="loginBox">
                    <label for="loginBox_password" class="loginBox_label">Password:</label>
                    <input type="password" id="loginBox_password" name="loginBox_password" class="loginBox_text">
                </div>
                <button type="submit" class="loginBox_submit" name="login">Log in</button>
            </fieldset>
            <div class="error_field">
                <?php
                    if($errorMsg){
                        echo ($errorMsg);
                    }
                ?>
            </div>
        </form>
    </body>
</html>