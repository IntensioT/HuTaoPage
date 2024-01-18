<?php
require_once __DIR__ . '/authentificationSystem/boot.php';

$stmt = pdo()->prepare("SELECT * FROM `header` ORDER BY `header`.`id`");
$stmt->execute();

$elements = array();

// Запись данных в массив
while ($row = $stmt->fetch()) {
    array_push($elements, $row["element"]);
}
$lang = isset($_GET["lang"]) ? $_GET["lang"] : "ru"; //Берём значение GET-параметра, либо, если его нет, то устанавливаем русский
$array = parse_ini_file("lang/" . $lang . ".ini"); //Открываем соответствующий языковой файл

?>

<!DOCTYPE html>


<html>

<head>
    <title>Header</title>
    <link rel="stylesheet" href="/html/Web/style.css">
</head>

<body>


    <div class='header-line'>
        <div class='nav2'>
            <a class='nav-item' href='?lang=ru'>ru </a>
            <a class='nav-item' href='?lang=en'>en</a>
        </div>

        <div class='header-logo'>
            <img src="/html/Web/assets/logo.png" width="60" height="60" alt="">
        </div>

        <div class='nav'>
            <a class='nav-item' href="/html/Web/index.php?lang=<?php echo $lang?>">
                <?php echo $array[$elements[0]]; ?>
            </a>
            <a class='nav-item' href="/html/Web/heroes.php?lang=<?php echo $lang?>">
                <?php echo $array[$elements[1]]; ?>
            </a>
            <a class='nav-item' href="/html/Web/feedback.php?lang=<?php echo $lang?>">
                <?php echo $array[$elements[2]]; ?>
            </a>

        </div>

        <div class='cart'>
            <a href="#">
                <img class='cart-img' src="/html/Web/assets/cart.png" alt="">
            </a>
        </div>

        <div class='tg'>
            <div class='tg-holder'>
                <div class='tg-img'>
                    <img src="/html/Web/assets/tg.png" width="15" height="15" alt="">
                </div>

                <div class='number'><a class='num' href='#'>@intensioT</a></div>
            </div>

        </div>

        <div class='btn'>
            <a class='button' href="/html/Web/authentificationSystem/auth.php?lang=<?php echo $lang?>">
                <?php echo $array[$elements[3]]; ?>
            </a>
        </div>

        <div class='white-menu'>

            <button id='white'>
                <img width="50" height="50" src="/html/Web/assets/smallmenu.jpg" alt="">
            </button>

            <div id='menu' class='white-slide disp'>
                <a class='nav-item block' href="/html/Web/index.php?lang=<?php echo $lang?>">
                    <?php echo $array[$elements[0]]; ?>
                </a>
                <a class='nav-item block' href="/html/Web/heroes.php?lang=<?php echo $lang?>">
                    <?php echo $array[$elements[1]]; ?>
                </a>
                <a class='nav-item block' href="/html/Web/feedback.php?lang=<?php echo $lang?>">
                    <?php echo $array[$elements[2]]; ?>
                </a>

            </div>

        </div>

    </div>

</body>

</html>