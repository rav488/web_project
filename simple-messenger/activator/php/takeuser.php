<?php

require_once "../../php/dbconnect.php";
$conn = mysqli_connect($host, $user_log, $pass, $db);
$conn -> set_charset("utf8");

$test_query="SELECT `nick`, `acces` FROM `gadu_wiaduser`";
$testRes = mysqli_query($conn, $test_query);

while($row = mysqli_fetch_assoc($testRes)) {
    $user_table[] = $row;
}

$resdata = json_encode($user_table);

echo $resdata;


?>