<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  setcookie('background-color', $_POST['background-color'], time() + (86400 * 30), '/');
  setcookie('font-size', $_POST['font-size'], time() + (86400 * 30), '/');
  setcookie('font-color', $_POST['font-color'], time() + (86400 * 30), '/');
  setcookie('header-color', $_POST['header-color'], time() + (86400 * 30), '/');
}
?>