<html>
<head>
<title>Mandava Desik PHP</title>
</head>
<body>
    <h1>Mandava Desik Request / Response</h1>
    <?php   
        $nameHash = hash('sha256', 'Mandava Desik');
        echo 'The SHA256 hash of "Mandava Desik" is';
        echo "\n $nameHash"; 
    ?>
    <pre>ASCII ART:
        *     *
        **   **
        * * * *
        *  *  *
        *     *
        *     *
    </pre>
    <a href="check.php">Click here to check the error setting</a>
    <br>
    <a href="fail.php">Click here to cause a traceback</a>
</body>
</html>