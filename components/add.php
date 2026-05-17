<?php
include "../components/core.php";

if (!isset($_SESSION['user']))
    { header("Location: ../login.php");
    exit();
    }

    $user_id    = (int)$_SESSION['user']['id'];
    $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;

    if ($product_id > 0) {
    $exists = $link->query("SELECT id FROM basket
    WHERE user_id=$user_id
    AND product_id=$product_id")->num_rows;
    
    if (!$exists) $link->query("
    INSERT INTO basket (user_id, product_id, quantity)
    VALUES ($user_id, $product_id, 1)
    ");
}
$ref = $_SERVER['HTTP_REFERER'] ?? '../explore.php';
header("Location: $ref");
exit();
?>