<?php
include_once "/var/task/user/api" . "Sender.php";
include_once "/var/task/user/api" . "/Requests/GetAuth_Telegram.php";

$tid = $_GET['id'];
$hash = $_GET['hash'];

$hashChecked = hash('sha256', "$tid+randomsalt");

//var_dump($_GET);
//echo $tid . "<br>";
//echo $hashChecked;

if ($hashChecked == $hash) {
    echo (new \Actions\Handler(new \Actions\GetAuth_Telegram($tid)))->ToJson();
    header("Location: https://croco.digital");
    die("ok");
} else {
    die("invalid hash");
}
