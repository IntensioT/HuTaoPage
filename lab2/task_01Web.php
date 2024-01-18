<!DOCTYPE
<html>
  <body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <label for="params">Enter:</label>
      <br>
      <textarea name="params" id="params" rows="5" cols="50"></textarea>
      <br>
      <input type="show" value="Submit">
    </form>
    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $params = $_POST["params"];
        $lines = explode("\n", $params);
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
      }
    ?>
  </body>
</html>
