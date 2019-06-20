<?php
    session_start();
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'jaiwanth', 'jaiwanth_1');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

    if (!isset($_SESSION['login'])) {
        die("ACCESS DENIED");
    } else if (isset($_POST['cancel'])) {
        header('Location: index.php');
        return ;
    } else {
        $stmt = $pdo->prepare('SELECT make, model, year, mileage
                               FROM autos  
                               WHERE auto_id = :auto_id');
        $stmt->execute(array(':auto_id' => $_GET['autos_id']));
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($rows == false) {
            $_SESSION['errors'] = "Bad value for id";
            header("Location: index.php");
            return ;
        } else {
            if (isset($_POST['make']) and isset($_POST['model']) and isset($_POST['year']) and isset($_POST['mileage'])) {
                $mk = $_POST['make'];
                $md = $_POST['model'];
                $yr = $_POST['year'];
                $mil = $_POST['mileage'];

                if ($mk == "" or $md == "" or $yr == "" or $mil == "") {
                    $_SESSION['errors'] = "All fields are required"; 
                    header("Location: edit.php?autos_id=" . $_GET['autos_id']);
                    return ;
                } else {
                    if (!is_numeric($yr)) {
                        $_SESSION['errors'] = "Year must be numeric";
                        header("Location: edit.php?autos_id=" . $_GET['autos_id']);
                        return ;
                    } else if (!is_numeric($mil)) {
                        $_SESSION['errors'] = "Mileage must be numeric";
                        header("Location: edit.php?autos_id=" . $_GET['autos_id']);
                        return ;
                    } else {
                        $stmt = $pdo->prepare('UPDATE autos
                                            SET make = :mk, model = :md, year = :yr, mileage = :mi
                                            WHERE auto_id = :auto_id');
                        $stmt->execute(array(':mk' => $mk,
                                            ':md' => $md,
                                            ':yr' => $yr,
                                            ':mi' => $mil,
                                            ':auto_id' => $_GET["autos_id"])
                                            );
                                            
                        header("Location: index.php");
                        return ;
                    }
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Mandava Desik's Automobile Tracker</title>

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
            <h1>Tracking Automobiles for 
                <?php
                    $email = htmlentities($_SESSION['email']); 
                    echo($email); 
                ?> 
            </h1>

            <div style="color: red;"> 
                <?php 
                    echo $_SESSION['errors'];
                    unset($_SESSION['errors'])
                ?>    
            </div>

            <?php echo($mk); ?>
            
            <form method="post">
                <p>
                    Make: <input type="text" name="make" size="40" value = "<?php echo($rows['make']); ?>" />
                </p>
                
                <p>
                    Model: <input type="text" name="model" size="40" value = "<?php echo($rows['model']); ?>"/>
                </p>
                
                <p>
                    Year: <input type="text" name="year" size="10" value = "<?php echo($rows['year']); ?>"/>
                </p>
                
                <p>
                    Mileage: <input type="text" name="mileage" size="10" value = "<?php echo($rows['mileage']); ?>"/>
                </p>

                <input type="submit" value="Save">
                <input type="submit" name="cancel" value="Cancel">
            </form>
        </div>
        
        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    </body>
</html>
