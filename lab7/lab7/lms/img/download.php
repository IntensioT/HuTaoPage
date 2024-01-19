<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $url = $_POST['url'];
    $html = file_get_contents($url);

    // Создаем объект DOM
    $dom = new DOMDocument();

    // Загружаем HTML-код страницы
    @$dom->loadHTML($html);

    // Находим все теги img на странице
    $images = $dom->getElementsByTagName('img');

    // Перебираем все найденные изображения
    foreach ($images as $image) {
        // Получаем URL изображения
        $src = $image->getAttribute('src');

        // Сохраняем изображение на сервере
        file_put_contents('/var/www/lab7/lab7/lms/saved' . basename($src), file_get_contents($src));
    }
}
?>
