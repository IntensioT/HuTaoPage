<!DOCTYPE html>
<html>

<head>
    <title>Удаление записи в БД</title>
    <meta charset="utf-8">
</head>

<body>

<a href="index.php">Вернуться к таблице</a>

<h1>Удаление записи из БД</h1>

<?php
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Получение данных из формы
  $name = $_POST["name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];

  // Установка соединения с БД
  $host = "localhost";
  $user = "root";
  $password = "6484915";
  $dbname = "Lab5DataBase";

  $conn = mysqli_connect($host, $user, $password, $dbname);

  if (!$conn) {
   die("Ошибка подключения: " . mysqli_connect_error());
  }

  // Удаление записей из таблицы по заданным параметрам
  $sql = "DELETE FROM contacts WHERE name='$name' OR email='$email' OR phone='$phone'";
  if (mysqli_query($conn, $sql)) {
   echo "Записи успешно удалены.";
  } else {
   echo "Ошибка: " . mysqli_error($conn);
  }

  mysqli_close($conn);
 }
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
 <label>Имя:</label>
 <input type="text" name="name"><br><br>

 <label>Email:</label>
 <input type="email" name="email"><br><br>

 <label>Телефон:</label>
 <input type="text" name="phone"><br><br>

 <input type="submit" value="Удалить">
</form>
</body>

</html>