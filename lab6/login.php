<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <?php if (isset($_GET['error'])): ?> <!-- Если есть параметр ошибки, выводим сообщение -->
        <p style="color: red;">Неверное имя пользователя или пароль</p>
    <?php endif; ?>
    <form method="post" action="login.php">
        <label for="username">Имя пользователя:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Пароль:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Войти">
    </form>
</body>

</html>

<?php
session_start();

// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "6484915";
$dbname = "lab6Users";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Обработка входа пользователя
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash = hash("sha256", $username . "." . $password);
    

    $sql = "SELECT * FROM users WHERE login='$username' AND hash='$hash'";
    
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        echo "<p>Добро пожаловать, $username!</p>";
        $_SESSION['username'] = $username; // Сохраняем имя пользователя в сессии
        $_SESSION['hash'] = $hash;
        header('Location: index.php'); // Перенаправляем на главную страницу
        exit();

    } else {
        echo "<p>Неверный логин или пароль.</p>";
        header('Location: index.php?'); // Перенаправляем на главную страницу с параметром ошибки
        exit();
    }
} else { // Если данные из формы не были отправлены
    header('Location: index.php'); // Перенаправляем на главную страницу
    mysqli_close($conn);
    exit();
}



// $users = array(
//     // Массив пользователей с паролями
//     'admin' => 'password',
//     'user' => '12345'
// );
// if (isset($_POST['username']) && isset($_POST['password'])) { // Если были отправлены данные из формы
//     $username = $_POST['username'];
//     $password = $_POST['password'];
//     if (isset($users[$username]) && $users[$username] == $password) { // Если пользователь существует и пароль верный
//         $_SESSION['username'] = $username; // Сохраняем имя пользователя в сессии
//         header('Location: index.php'); // Перенаправляем на главную страницу
//         exit();
//     } else { // Если пользователь не найден или пароль неверный
//         header('Location: index.php?error=1'); // Перенаправляем на главную страницу с параметром ошибки
//         exit();
//     }
// } else { // Если данные из формы не были отправлены
//     header('Location: index.php'); // Перенаправляем на главную страницу
//     exit();
// }
?>