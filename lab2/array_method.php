<!DOCTYPE html>
<html>
<head>
	<style>
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
			padding: 5px;
		}
	</style>
</head>
<body>
	<h2>Result</h2>

	<?php
		// Get the data 
		$data = $_POST["data"];

		
		$array = explode(",", $data);

		// Remove all integers
		foreach ($array as $key => $value) {
			if (is_numeric($value) && intval($value) == $value) {
				unset($array[$key]);
			}
		}

		// Round fractions
		foreach ($array as $key => $value) {
			if (is_numeric($value) && floatval($value) != intval($value)) {
				$array[$key] = round($value, 2);
			}
		}

		// Convert all text elements to uppercase
		foreach ($array as $key => $value) {
			if (!is_numeric($value)) {
				$array[$key] = strtoupper($value);
			}
		}

		// Sort the array in ascending order in string mode
		sort($array, SORT_STRING);
		sort($array, SORT_STRING);

		// Display the source and received arrays in tabular form
		echo "<h3>Source Array:</h3>";
		echo "<table>";
		foreach (explode(",", $data) as $value) {
			echo "<tr><td>$value</td></tr>";
		}
		echo "</table>";

		echo "<h3>Received Array:</h3>";
		echo "<table>";
		foreach ($array as $value) {
			echo "<tr><td>$value</td></tr>";
		}
		echo "</table>";
	?>

</body>
</html>
