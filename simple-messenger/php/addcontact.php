<?php
$user = $_POST['user'];
$addUser = $_POST['receiver'];
//$user = 'test1';
//$addUser = 'test3';


$odpowiedz = '';
//$conn = new mysqli('localhost', 'root', '', 'test');
//$conn = new mysqli('fdb1029.awardspace.net', '4271176_mojabaza', 'ZAQ12wsx', '4271176_mojabaza');
require_once "dbconnect.php";
$conn = mysqli_connect($host, $user_log, $pass, $db);

$conn -> set_charset("utf8");


$queryTest = "SELECT id_user FROM `gadu_wiaduser` WHERE `nick`='$addUser'";
$resulttes = mysqli_query($conn, $queryTest);
if (mysqli_num_rows($resulttes) == 0) {
    $odpowiedz = 'Nie istnieje';
}else {
    $queryAddCon = "SELECT * FROM `gadu_wiaduserlists` WHERE `id_user` = (SELECT id_user FROM `gadu_wiaduser` WHERE `nick`='$user') AND `id_user_contact` = (SELECT id_user FROM `gadu_wiaduser` WHERE `nick`='$addUser');";
    $result = mysqli_query($conn, $queryAddCon);
    if (mysqli_num_rows($result) == 0) {
        $queryAddConNow = "INSERT INTO `gadu_wiaduserlists`(`id_list`, `id_user`, `id_user_contact`) VALUES (NULL, (SELECT id_user FROM `gadu_wiaduser` WHERE `nick`='$user'), (SELECT id_user FROM `gadu_wiaduser` WHERE `nick`='$addUser') ); ";
        $result = mysqli_query($conn, $queryAddConNow);
        $odpowiedz = 'Dodano';
    } else {
        $odpowiedz = 'Istnieje';
    }
}
$conn -> close();
echo $odpowiedz;
?>