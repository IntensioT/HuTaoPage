<?php
// Подключаемся к серверу MySQL
$link = mysqli_connect('localhost', 'root', '6484915', 'Lab5DataBase');

// Создаем объект mysqli
$mysqli = new mysqli('localhost', 'root', '6484915', 'Lab5DataBase');

// Проверяем соединение
if ($mysqli->connect_error) {
    die('Ошибка подключения (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}

echo 'Соединение установлено... ' . $mysqli->host_info . "\n";

// Выполняем запрос к базе данных
$sql = "SELECT * FROM players";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        printf ("%s (%s)\n", $row["name"], $row["email"]);
    }
    // Освобождаем ресурсы результата
    $result->free();
}



mysqli_set_charset($link, "utf8");

$sql = "SELECT * FROM players ORDER BY name ASC";
$result = mysqli_query($link, $sql);



if (mysqli_num_rows($result) > 0) {

    echo "<table><tr><th>Email</th><th>Stats</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {

        echo "<tr><td>" . $row["email"] . "</td><td>" . $row["stats"] . "</td></tr>";

    }

    echo "</table>";

} else {

    echo "0 results";

}


$sql = "SELECT players.name, inventory.fieldTXT FROM players INNER JOIN inventory ON players.id=inventory.invId";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table><tr><th>Name</th><th>Text Field</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["name"] . "</td><td>" . $row["fieldTXT"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Закрываем соединение
$mysqli->close();
mysqli_close($link);
?>