<!DOCTYPE html>
<html>
<head>
 <title>Форма обратной связи</title>
</head>
<body>
 <h1>Форма обратной связи</h1>
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="name">Имя:</label>
  <input type="text" id="name" name="name"><br><br>

  <label for="phone">Телефон:</label>
  <input type="tel" id="phone" name="phone"><br><br>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email"><br><br>

  <label for="subject">Тема:</label>
  <input type="text" id="subject" name="subject"><br><br>

  <label for="message">Текст сообщения:</label><br>
  <textarea id="message" name="message"></textarea><br><br>

  <input type="submit" name="submit" value="Отправить">
 </form>

 <?php
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $phone = test_input($_POST["phone"]);
  $email = test_input($_POST["email"]);
  $subject = test_input($_POST["subject"]);
  $message = test_input($_POST["message"]);

  if (empty($name) || empty($phone) || empty($email) || empty($subject) || empty($message)) {
   echo "<p style='color:red;'>Заполните все поля формы!</p>";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   echo "<p style='color:red;'>Неправильный формат email!</p>";
  } elseif (!preg_match("/^[0-9]{10}$/", $phone)) {
   echo "<p style='color:red;'>Неправильный формат телефона!</p>";
  } else {
   $to = "klait45@bk.ru";
   $headers = "From: $email \r\n";
   $headers .= "Reply-To: $email \r\n";
   $message_body = "Имя: $name\nТелефон: $phone\nEmail: $email\nТема: $subject\nТекст сообщения:\n$message";
   mail($to, $subject, $message_body, $headers);
   echo "<p style='color:green;'>Сообщение отправлено! Спасибо за обращение. Мы ответим вам в ближайшее время.</p>";
   $reply_subject = "Благодарность за обращение";
   $reply_message = "Уважаемый(ая) $name,\nСпасибо за отправленное сообщение. Мы получили ваше обращение и ответим вам в ближайшее время.\n\nС уважением,\nКоманда сайта";
   mail($email, $reply_subject, $reply_message, $headers);
  }
 }

 function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
 }
 ?>
</body>
</html>