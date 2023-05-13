<?php
session_start();

$user = $_SESSION['user'];
$oldpsw = $_POST['old'];
$newpsw = $_POST['newone'];

require_once "../php/dbconnect.php";
$conn = mysqli_connect($host, $user_log, $pass, $db);
$conn -> set_charset("utf8");

$queryGet = "SELECT nick, pswd FROM gadu_wiaduser WHERE `nick`='$user';";

$result = mysqli_query($conn, $queryGet);

if (mysqli_num_rows($result) > 0){
    $record = mysqli_fetch_assoc($result);
    $hashpass = $record['pswd'];

    if(password_verify($oldpsw, $hashpass)){
        $pswd_new = password_hash($newpsw, PASSWORD_DEFAULT);
        $queryTest = "UPDATE `gadu_wiaduser` SET `pswd`='$pswd_new' WHERE `nick`='$user'";
        $resulttes = mysqli_query($conn, $queryTest);
        echo 'zmieniono';
    } else {
        echo 'nie zmieniono';
    }
}
?>

