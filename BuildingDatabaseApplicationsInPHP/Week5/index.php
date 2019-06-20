<?php
    session_start();

    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'jaiwanth', 'jaiwanth_1');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

    $stmt = $pdo->query('SELECT auto_id, make, model, year, mileage
                        FROM autos');
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
    <head>
        <title>Mandava Desik's Index Page</title>

        <link rel="stylesheet" 
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
            integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" 
            crossorigin="anonymous">

        <link rel="stylesheet" 
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
            integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" 
            crossorigin="anonymous">

        <link rel="stylesheet" 
            href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css">

        <script
        src="https://code.jquery.com/jquery-3.2.1.js"
        integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous"></script>

        <script
        src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
        integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
        crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="container">
            <h2>Welcome to the Automobiles Database</h2>

            <?php 
                if (!$_SESSION['login']) {
                    echo '
                    <p><a href="login.php">Please log in</a></p>
                    <p>Attempt to <a href="add.php">add data</a> without logging in</p>';

                    exit();
                }
            ?>
            
            <div style="color: red;"> 
                <?php 
                    echo $_SESSION["errors"];
                    unset($_SESSION["errors"]);
                ?>    
            </div>

            <div style="color: green;"> 
                <?php 
                    echo $_SESSION["success"];
                    unset($_SESSION["success"]);
                ?>    
            </div>

            <?php 
                if ($rows == false) {
                    echo "<p>No rows found</p>";
                } else {
                    echo "<table border='1'>
                                <thead>
                                <tr>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Year</th>
                                    <th>Mileage</th>
                                    <th>Action</th>
                                </tr>
                                </thead>";

                    foreach ($rows as $row) {
                        echo "<tr><td>";
                        echo(htmlentities($row['make']));
                        echo("</td><td>");
                        echo(htmlentities($row['model']));
                        echo("</td><td>");
                        echo(htmlentities($row['year']));
                        echo("</td><td>");
                        echo(htmlentities($row['mileage']));
                        echo("</td><td>");
                        echo('<a href="edit.php?autos_id='.$row['auto_id'].'">Edit</a> / ');
                        echo('<a href="delete.php?autos_id='.$row['auto_id'].'">Delete</a>');
                        echo("</td></tr>\n");
                    }
                    echo "</table>";
                }
            ?>

            <p>
                <a href="add.php">Add New Entry</a>
            </p>
            
            <p>
                <a href="logout.php">Logout</a>
            </p>
            
            <p>
                <b>Note:</b> Your implementation should retain data across multiple 
                logout/login sessions.  This sample implementation clears all its
                data on logout - which you should not do in your implementation.
            </p>
        </div>
    </body>
</html>