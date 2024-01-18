<!DOCTYPE html>
<html>
<head>
    <title>Footer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
  $lang = isset($_GET["lang"])? $_GET["lang"]: "ru"; //Берём значение GET-параметра, либо, если его нет, то устанавливаем русский
  $array = parse_ini_file("lang/".$lang.".ini"); //Открываем соответствующий языковой файл
?>
<div class='footer'>
    <!-- Лучшей девочке посвящается 2023 -->
    <?php echo $array["FOOTER"]; ?>
</div>
</body>
</html>