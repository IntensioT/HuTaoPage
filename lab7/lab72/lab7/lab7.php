<html>  
  <head> 
    <title>MyMail</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  </head>  
  <body>
  	<form action="lab7.php" method="POST">
	<p>Введите заголовок:<input type="text" name="subject" /></p>
	<p>Введите mail:<input type="text" name="mail"></p>
	<p><textarea rows="20" cols="70" name="text"></textarea></p>
	<p><input type="submit" name="submit" value="Отправить" /></p>
<?php
ini_set('display_errors','On');
error_reporting(E_ALL);
if (isset($_POST['submit'])){
	if(isset($_POST['subject'])&&isset($_POST['text'])&&!empty($_POST['subject'])&&!empty($_POST['text'])&&isset($_POST['mail'])
	&&!empty($_POST['mail']))
	{
		$to = $_POST['mail'];
		$subject = $_POST['subject']; 
		$message = $_POST['text'];
		$subject = "=?UTF-8?B?". base64_encode($subject) ."?=";
		$headers  = "Content-type: text/plain; charset=utf-8 \r\n"; 
		$headers .= "From: <blessedboy@mail.ru> \r\n"; 
		$headers .= "Reply-To: noreply-to@example.com\r\n"; 
		$headers .= "MIME-Version: 1.0\r\n";
		if (mail($to, $subject, $message, $headers))
		{
			echo '<meta http-equiv="refresh" content="1; URL=lab7.php">'; 
			echo 'Успешно отправлено.';
		} else
		{
			echo 'Не отправлено.';
		} 
	}
	else echo "Заполните все поля.";
}	
?>
</body>