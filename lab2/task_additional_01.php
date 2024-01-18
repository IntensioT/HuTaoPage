<!DOCTYPE html>
<html>
<style>
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
			padding: 5px;
		}
</style>
<body>
  <h1>HTML Table</h1>

  <?php
  $numRows = isset($_POST['numRows']) ? intval($_POST['numRows']) : 0;

  if ($numRows <= 0) {
    echo "<p>Please enter a valid number of rows.</p>";
  } else {
    echo "<h2>Table:</h2>";
    echo generateTable($numRows);
  }

  function generateTable($numRows) {
    $html = "<table>";
    $html .= "<thead><tr><th>#</th></tr></thead>";
    $html .= "<tbody>";
    $myColor = (255 / $numRows);
    $colorNow = 0;
    
    for ($i = 1; $i <= $numRows; $i++) {
      $colorNow += $myColor;
      $html .= "<tr><td>$i</td><td style=\"background-color: rgb($colorNow,$colorNow,$colorNow)\" = >{background: navy;}</td></tr>";
    }
    $html .= "</tbody>";
    $html .= "</table>";
    return $html;
  }
  ?>

  <form method="post" action="">
    <label for="numRows">Number of Rows:</label>
    <input type="number" id="numRows" name="numRows" value="<?php echo $numRows; ?>">
    <button type="submit">Enter</button>
  </form>
</body>
</html>
