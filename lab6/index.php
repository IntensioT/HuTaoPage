<!DOCTYPE html>
<html>
<head>
 <title>Файловый менеджер</title>
</head>
<body>
 <h1>Файловый менеджер</h1>
 <?php

  session_start();
  if(isset($_SESSION['username'])) { // Если пользователь уже авторизован
   echo '<p>Здравствуйте, '.$_SESSION['username'].'!</p>';
   //echo '<p>Здравствуйте, '.$_SESSION['hash'].'!</p>';
   echo '<form method="post" action="logout.php">
     <input type="submit" value="Выйти">
    </form>';
   echo '<h2>Загрузить файл</h2>
    <form method="post" enctype="multipart/form-data" action="upload.php">
     <input type="file" name="fileToUpload" id="fileToUpload">
     <input type="submit" value="Загрузить" name="submit">
    </form>';
  //  echo '<h2>Список файлов</h2>';
   include 'list_files.php'; // Подключаем скрипт для вывода списка файлов
   echo '<h2>Удалить файл</h2>
    <form method="post" action="delete.php">
     <select name="fileToDelete">';
   foreach($files as $file) { // Выводим список файлов в виде выпадающего списка
    echo '<option value="'.$file.'">'.$file.'</option>';
   }
   echo '</select>
    <input type="submit" value="Удалить" name="submit">
   </form>';
  } else { // Если пользователь не авторизован
   if(isset($_GET['error'])) {
    echo '<p style="color:red;">Неверный логин или пароль</p>';
   }
   echo '<form method="post" action="login.php">
     <label for="username">Логин:</label>
     <input type="text" name="username" id="username">
     <br>
     <label for="password">Пароль:</label>
     <input type="password" name="password" id="password">
     <br>
     <input type="submit" value="Войти">
    </form>';
  }

 ?>
</body>
</html>