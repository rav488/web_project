<?php
session_start();
$user = $_SESSION['user'];
$color = $_POST['color'];
$_SESSION['colortheme'] = $color;
//echo $oldpsw.','.$newpsw;
require_once "../php/dbconnect.php";
$conn = mysqli_connect($host, $user_log, $pass, $db);

$conn -> set_charset("utf8");


$queryTest = "UPDATE `gadu_wiaduser` SET `colortheme`='$color' WHERE `nick`='$user'";
$resulttes = mysqli_query($conn, $queryTest);


if (mysqli_affected_rows($conn) == 0){
    echo 'nie zmieniono';
} else {
    echo 'zmieniono';
}

?>

