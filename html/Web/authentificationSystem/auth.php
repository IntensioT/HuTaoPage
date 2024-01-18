<?php
require_once __DIR__ . '/boot.php';

$user = null;

if (check_auth()) {
  // Получим данные пользователя по сохранённому идентификатору
  $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
  $stmt->execute(['id' => $_SESSION['user_id']]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Php auth demo</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="/html/Web/style.css">
</head>

<body>

  <?php include '/var/www/html/Web/header-about.php'; ?>

  <div class="wrapper">


    <div class="container">
      <div class="row py-5">
        <div class="col-lg-6">

          <?php if ($user) { ?>


            <h1>С возвращением,
              <?= htmlspecialchars($user['username']) ?>!
            </h1>

            <?php if ($user['username'] == "admin") {
              require_once __DIR__ . '/boot.php';

              $stmt = pdo()->prepare("SELECT * FROM `users`");
              $stmt->execute();

              echo "Все пользователи : ";
              echo "<table>";
              while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . $row["username"] . "</td>";
                echo "</tr>";
              }
              echo "</table>";
              echo "<br><br>";
              
              $stmt = pdo()->prepare("SELECT * FROM `emails`");
              $stmt->execute();

              echo "Подписанные пользователи :";
              echo "<table>";
              while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td  style='padding: 5px;'>" . $row["username"] . "</td>";
                echo "<td  style='padding: 5px;'>" . $row["email"] . "</td>";
                echo "</tr>";
              }
              echo "</table>";
              echo "<br><br>";

              $stmt = pdo()->prepare("SELECT * FROM `sendmails`");
              $stmt->execute();

              echo "Полученные отзывы :";
              echo "<table>";
              while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td  style='padding: 5px;'>" . $row["email"] . "</td>";
                echo "<td  style='padding: 5px;'>" . $row["text"] . "</td>";
                echo "</tr>";
              }
              echo "</table>";
              echo "<br><br>";

              include '/var/www/html/Web/sendAll.php'; 

              ?>

            <?php } else { ?>
              <h1 class="mb-5">Почтовая рассылка</h1>
              <?php flash(); ?>

              <form method="post" action="do_email.php">
                <input type="hidden" name="user" value="<?php echo $user['username']; ?>">
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" required>
                </div>
                <div class="d-flex justify-content-between">
                  <button type="submit" class="btn btn-primary">Подписаться</button>
                </div>
              </form>

            <?php } ?>


            <form class="mt-5" method="post" action="do_logout.php">
              <button type="submit" class="btn btn-primary">Выйти</button>
            </form>




          <?php } else { ?>

            <h1 class="mb-5">Регистрация</h1>

            <?php flash(); ?>

            <form method="post" action="do_register.php">
              <div class="mb-3">
                <label for="username" class="form-label">Имя пользователя</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                <a class="btn btn-outline-primary" href="login.php">Войти</a>
              </div>
            </form>

          <?php } ?>

        </div>
      </div>
    </div>
  </div>


  <?php include '/var/www/html/Web/footer.php'; ?>

</body>

</html>