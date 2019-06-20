<?php
    if (isset($_POST['cancel'])) {
        header("Location: index.php");
        return ;
    }

    $mistakes = "";

    if (isset($_POST['who']) and isset($_POST['pass'])) {
        $user = $_POST['who'];
        $pass = $_POST['pass'];
        $actualHash = hash('md5', "XyZzy12*_" . $pass);
        $expectedHash = "1a52e17fa899cf40fb04cfc42e6352f1";

        if ($user == "" or $pass == "") {
            $mistakes = "User name and password are required \n";
        } else if (strpos($user, '@') == false) {
            $mistakes = "Email must have an at-sign (@) \n";
        } else if ($actualHash != $expectedHash) {
            $mistakes = "Incorrect Password \n";
            error_log("Login fail " .$_POST['who']. $actualHash);
        } else {
            $user = htmlentities($user);
            error_log("Login success ".$_POST['who']);
            header("Location: autos.php?who=".urlencode($user));
            return ; 
        }
    } 
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

        <!-- Custom styles for this template -->
        <link href="starter-template.css" rel="stylesheet">

        <title>Mandava Desik's Login Page</title>
    </head>

    <body>
        <div class="container">
            <h1>Please Log In</h1>

            <div style="color: red;"> 
                <?php 
                    echo "$mistakes";
                ?>    
            </div>

            <form method="POST">
                <label for="nam">User Name</label>
                <input type="text" name="who" id="nam"/><br/>
                <label for="id_1723">Password</label>
                <input type="password" name="pass" id="id_1723"/><br/>
                <input type="submit" value="Log In">
                <input type="submit" onclick="location.href='index.php'; return false;"  name="cancel" value="Cancel">
            </form>

            <p>
                For a password hint, view source and find a password hint
                in the HTML comments.
                <!-- Hint: The password is the three character name of the 
                programming language used in this class (all lower case) 
                followed by 123. -->
            </p>
        </div>
    </body>
</html>