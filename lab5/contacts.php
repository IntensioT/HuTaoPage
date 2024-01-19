<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Добавление записи в таблицу MySQL</title>
</head>

<body>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "6484915";
    $dbname = "Lab5DataBase";

    // Создание соединения
    $link = mysqli_connect('localhost', 'root', '6484915', 'Lab5DataBase');
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Проверка соединения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $sql = "INSERT INTO contacts (name, email, phone)
            VALUES ('$name', '$email', '$phone')";

        if ($conn->query($sql) === TRUE) {
            echo "Запись успешно добавлена!";
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }

    }
    // Редактирование записи в таблице
    if (isset($_POST['edit'])) {
        echo "EDIT";
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $sql = "UPDATE contacts SET name='$name', email='$email', phone='$phone' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Запись успешно обновлена";
        } else {
            echo "Ошибка обновления записи: " . $conn->error;
        }
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
    $conn->close();
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Имя:</label>
        <input type="text" name="name" id="name"><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email"><br><br>

        <label for="phone">Телефон:</label>
        <input type="tel" name="phone" id="phone"><br><br>

        <input type="submit" name="add" value="Add record">

    </form>

    <form method="post">
        <!-- <label for="field">Введите значение поля:</label><br>
        <input type="text" id="field" name="field"><br> -->
        <input type="submit" name="edit" value="Edit">
    </form>

</body>

</html>