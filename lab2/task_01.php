
<?php
      
        $data = $argv;
        foreach ($data as $arg) {
      
          if (is_numeric($arg)) {
            if (strpos($arg, ".") !== false) {
              echo $arg . " --> fractional number.", "\n";
            } else {
              echo $arg . " --> integer.", "\n";
            }
          } else {
            echo $arg . " --> string.", "\n";
          }
        }
      
?>
