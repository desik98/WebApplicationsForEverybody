<?php
    session_start();
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'jaiwanth', 'jaiwanth_1');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

    if (!isset($_SESSION['name'])) {
        die("Name parameter missing");
    } else {
        if (isset($_POST['cancel'])) {
            header("Location: view.php");
            return ;
        }

        if (isset($_POST['make']) and isset($_POST['year']) and isset($_POST['mileage'])) {
            $mk = $_POST['make'];
            $yr = $_POST['year'];
            $mil = $_POST['mileage'];

            if (strlen($mk) == 0) {
                $_SESSION['error'] = "Make is required";
                header("Location: add.php");
                return ;
            } else if (!is_numeric($yr) or !is_numeric($mil)) {
                $_SESSION['error'] = "Mileage and year must be numeric";
                header("Location: add.php");
                return ;
            } else {
                $stmt = $pdo->prepare('INSERT INTO autos
                                        (make, year, mileage) VALUES ( :mk, :yr, :mi)');
                $stmt->execute(array(':mk' => $mk,
                                    ':yr' => $yr,
                                    ':mi' => $mil)
                                    );

                $_SESSION['successfulInsertion'] = "Record inserted";
                header("Location: view.php");
                return ;
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Mandava Desik's Automobile Tracker</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    </head>

    <body>
        <div class="container">
            <h1>
                Tracking Autos for 
                <?php 
                    $user = htmlentities($_SESSION['name']);
                    echo "$user";
                ?>
            </h1>

            <div style="color: red;"> 
                <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error'])
                ?>    
            </div>

            <form method="post">
                <p>
                    Make:
                    <input type="text" name="make" size="60"/>
                </p>
                
                <p>
                    Year:
                    <input type="text" name="year"/>
                </p>
                
                <p>
                    Mileage:
                    <input type="text" name="mileage"/>
                </p>

                <input type="submit" value="Add">
                <input type="submit" name="cancel" value="Cancel">
            </form>
        </div>
        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    </body>
</html>
