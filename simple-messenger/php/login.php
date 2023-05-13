<?php
session_start();
date_default_timezone_set('Europe/Warsaw'); 
$login = $_POST['login'];
$pswd = $_POST['pswd'];

$timenow = time();
$_SESSION['time_sesion'] = $timenow;
$_SESSION['pc_info'] = $_SERVER['HTTP_USER_AGENT'];
//$conn = new mysqli('localhost', 'root', '', 'test');
//$conn = new mysqli('fdb1029.awardspace.net', '4271176_mojabaza', 'ZAQ12wsx', '4271176_mojabaza');
require_once "dbconnect.php";
$conn = mysqli_connect($host, $user_log, $pass, $db);

$login = mysqli_real_escape_string($conn, $login);
$pswd_get = mysqli_real_escape_string($conn, $pswd);

$conn -> set_charset("utf8");
$queryGet = "SELECT id_user, nick, pswd, acces, colortheme FROM gadu_wiaduser WHERE `nick`='$login';";

$result = mysqli_query($conn, $queryGet);

$resultarr = [];
$acces = false;
if (mysqli_num_rows($result) > 0){
    $record = mysqli_fetch_assoc($result);
    $hashpass = $record['pswd'];
    if(password_verify($pswd_get, $hashpass)){
        if($record['acces'] == 1){
        $resultarr[] = $record;
        $_SESSION["colortheme"] = $record['colortheme'];
        $_SESSION["user"] = $login;
        $iduser=$record['id_user'];
        $_SESSION["iduser"] = $iduser;
        $acces = true;
        }
        
        if($acces){
        $querysetonline = "INSERT INTO gadu_useronline (`id_user`,`active`) VALUES ($iduser,$timenow) ON DUPLICATE KEY UPDATE `active`=$timenow;";
        $result2 = mysqli_query($conn, $querysetonline);
        $yourURL="../comunicator.php";
        echo ("<script>location.href='$yourURL'</script>");
        } else {
            echo "Przykro mi ale Twoje konto jest nie aktywne. <br>";
            echo "Skontaktuj się z Twórcą celem Aktywacji konta.<br>";
            echo "W wiadomości podaj swój login<hr>";
            echo '<a href="../index.html">POWRÓT</a>';   
        }
    } else {
    echo 'Błędny Login lub Hasło';
    echo '<hr>';
    echo '<a href="../index.html">POWRÓT</a>'; 
    }
}else {
    echo 'Błędny Login lub Hasło';
    echo '<hr>';
    echo '<a href="../index.html">POWRÓT</a>'; 
    }


$conn -> close();

?>