<?php

session_start();

$login = htmlspecialchars($_POST['email']);
$pass = htmlspecialchars($_POST['password']);
$_SESSION['login'] = htmlspecialchars($login);

$link = mysqli_connect("localhost", "root", "root", "users");
if (!$link) {
  mysqli_connect_error();
}

$sql = "SELECT login, password FROM users WHERE login='" . $login . "' AND password='" . $pass . "'";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    header("Location: feedback.php");
    exit;
}

header("Location: index.php");
