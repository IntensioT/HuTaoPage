<?php

session_start();
if(isset($_POST['submit'])){
    
    if (($_POST["captcha"] != "") && ($_POST["captcha"] == $_SESSION["rand_code"])){
        
        $server_mail = "klait45@bk.ru";
        $to = $_POST['email'];
        $subject = "=?UTF-8?B?".base64_encode("Форма обратной связи")."?=";
        //$subject = "Форма обратной связи";
        $message = "Имя: ".$_POST['name']."\n";
        $message .= "Номер телефона: ".$_POST['phone']."\n";
        $message .= "Сообщение: ".$_POST['message']."\n";
        
        $headers = "From: holanto <$server_mail> \r\n";
        $headers .= "MIME-Version: 1.0 \r\n";
        $headers .= "Content-type: text/plain; charset=utf-8 \r\n";
        $headers .="Reply-To: $server_mail \r\n" ;
        $headers .='X-Mailer: PHP/' . phpversion();
        
        if(mail($to, $subject, $message, $headers, "-f $server_mail")){
            echo "Ваше письмо отправлено:)<br>";
        } else {
            echo "Возникли проблемы при отправке, повторите попытку позже<br>";
        }
    } else {
        echo "Капча введена неправильно";
    }
    
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Форма обратной связи</title>
</head>
<body>
  <h2>Форма обратной связи</h2>
  <form method="post">
    <fieldset>
        <legend>Оставьте сообщение:</legend>
        Ваше имя:<br>
        <input type="text" name="name" required><br>
        E-mail:<br>
        <input type="email" name="email" required><br>
        Номер телефона:<br>
        <input type="text" name="phone" required><br>
        Сообщение:<br>
        <textarea rows="10" cols="45" name="message" required></textarea><br>
        Подтверждение отправки:<br>
        <img src="captcha.php" alt="" /><input type="text" name="captcha" required><br>
        <input type="submit" name="submit" value="Отправить сообщение">
    </fieldset>
  </form>
</body>
</html>