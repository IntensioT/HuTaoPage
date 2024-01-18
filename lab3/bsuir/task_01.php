<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<form method="get" action="">
		<label for="text">Введите текст:</label><br>
		<input type="text" name="text" id="text"><br>
		<input type="submit" value="Отправить">
	</form>

	<?php
		if (isset($_GET['text'])) {
			$text = $_GET['text'];
		
			$words = explode(' ', $text);
			sort($words);
			$words = array_unique($words);
			$count = 0;

			foreach ($words as $word) {
				
				echo $word, ' ';
			}
		}
	?>
</body>
</html>
