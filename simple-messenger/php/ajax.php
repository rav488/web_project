<?php
session_start();
date_default_timezone_set('Europe/Warsaw'); 
$action = $_POST['action'];
$historyTest = $_POST['historyTest'];
$iduser = $_SESSION["iduser"];
$timesesion = $_SESSION['time_sesion'];
$timenow = time();

require_once "dbconnect.php";
$conn = mysqli_connect($host, $user_log, $pass, $db);

$conn -> set_charset("utf8");
if(($timenow - $timesesion) > 1*60){

$querysetonline = "INSERT INTO gadu_useronline (`id_user`,`active`) VALUES ($iduser,$timenow) ON DUPLICATE KEY UPDATE `active`=$timenow;";
$result2 = mysqli_query($conn, $querysetonline);
$_SESSION['time_sesion'] = $timenow;
}

$nick = $_POST['user'];
$reciver = $_POST['receiver'];
$time = $_POST['time'];

$deltatime=60*60*24*5; //s*m*h*d
$mintime=$time-$deltatime;

if ($action=='post'){
    $tresc = $_POST['tresc'];
    
    $queryPost = "INSERT INTO `gadu_wiadomosci`(`id`, `nick`, `odbiorca`, `tresc`, `czas`, `notread`, `dateread`) VALUES (NULL,'$nick','$reciver','$tresc','$time', 1,1)";
    $addmsg = mysqli_query($conn, $queryPost);
}

$readmsg = "UPDATE `gadu_wiadomosci` SET `notread`=0, `dateread`='$time' WHERE `nick`='$reciver' AND `odbiorca`='$nick' AND`notread`=1;";
$result = mysqli_query($conn, $readmsg);

if ($historyTest =='yes'){
    $queryGet = "SELECT nick, czas, tresc FROM gadu_wiadomosci WHERE ((`nick`='$nick' AND `odbiorca`='$reciver')OR(`nick`='$reciver' AND `odbiorca`='$nick')) ORDER BY `czas` DESC ";
} else {
    $queryGet = "SELECT nick, czas, tresc FROM gadu_wiadomosci WHERE ((`nick`='$nick' AND `odbiorca`='$reciver')OR(`nick`='$reciver' AND `odbiorca`='$nick')) AND (`dateread`>'$mintime' OR `dateread`='1') ORDER BY `czas` DESC ";
}



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