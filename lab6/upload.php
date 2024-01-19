<!DOCTYPE html>
<html>
<head>
 <title>Загрузка файлов</title>
</head>
<body>
 <h1>Загрузка файлов:</h1>
 <form action="upload.php" method="POST" enctype="multipart/form-data">
  <input type="file" name="file"><br><br>
  <input type="submit" value="Загрузить">
 </form>
 <br>
 <h1>Список файлов в директории:</h1>
 <?php
  $dir = "./files"; // указываем директорию, в которой будем искать файлы
  $files = scandir($dir); // получаем список файлов в директории
  foreach($files as $file){ // проходим по списку файлов
   if($file != "." && $file != ".."){ // пропускаем ссылки на текущую и родительскую директории
    echo "<a href='files/$file'>$file</a><br>"; // выводим ссылку на файл
   }
  }
 ?>
</body>
</html>

<?php
if($_FILES){
    $dir = "./files/"; // указываем директорию, куда будем загружать файлы
    $file = $_FILES['file']['name']; // получаем имя файла
    move_uploaded_file($_FILES['file']['tmp_name'], $dir.$file); // перемещаем файл из временной папки в нужную директорию
    header("Location: ".$_SERVER['PHP_SELF']); // перезагружаем страницу, чтобы обновить список файлов
}
?>