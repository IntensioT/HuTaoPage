<!DOCTYPE html>
<html>
<head>
 <title>Таблица из БД</title>
 <meta charset="utf-8">
</head>
<body>
 <h1>Таблица из БД</h1>

 <?php
  // Установка соединения с БД
  $host = "localhost";
  $user = "root";
  $password = "6484915";
  $dbname = "Lab5DataBase";

  $conn = mysqli_connect($host, $user, $password, $dbname);

  if (!$conn) {
   die("Ошибка подключения: " . mysqli_connect_error());
  }

  // Выборка данных из таблицы
  $sql = "SELECT * FROM contacts";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
   echo "<table>";
   echo "<tr><th>ID</th><th>Имя</th><th>Email</th><th>Телефон</th><th>Действия</th></tr>";

   while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["name"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td>" . $row["phone"] . "</td>";
    echo "<td><a href='edit.php?id=" . $row["id"] . "'>Редактировать</a> | <a href='delete.php?id=" . $row["id"] . "&field=id'>Удалить по ID</a> ";//| <a href='delete.php?id=" . $row["id"] . "&field=name'>Удалить по имени</a> | <a href='delete.php?id=" . $row["id"] . "&field=email'>Удалить по email</a> | <a href='delete.php?id=" . $row["id"] . "&field=phone'>Удалить по телефону</a></td>";
    echo "</tr>";
   }

   echo "</table>";
  } else {
   echo "Нет данных в таблице.";
  }

  mysqli_close($conn);
 ?>

 <br>

 <a href="add.php">Добавить запись</a>
 <a href="del.php">Удалить по параметру</a>
</body>
</html>