
<?php
// Подключаемся к серверу MySQL
$link = mysqli_connect('localhost', 'root', '6484915', 'Lab5DataBase');

// Устанавливаем кодировку символов
mysqli_set_charset($link, "utf8");

// Добавление записи в таблицу
if (isset($_POST['addHtml'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO contacts (name, email, phone) VALUES ('$name', '$email', '$phone')";
    mysqli_query($link, $sql);
}

// Редактирование записи в таблице
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE contacts SET name='$name', email='$email', phone='$phone' WHERE id=$id";
    mysqli_query($link, $sql);
}

// Удаление записи из таблицы
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM contacts WHERE id=$id";
    mysqli_query($link, $sql);
}

// Выполняем запрос к базе данных
$sql = "SELECT * FROM contacts";
$result = mysqli_query($link, $sql);

// Проверяем, есть ли данные в результате запроса
if (mysqli_num_rows($result) > 0) {

    // Выводим таблицу с данными
    echo "<table><tr>";
    while ($fieldinfo = mysqli_fetch_field($result)) {
        echo "<th>" . $fieldinfo->name . "</th>";
    }
    echo "<th>Действия</th>";
    echo "</tr>";

    // Получаем данные из каждой строки результата запроса
    while ($row = mysqli_fetch_assoc($result)) {

        // Выводим данные в таблицу
        echo "<tr>";
        foreach ($row as $key => $value) {
            echo "<td>" . $value . "</td>";
        }
        echo "<td><a href='?edit=" . $row['id'] . "'>Редактировать</a> | <a href='?delete=" . $row['id'] . "' onclick=\"return confirm('Вы уверены?')\">Удалить</a></td>";
        echo "</tr>";

    } 

    echo "</table>";

} else {
    echo "0 результатов";
}

// Закрываем соединение с базой данных
mysqli_close($link);
?>