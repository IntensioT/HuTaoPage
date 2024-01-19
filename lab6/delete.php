<!DOCTYPE html>
<html>
<head>
 <title>Удаление файлов</title>
</head>
<body>
 <h1>Удаление файлов:</h1>
 <?php
 if(isset($_POST['delete'])){
  $file = $_POST['file']; // получаем имя файла
  if(unlink($file)){ // удаляем файл
   echo "Файл $file успешно удален!";
  } else {
   echo "Ошибка при удалении файла $file!";
  }
 }
 ?>
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  <select name="file">
   <?php
   $dir = "./files"; // указываем директорию, в которой будем искать файлы
   $files = scandir($dir); // получаем список файлов в директории
   foreach($files as $file){ // проходим по списку файлов
    if($file != "." && $file != ".."){ // пропускаем ссылки на текущую и родительскую директории
     echo "<option value='files/$file'>$file</option>"; // выводим опцию для выбора файла
    }
   }
   ?>
  </select><br><br>
  <input type="submit" name="delete" value="Удалить">
 </form>
</body>
</html>