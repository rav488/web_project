<?php

$login = $_POST['loginreg'];
$pswd = $_POST['pswdregone'];


require_once "dbconnect.php";
$conn = mysqli_connect($host, $user_log, $pass, $db);
$login = mysqli_real_escape_string($conn, $login);
$pswd_get = mysqli_real_escape_string($conn, $pswd);

$pswd = password_hash($pswd_get, PASSWORD_DEFAULT);

$conn -> set_charset("utf8");

$test_query="SELECT * FROM `gadu_wiaduser` WHERE `nick`='$login'";
$testRes = mysqli_query($conn, $test_query);

if (mysqli_num_rows($testRes) > 0) {
    echo "Przykro mi ale Twój login jest już zajęty. <hr>";
    echo '<a href="../index.html">POWRÓT</a>';  
} else {

    $queryGet = "INSERT INTO `gadu_wiaduser`(`id_user`, `nick`, `pswd`, `acces`, `colortheme`) VALUES (NULL ,'$login','$pswd',0,'black')";
    $result = mysqli_query($conn, $queryGet);
    $conn -> close();
    echo "Przykro mi ale Twoje konto jest nie aktywne. <br>";
    echo "Skontaktuj się z Twórcą celem Aktywacji konta.<br>";
    echo "W wiadomości podaj swój login<hr>";
    echo '<a href="../index.html">POWRÓT</a>';   
}




?>