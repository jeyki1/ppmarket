<?php
include "../components/core.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_POST['service_id'])) {
    header("Location: ../othsevr.php");
    exit();
}

$user_id    = (int)$_SESSION['user']['id'];
$service_id = (int)$_POST['service_id'];

$check = $link->query("SELECT id FROM services WHERE id = $service_id");
if ($check->num_rows === 0) {
    header("Location: ../othsevr.php");
    exit();
}

$exists = $link->query("SELECT id FROM basket WHERE user_id = $user_id AND service_id = $service_id");
if ($exists->num_rows === 0) {
    $link->query("INSERT INTO basket (user_id, service_id) VALUES ($user_id, $service_id)");
}

header("Location: ../basket.php");
exit();
?>
