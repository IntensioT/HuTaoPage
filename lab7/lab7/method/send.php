<?php


//Set the reciever's email address

$to = "alexander0aki@gmail.com";

//Set the subject of the email

$subject = "It is a testing email";

//Set the email body

$message = "It is testing email body";

//Set the header information

$headers = "From: sender@gmail.com\r\n";

$headers .= "Reply-To: sender@gmail.com\r\n";


//Send email using message mail() function

if(mail($to,$subject,$message,$headers))

{

echo "Email has sent successfully.\r\n";

}

else{

echo "Email has not sent. <br />";

}

?>