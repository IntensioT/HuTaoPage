<?php
echo 'Parameters ' . htmlspecialchars($_GET["params"]) . "<br>";

        $params = $_GET["params"];
        $lines = explode(",", $params);
        foreach ($lines as $line) {
          $line = trim($line);
          if (is_numeric($line)) {
            if (strpos($line, ".") !== false) {
              echo $line . " is a fractional number.<br>";
            } else {
              echo $line . " is an integer.<br>";
            }
          } else {
            echo $line . " is a string.<br>";
          }
        }
      

?>
