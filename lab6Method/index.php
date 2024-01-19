<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Форма настройки стилей страницы</title>
  </head>
  <body>
    <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        setcookie('background-color', $_POST['background-color'], time() + (86400 * 30), '/');
        setcookie('font-size', $_POST['font-size'], time() + (86400 * 30), '/');
        setcookie('font-color', $_POST['font-color'], time() + (86400 * 30), '/');
        setcookie('header-color', $_POST['header-color'], time() + (86400 * 30), '/');
      }
      if (isset($_COOKIE['background-color'])) {
        echo "<style>body {background-color: ".$_COOKIE['background-color'].";}</style>";
      }
      if (isset($_COOKIE['font-size'])) {
        echo "<style>body {font-size: ".$_COOKIE['font-size'].";}</style>";
      }
      if (isset($_COOKIE['font-color'])) {
        echo "<style>body {color: ".$_COOKIE['font-color'].";}</style>";
      }
      if (isset($_COOKIE['header-color'])) {
        echo "<style>h1 {color: ".$_COOKIE['header-color'].";}</style>";
      }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for="background-color">Цвет фона страницы:</label>
      <input type="color" id="background-color" name="background-color"><br><br>
      <label for="font-size">Размер основного шрифта:</label>
      <select id="font-size" name="font-size">
        <option value="12px">12px</option>
        <option value="14px">14px</option>
        <option value="16px">16px</option>
        <option value="18px">18px</option>
      </select><br><br>
      <label for="font-color">Цвет основного шрифта:</label>
      <input type="color" id="font-color" name="font-color"><br><br>
      <label for="header-color">Цвет заголовка:</label>
      <input type="color" id="header-color" name="header-color"><br><br>
      <input type="submit" value="Сохранить">
    </form>

    <?php
    echo "<h1>Пример заголовка</h1>";
    echo "<p>Пример текста</p>";
    ?>
  </body>
</html>