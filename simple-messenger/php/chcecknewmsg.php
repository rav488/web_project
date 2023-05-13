<?php
//$action = $_POST['action'];

//$conn = new mysqli('localhost', 'root', '', 'test');
//$conn = new mysqli('fdb1029.awardspace.net', '4271176_mojabaza', 'ZAQ12wsx', '4271176_mojabaza');
require_once "dbconnect.php";
$conn = mysqli_connect($host, $user_log, $pass, $db);

$conn -> set_charset("utf8");
$nick = $_POST['user'];
//$reciver = $_POST['receiver'];

//$nick='test1';

$queryGet = "SELECT nick, notread FROM gadu_wiadomosci WHERE odbiorca='$nick'";
//echo $queryGet;
$result = mysqli_query($conn, $queryGet);
$resultarr = [];

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
        $resultarr[] = $row['nick'].':'.$row['notread'];
    }
}

echo json_encode($resultarr);
$conn -> close();