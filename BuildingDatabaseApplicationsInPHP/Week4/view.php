<?php
    session_start();
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'jaiwanth', 'jaiwanth_1');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<?php
    if (!isset($_SESSION['name'])) {
        die("Name parameter missing");
    }

    $stmt = $pdo->query("SELECT make, year, mileage 
                         FROM autos");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            
            <div style="color: green;"> 
                <?php 
                    echo $_SESSION['successfulInsertion'];
                    unset($_SESSION['successfulInsertion']);
                ?>    
            </div>

            <h2>Automobiles</h2>
            <ul>
                <?php 
                    foreach ($rows as $row) { 
                        $rowString = "<li>" . $row['year'] . " " . $row['make'] . " / " . $row['mileage'] . "</li>";
                        echo "$rowString";
                    }
                ?>
            </ul>

            <p>
                <a href="add.php">Add New</a>
                <a href="logout.php">Logout</a>
            </p>
        </div>
        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    </body>
</html>
