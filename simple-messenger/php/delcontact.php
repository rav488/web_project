<?php
$user = $_POST['user'];
$delcon = $_POST['receiver'];

//$conn = new mysqli('localhost', 'root', '', 'test');
//$conn = new mysqli('fdb1029.awardspace.net', '4271176_mojabaza', 'ZAQ12wsx', '4271176_mojabaza');
require_once "dbconnect.php";
$conn = mysqli_connect($host, $user_log, $pass, $db);

$conn -> set_charset("utf8");
$queryDelCon = "DELETE FROM `gadu_wiaduserlists` WHERE 
`id_user`= (SELECT `id_user` FROM `gadu_wiaduser` WHERE `nick` = '$user')
AND `id_user_contact`= (SELECT `id_user` FROM `gadu_wiaduser` WHERE `nick` = '$delcon')";
echo $queryDelCon;
$result = mysqli_query($conn, $queryDelCon);
$conn -> close();
?>