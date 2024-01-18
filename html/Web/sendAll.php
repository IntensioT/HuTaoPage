<?php

require_once __DIR__ . '/authentificationSystem/boot.php';


$stmt = pdo()->prepare("SELECT * FROM `emails`");
$stmt->execute();

$names = array();
$emails = array();

while ($row = $stmt->fetch()) {
  array_push($names, $row["username"]);
  array_push($emails, $row["email"]);
}
//ysk9vP8XiUwyKAEDJvLh

//session_start();
if (isset($_POST['submit'])) {

  $iter = 0;
  foreach ($emails as $mai) {
    $server_mail = "sussusov45@mail.ru";
    $to = $mai;
    $name = $names[$iter++];
    $userSubject = $_POST['userSubject'];
    $userMessage = $_POST['message'];

    $subject = "=?UTF-8?B?" . base64_encode("Форма обратной связи") . "?=";

    //error_reporting(E_ALL & ~E_NOTICE);

    $message = "<p>Спасибо за ваше письмо. </p><br><p>\"$userMessage\"</p><br><p>С наилучшими пожеланиями ваш alexander</p><p>Это было отправлено с помощью функции mail</p>";

    $nl = "\r\n";
    $headers = 'MIME-Version: 1.0' . $nl;
    $headers .= 'Content-type: text/html; charset=utf-8' . $nl;

    //Send email using message mail() function
    if (mail($to, $subject, $message, $headers)) {
      //  echo '<p>Message has been sent with mail function</p>';
    } else {
      echo "Email has not sent. \r\n";
      var_dump(error_get_last());
    }
  }

}

?>
<!DOCTYPE html>
<html>

<head>
  <title>Форма рассылки </title>
  <link rel="stylesheet" href="form.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="wrapper">

    <h2>Форма рассылки</h2>
    <form method="post">
      <fieldset>
        Тема сообщения:<br>
        <input type="text" name="userSubject" required><br>
        Сообщение:<br>
        <textarea rows="10" cols="70" name="message" required></textarea><br>
        <input type="submit" name="submit" value="Отправить сообщение">
      </fieldset>
    </form>

  </div>


</body>

</html>