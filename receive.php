<?php

$title = htmlspecialchars($_POST['title']);
$text = htmlspecialchars($_POST['editor1']);
$rdi = htmlspecialchars($_POST['problem']);
$chb = $_POST['problems'];
$slc = htmlspecialchars($_POST['select']);

$chbRes = "";

foreach ($chb as $item) {
    $chbRes .= htmlspecialchars("$item ");
}

print_r($chbRes);

$link = mysqli_connect("localhost", "root", "root", "users");
if (!$link) {
    mysqli_connect_error();
}

$id = mysqli_query($link ,"SELECT max(id) FROM feedback");
$id = intval(mysqli_fetch_array($id)[0]);
$id++;

$sql = "INSERT INTO feedback(id, title, text, impact, checkbox, slct) " .
        "VALUES ('$id', '$title', '$text', '$rdi', '$chbRes', '$slc')";
$result = mysqli_query($link, $sql);

header("Location: feedback.php");