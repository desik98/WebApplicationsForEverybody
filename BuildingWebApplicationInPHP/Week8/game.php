<?php
    function check($computer, $human) {
        if ($computer == "0" and $human == "1") {
            return "You Win";
        } else if ($computer == "1" and $human == "2") {
            return "You Win";
        } else if ($computer == "2" and $human == "0") {
            return "You Win";
        }
        
        if ($computer == $human) {
            return "Tie";
        }

        return "You Lose";
    }

    $message = "";
    $names = ["Rock", "Paper", "Scissors"];
    
    $parameter = $_GET['who'];

    if (!isset($parameter)) {
        die("Name parameter missing");
    } else {
        if (!isset($_POST['human']) or $_POST['human'] == "-1") {
            $message = "Please select a strategy and press Play.";
        } else if ($_POST['human'] == "0") {
            $message = "Your Play=Rock Computer Play=Paper Result=You Lose";
        } else if ($_POST['human'] == "1") {
            $message = "Your Play=Paper Computer Play=Paper Result=Tie";
        } else if ($_POST['human'] == "2") {
            $message = "Your Play=Scissors Computer Play=Paper Result=You Lose";
        } else {
            for($c=0;$c<3;$c++) {
                for($h=0;$h<3;$h++) {
                    $r = check($c, $h);
        
                    $message = $message . "Human=$names[$h] Computer=$names[$c] Result=$r \n";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Mandava Desik's Rock, Paper, Scissors Game</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

        <!-- Custom styles for this template -->
        <link href="starter-template.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">        
            <h1>Rock Paper Scissors</h1>
            <p> Welcome: <?php 
                    $parameter = trim($parameter,'"');
                    echo "$parameter"; 
                ?>
            </p>

            <form method="post">
                <select name="human">
                    <option value="-1">Select</option>
                    <option value="0">Rock</option>
                    <option value="1">Paper</option>
                    <option value="2">Scissors</option>
                    <option value="3">Test</option>
                </select>
            
                <input type="submit" name="Play" value="Play">
                <input type="submit" onclick="location.href='index.php'; return false;" value="Logout">
            </form>

            <pre>
            <?php echo "$message";
            ?>
            </pre>
        </div>
    </body>
</html>
