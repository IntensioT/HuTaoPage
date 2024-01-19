<?php
// Подключаемся к серверу MySQL
$link = mysqli_connect('localhost', 'root', '6484915', 'Lab5DataBase');

// Устанавливаем кодировку символов
mysqli_set_charset($link, "utf8");

// Выполняем запрос к базе данных
$sql = "SELECT * FROM items";
$result = mysqli_query($link, $sql);

// Проверяем, есть ли данные в результате запроса
if (mysqli_num_rows($result) > 0) {

    // Выводим таблицу с данными
    echo "<table><tr>";
    while ($fieldinfo = mysqli_fetch_field($result)) {
        echo "<th>" . $fieldinfo->name . "</th>";
    }
    echo "</tr>";

    // Получаем данные из каждой строки результата запроса
    while ($row = mysqli_fetch_assoc($result)) {

        // Выводим данные в таблицу
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . $value . "</td>";
        }
        echo "</tr>";

    } 

    echo "</table>";

} else {
    echo "0 результатов";
}

// Закрываем соединение с базой данных
mysqli_close($link);
?>