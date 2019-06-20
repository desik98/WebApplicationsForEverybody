<!DOCTYPE html>
<head>
    <title>
        Mandava Desik MD5
    </title>
</head>
<body style="font-family: sans-serif">
    <h1>
        MD5 cracker
    </h1>
    <p>
        This application takes an MD5 hash
        of a four digit pin and check all 10,000
        possible four digit PINs to determine the PIN.
    </p>
    <p>
        <?php
            function numberToFourtotalDigitstring($number) {
                $totalDigits = 0;
                
                $totalDigitsCalculationNumber = $number;
                $number = $number . "";
                
                if ($number == 0) {
                    return "0000";
                  }
                
                while ($totalDigitsCalculationNumber != 0) {
                    $totalDigits++;
                    $totalDigitsCalculationNumber = (int) ($totalDigitsCalculationNumber / 10);
                  }
                
                for ($digit = 0; $digit < 4 - $totalDigits; $digit++) {
                    $number = "0" . $number; 
                  }
                
                return $number;
            }

            if (!isset($_GET['md5'])) {
                echo nl2br("Debug Output:\n"); 
                echo nl2br("PIN: Not found\n");
            } else {
                echo nl2br("Debug Output:\n"); 
            
                for ($number = 0; $number < 15; $number++) {
                    $fourDigitStringNumber = numberToFourtotalDigitstring($number);
                    $hashedValue = hash('md5', $fourDigitStringNumber);
                    
                    echo nl2br("$hashedValue $fourDigitStringNumber\n");
                }
                
                $starttime = microtime(true);   
                $hashFound = false;
                $pin = 0;
                for ($number = 0; $number < 10000; $number++) {
                    $fourDigitStringNumber = numberToFourtotalDigitstring($number);
                    $hashedValue = hash('md5', $fourDigitStringNumber);
                
                    if ($hashedValue == $_GET['md5']) {
                        $hashFound = true;
                        $pin = $fourDigitStringNumber;
                    }
                }
                echo nl2br("Total checks: 10000\n");

                $endtime = microtime(true); 
                $timediff = $endtime - $starttime;
                echo nl2br("Elapsed time: $timediff\n");  
            
                if ($hashFound == false) {
                    echo nl2br("\nPIN: Not Found\n");
                } else {
                    echo nl2br("\nPIN: $pin\n");        
                }
            }
        ?>
    </p>
    
    <form>
        <input type="text" name="md5" size="50" value="<?php print $_GET['md5'];?>"/>
        <input type="submit" value="Crack MD5"/>
    </form>
</body>
</html>

