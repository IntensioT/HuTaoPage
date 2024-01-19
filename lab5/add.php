<!DOCTYPE html>
<html>

<head>
    <title>Добавление записи в БД</title>
    <meta charset="utf-8">
</head>

<body>
    <h1>Добавление записи в БД</h1>

    <?php
    // Проверка, была ли отправлена форма
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

        function validateEmail($email)
        {
            $pattern = '/^[^@\s]+@[^@\s]+\.[^@\s]+$/';
            return preg_match($pattern, $email);
        }

        if ($name <= 0) {
            echo "<p>Please enter a valid name.</p>";
        } else {
            //echo "<h2>Your mail is:</h2>";
            if (validateEmail($email)) {
                // Добавление записи в таблицу
                $sql = "INSERT INTO contacts (name, email, phone) VALUES ('$name', '$email', '$phone')";
                if (mysqli_query($conn, $sql)) {
                    echo "Запись успешно добавлена.";
                } else {
                    echo "Ошибка: " . mysqli_error($conn);
                }
            } else {
                echo "INCORRECT EMAIL";
            }
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

        <input type="submit" value="Добавить">
    </form>

    <br>

    <a href="index.php">Вернуться к таблице</a>
</body>

</html>