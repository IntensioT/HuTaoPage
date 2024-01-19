<!DOCTYPE html>
<html>

<head>
    <title>Список файлов</title>
</head>

<body>
    <h1>Список файлов в директории:</h1>
    <?php
    $dir = "./files"; // указываем директорию, в которой будем искать файлы
    $files = scandir($dir); // получаем список файлов в директории
    foreach ($files as $file) { // проходим по списку файлов

        if ($file != "." && $file != "..") { // пропускаем ссылки на текущую и родительскую директории
            echo "<a href='files/$file'>$file</a><br>"; // выводим ссылку на файл

            $fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            // Проверка существования файла и его типа
            if (file_exists("./files/$file") && $fileType ==="jpg") {
                echo "<img style='width:32px' src='./files/".$file."'><br>";
            } else {
                // Чтение содержимого файла
                $content = file_get_contents("./files/$file");

                // Извлечение первых нескольких символов
                $preview = substr($content, 0, 100);

                // Вывод превью текстового документа
                echo '<pre>' . htmlspecialchars($preview) . '</pre>';
            }
        }
    }
    ?>
</body>

</html>