<?php

require_once __DIR__.'/authentificationSystem/boot.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\Smtp;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php'; //ysk9vP8XiUwyKAEDJvLh

//session_start();
if (isset($_POST['submit'])) {

  $server_mail = "sussusov45@mail.ru";
  $to = $_POST['email'];
  $name = $_POST['name'];
  $userSubject = $_POST['userSubject'];
  $userMessage = $_POST['message'];

  $subject = "=?UTF-8?B?" . base64_encode("Форма обратной связи") . "?=";

  //error_reporting(E_ALL & ~E_NOTICE);

  //$message = "<p>Thank you for your letter on the topic \"$userSubject\"</p><br><p>\"$userMessage\"</p><br><p>We will answer as soon as possible</p><p>This was send by mail function</p>";
  $message = "<p>Спасибо за ваше письмо на тему \"$userSubject\"</p><br><p>\"$userMessage\"</p><br><p>Мы ответим как можно скорее</p><p>Это было отправлено с помощью функции mail</p>";

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

  $mail = new PHPMailer(true);

  try {
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
    $mail->isSMTP();
    $mail->Host = 'smtp.mail.ru';
    $mail->SMTPAuth = true;
    $mail->Username = 'sussusov45@mail.ru';
    $mail->Password = 'ysk9vP8XiUwyKAEDJvLh';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom($server_mail, 'Server mailer');
    $mail->addAddress($to, $name); //Add a recipient/
    $mail->addReplyTo('alexander0aki@gmail.com', 'Information');
    $mail->addCC($server_mail);
    $mail->addBCC($to);

    $mail->isHTML(true);
    $mail->CharSet = "UTF-8";
    $mail->Encoding = 'base64';

    $mail->Subject = $subject;
    //$mail->Body = "<p>Thank you for your letter on the topic \"$userSubject\"</p><br><p>\"$userMessage\"</p><br><p>We will answer as soon as possible</p><p>This was send by PHPMailer</p>";
    $mail->Body = "<p>Спасибо за ваше письмо на тему \"$userSubject\"</p><br><p>\"$userMessage\"</p><br><p>Мы ответим как можно скорее</p><p>Это было отправлено с помощью PHPMailer</p>";
    $mail->AltBody = $userMessage;

    $mail->send();

    $stmt = pdo()->prepare("INSERT INTO `sendmails` (`email`, `text`) VALUES (:email, :text)");
    $stmt->execute([
      'email' => $to,
      'text' => $userSubject."\n".$userMessage,
    ]);

    header('Location: index.php');
    // echo '<p>Message has been sent with PHPMailer</p>';
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>Форма обратной связи</title>
  <link rel="stylesheet" href="form.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php include '/var/www/html/Web/header-about.php'; ?>

  <div class="wrapper">

    <h2>Форма обратной связи</h2>
    <form method="post">
      <fieldset>
        <legend>Оставьте сообщение:</legend>
        Ваше имя:<br>
        <input type="text" name="name" required><br>
        E-mail:<br>
        <input type="email" name="email" required><br>
        Тема сообщения:<br>
        <input type="text" name="userSubject" required><br>
        Сообщение:<br>
        <textarea rows="10" cols="70" name="message" required></textarea><br>
        <input type="submit" name="submit" value="Отправить сообщение">
      </fieldset>
    </form>

  </div>

  <?php include '/var/www/html/Web/footer.php'; ?>

</body>

</html>