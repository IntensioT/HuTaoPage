<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/contacts_style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Roboto:wght@300;400;500;700&display=swap"
          rel="stylesheet">
    <title>Приложение</title>

    <style>
        h2, p{
            text-align:center;
        }
    </style>
</head>
<body>

<main>
    <section>
        <h2>Приложение для выкачивания изображений</h2>
        <div class="container">
            <div class="main-block">
                <div class="contact-form">
                    <form method="post">
                        <div class="form-inner">
                            <label for="url"><b>URL</b></label>
                            <input type="text" placeholder="Введите URL" name="url" value="" required>
                            <button type="submit" name="btn" class="send-button">Скачать</button>
                        </div>
                    </form>
                </div>
            </div>
    </section>



<?php

if (isset($_POST) && isset($_POST["btn"]))
{
    if (isset($_POST["url"]))
    {
        $url = $_POST["url"];
    }

    $pattern = '/^((https?|ftp)\:\/\/)?([a-z0-9]{1})((\.[a-z0-9-])|([a-z0-9-]))*\.([a-z]{2,6})(\/?)$/';
    if (true) //preg_match($pattern, $url)
    {
        $path = "/var/www/Labs/Lab7/Task2/download";

        $external = true;

        $html = file_get_contents($url);
        preg_match_all('/<img.*?src=["\'](.*?)["\'].*?>/i', $html, $images, PREG_SET_ORDER);

        echo "<p>count of images ".count($images)."</p>";
        $url = parse_url($url);
        $path = rtrim($path, '/');

        foreach ($images as $image) {
            

            $ext = strtolower(substr(strrchr($image[1], '.'), 1));
            //echo "<p>".$ext."</p>";
            if (in_array($ext, array('jpg', 'jpeg', 'png', 'gif'))) {
                $img = parse_url($image[1]);

                // Если файл уже существует
                if (is_file($path . $img['path'])) {
                    continue;
                }

                $path_img = $path . dirname($img['path']);
                //echo "<p>".$path_img."</p>";
                if (!file_exists($path_img)) {
                    //echo "<p>not exist ".$path_img."</p>";
                    mkdir($path_img,0777,true);
                }

                if (empty($img['host']) && !empty($img['path'])) {
                    copy($url['scheme'] . '://' . $url['host'] . $img['path'], $path . $img['path']);
                } elseif ($external || ($external == false && $img['host'] == $url['host'])) {
                    copy($image[1], $path . $img['path']);
                }
            }
        }
    }
    else
    {
        echo "<p>Incorrect URL: ", $url, "<br></p>";
    }
}?>

</main>
</body>
</html>