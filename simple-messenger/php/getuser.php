<?php
session_start();
$iduser = $_SESSION['iduser'];
//$user=$_POST['user'];

//$conn = new mysqli('localhost', 'root', '', 'test');
//$conn = new mysqli('fdb1029.awardspace.net', '4271176_mojabaza', 'ZAQ12wsx', '4271176_mojabaza');

require_once "dbconnect.php";
$conn = mysqli_connect($host, $user_log, $pass, $db);
$conn -> set_charset("utf8");

$queryGet = "SELECT gadu_wiaduser.nick, gadu_useronline.active FROM gadu_wiaduserlists left JOIN gadu_wiaduser ON gadu_wiaduserlists.id_user_contact = gadu_wiaduser.id_user LEFT JOIN gadu_useronline ON gadu_wiaduserlists.id_user_contact = gadu_useronline.id_user WHERE gadu_wiaduserlists.id_user = $iduser ORDER BY gadu_wiaduser.nick;";
$result = mysqli_query($conn, $queryGet);

$resultarr = [];

if (mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)){
        $resultarr[] = $row;
    }
}

echo json_encode($resultarr);
$conn -> close();
?>