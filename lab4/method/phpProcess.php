<?php
    $name = isset($_POST['name']) ? ($_POST['name']) : 0;
    $email = isset($_POST['email']) ? ($_POST['email']) : 0;


    $filename = 'emails.txt';
    

    if ($name <= 0){
        echo "<p>Please enter a valid name.</p>";
    } else {
        echo "<h2>Your mail is:</h2>";
        if (validateEmail($email)) {
            echo "CORRECT";
            $file = fopen($filename, 'a');
            fwrite($file, "$name <$email>\n");
            fclose($file);
        }
        else{
            echo "INCORRECT EMAIL";
        }
    }

    function validateEmail($email) {
        $pattern = '/^[^@\s]+@[^@\s]+\.[^@\s]+$/';
        return preg_match($pattern, $email);
    }
    ?>