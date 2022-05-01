<?php

$imageUpload = $item_name = $price = $details = $date = $is_active = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imageUpload = test_input($_POST["imageUpload"]);
    $item_name = test_input($_POST["item_name"]);
    $price= test_input($_POST["price"]);
    $details = test_input($_POST["details"]);
    $date = test_input($_POST["date"]);
    $is_active = test_input($_POST["is_active"]);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
