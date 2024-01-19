<!DOCTYPE html>
<html>
<head>
 <title>Приложение для выкачивания изображений</title>
</head>
<body>
 <form method="POST">
  <label for="url">Введите URL:</label>
  <input type="text" name="url" id="url">
  <label for="directory">Введите путь к каталогу:</label>
  <input type="text" name="directory" id="directory">
  <button type="submit" name="submit">Скачать изображения</button>
 </form>

 <?php
 if(isset($_POST['submit'])) {
  $url = $_POST['url'];
  $directory = $_POST['directory'];

  if(!is_dir($directory)) {
   echo "Указанный каталог не существует!";
   exit();
  }

  if(!filter_var($url, FILTER_VALIDATE_URL)) {
   echo "Указан некорректный URL!";
   exit();
  }

  $html = file_get_contents($url);

  preg_match_all('/<img[^>]+>/i',$html, $images);

  foreach ($images[0] as $img) {
   preg_match('/src="([^"]+)/i',$img, $src);
   if(isset($src[1])) {
    $image_url = $src[1];
}
//    $image_url = $src[1];

   if(filter_var($image_url, FILTER_VALIDATE_URL)) {
    $image_name = basename($image_url);
    copy($image_url, $directory . '/' . $image_name);
   }
  }

  echo "Изображения успешно загружены в указанный каталог!";
 }
 ?>
</body>
</html>
