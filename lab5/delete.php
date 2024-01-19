<!DOCTYPE html>
<html>

<head>
    <title>Редактирование записи в БД</title>
    <meta charset="utf-8">
</head>

<body>
    <h1>Редактирование записи в БД</h1>

    <?php
    // Проверка, была ли отправлена форма
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Получение данных из формы
        $id = $_POST["id"];
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

        // Обновление записи в таблице
    
        $sql = "UPDATE contacts SET name='$name', email='$email', phone='$phone' WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            echo "Запись успешно обновлена.";
        } else {
            echo "Ошибка: " . mysqli_error($conn);
        }


        mysqli_close($conn);
    } else {
        // Получение ID записи из URL
        if (isset($_GET["id"])) {
            $id = $_GET["id"];

            // Установка соединения с БД
            $host = "localhost";
            $user = "root";
            $password = "6484915";
            $dbname = "Lab5DataBase";

            $conn = mysqli_connect($host, $user, $password, $dbname);

            if (!$conn) {
                die("Ошибка подключения: " . mysqli_connect_error());
            }

            // Получение данных записи из таблицы
            $sql = "SELECT * FROM contacts WHERE id=$id";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $name = $row["name"];
                $email = $row["email"];
                $phone = $row["phone"];
            } else {
                echo "Запись не найдена.";
                exit;
            }

            mysqli_close($conn);
        } else {
            echo "ID записи не указан.";
            exit;
        }
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label>Имя:</label>
        <input type="text" name="name" value="<?php echo $name; ?>"><br><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $email; ?>"><br><br>

        <label>Телефон:</label>
        <input type="text" name="phone" value="<?php echo $phone; ?>"><br><br>

        <input type="submit" value="Обновить">
    </form>

    <br>

    <a href="index.php">Вернуться к таблице</a>

    <h1>Удаление записи из БД</h1>

    <?php
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        // Установка соединения с БД
        $host = "localhost";
        $user = "root";
        $password = "6484915";
        $dbname = "Lab5DataBase";

        $conn = mysqli_connect($host, $user, $password, $dbname);

        if (!$conn) {
            die("Ошибка подключения: " . mysqli_connect_error());
        }

        // Удаление записи из таблицы
        if ($id != -1) {
            $sql = "DELETE FROM contacts WHERE id=$id";
            if (mysqli_query($conn, $sql)) {
                echo "Запись успешно удалена.";
            } else {
                echo "Ошибка: " . mysqli_error($conn);
            }
        }

        mysqli_close($conn);
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    <!-- <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input name="id" value="<?php echo $id; ?>"><br><br>

        <label>Имя:</label>
        <input type="text" name="name"><br><br>

        <label>Email:</label>
        <input type="email" name="email"><br><br>

        <label>Телефон:</label>
        <input type="text" name="phone"><br><br>

        <input type="submit" value="Удалить">
    </form> -->
</body>

</html>