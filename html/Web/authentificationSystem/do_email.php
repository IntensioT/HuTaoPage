<?php

require_once __DIR__.'/boot.php';

$user = $_POST['user'];


$stmt = pdo()->prepare("SELECT * FROM `emails` WHERE `username` = :username");
$stmt->execute(['username' => $user]);
if ($stmt->rowCount() > 0) {
    flash('Пользователь с данным именем уже подписан.');
    // header('Location: /');
    header('Location: auth.php');
    die;
}

$stmt = pdo()->prepare("INSERT INTO `emails` (`username`, `email`) VALUES (:username, :email)");
$stmt->execute([
    'username' => $user,
    'email' => $_POST['email'],
]);

header('Location: auth.php');
