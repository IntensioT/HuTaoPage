<?php
error_reporting(E_ALL & ~E_NOTICE);

// The message
$message = "Line 1\r\nLine 2\r\nLine 3";

$nl = "\r\n";
$headers = "To: n.alexander0aki@gmail.com ".$nl;
$headers .= "From: hakerman@mail.ru ".$nl;
$headers .= "Cc: hakerman@mail.ru".$nl;

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70, "\r\n");

// Send - replace email@domain.com with the recipient address
$bool = mail('n.stahnov@gmail.com', 'Server works!!!', $message);

var_dump($bool);