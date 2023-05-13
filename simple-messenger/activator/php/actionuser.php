<?php
$user = $_POST['user'];
$action = $_POST['action'];
$newpass = $_POST['newpass'];



require_once "../../php/dbconnect.php";
$conn = mysqli_connect($host, $user_log, $pass, $db);
$conn -> set_charset("utf8");

$user = mysqli_real_escape_string($conn, $user);




if($action =='active'){
    $test_query="SELECT * FROM `gadu_wiaduser` WHERE `nick`='$user'";
    $testRes = mysqli_query($conn, $test_query);
        if (mysqli_num_rows($testRes) > 0) {
            $test_query="UPDATE `gadu_wiaduser` SET `acces`= 1 WHERE `nick`='$user'";
            $testRes = mysqli_query($conn, $test_query);
            echo 'Konto zostało aktywowane';
        } else {
            echo 'Nie odnaleziono Użytkownika. Błędny Login!';
        }
}

if($action =='block'){
    $test_query="SELECT * FROM `gadu_wiaduser` WHERE `nick`='$user'";
    $testRes = mysqli_query($conn, $test_query);
        if (mysqli_num_rows($testRes) > 0) {
            $test_query="UPDATE `gadu_wiaduser` SET `acces`= 0 WHERE `nick`='$user'";
            $testRes = mysqli_query($conn, $test_query);
            echo 'Konto zostało zablokowane';
        } else {
            echo 'Nie odnaleziono Użytkownika. Błędny Login!';
        }
}

if($action =='delete'){
    //$test_query="DELETE FROM `gadu_wiaduser` WHERE `nick`='$user'";
    $test_query ="DELETE FROM `gadu_wiaduser` WHERE `nick`='$user';";
    $test_query .="DELETE FROM `gadu_wiadomosci` WHERE `nick`='$user'";
    $testRes = mysqli_multi_query($conn, $test_query);
    
    echo 'Usuwanie '.$user." zakońcone.";
}

if($action =='chpass'){
    $test_query="SELECT * FROM `gadu_wiaduser` WHERE `nick`='$user'";
    $testRes = mysqli_query($conn, $test_query);
        if (mysqli_num_rows($testRes) > 0) {
            $newpasshash = password_hash($newpass, PASSWORD_DEFAULT);

            $test_query="UPDATE `gadu_wiaduser` SET `pswd`= '$newpasshash' WHERE `nick`='$user'";
            $testRes = mysqli_query($conn, $test_query);
            echo 'Hasło zmienione';
        } else {
            echo 'Nie odnaleziono Użytkownika. Błędny Login!';
        }
}
?>