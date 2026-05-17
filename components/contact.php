<?php
include "../components/core.php";
if ($_POST) {
    $name    = $link->real_escape_string($_POST['name']    ?? '');
    $phone   = $link->real_escape_string($_POST['phone']   ?? '');
    $email   = $link->real_escape_string($_POST['email']   ?? '');
    $message = $link->real_escape_string(substr($_POST['message'] ?? '', 0, 50));
    $link->query("INSERT INTO contact (name, phone, email, message) VALUES ('$name','$phone','$email','$message')");
}
$ref = $_SERVER['HTTP_REFERER'] ?? '../index.php';
header("Location: $ref"); exit();
