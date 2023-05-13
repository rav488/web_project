<?php
session_start();
$user_org = $_SESSION['user'];
$user_get = $_POST['username'];
$pswd = $_POST['delpswd'];

require_once "../php/dbconnect.php";
$conn = mysqli_connect($host, $user_log, $pass, $db);
$conn -> set_charset("utf8");
if($user_org == $user_get){
    $queryGet = "SELECT nick, pswd FROM gadu_wiaduser WHERE `nick`='$user_get';";

    $result = mysqli_query($conn, $queryGet);

    if (mysqli_num_rows($result) > 0){
        $record = mysqli_fetch_assoc($result);
        $hashpass = $record['pswd'];

        if(password_verify($pswd, $hashpass)){
            $queryMsg = "DELETE FROM `gadu_wiaduser` WHERE `nick` = '$user_get'";
            $resulttesMsg = mysqli_query($conn, $queryMsg);
            $response_info =  'Konto zamknięte';
            $_SESSION["user"] = '';
            $_SESSION['iduser'] = '';
            $_SESSION["colortheme"] ='';
            $_SESSION['time_sesion'] = '';
            $_SESSION['pc_info'] = '';
            session_destroy() ;
            $link_href = '../index.html';
        } else {
            $response_info = 'Nie ładnie próbować takich rzeczy. To nie jest Twój login lub hasło.';
            $link_href = 'index.php';
        }
    }
}


/*
if($user_org == $user_get){
    $query = "DELETE FROM `gadu_wiaduser` WHERE `nick` = '$user_get' and `pswd`='$pswd'";
    $resulttes = mysqli_query($conn, $query);


    if (mysqli_affected_rows($conn) == 0){
        $response_info = 'Podane konto nie istnieje, Coś podałeś źle';
        $link_href = 'index.php';
    } else {
        $queryMsg = "DELETE FROM `gadu_wiadomosci` WHERE `nick` = '$user_get'";
        $resulttesMsg = mysqli_query($conn, $queryMsg);

        $response_info =  'Konto zamknięte';
        $_SESSION["user"] = '';
        $_SESSION['iduser'] = '';
        $_SESSION["colortheme"] ='';
        $_SESSION['time_sesion'] = '';
        $_SESSION['pc_info'] = '';
        session_destroy() ;
        $link_href = '../index.html';
    }
} else {
    $response_info = 'Nie ładnie próbować takich rzeczy. To nie jest Twój login.';
    $link_href = 'index.php';
}
*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style-colors.css">
    <link rel="stylesheet" href="style.css">

    <?php 
if(isset($_SESSION['colortheme'])){
    echo "<style>
    :root{
    --background-color: var(--".$_SESSION['colortheme']."palet-color2);
    --border-color: var(--".$_SESSION['colortheme']."palet-color4);
    --background-container-color: var(--".$_SESSION['colortheme']."palet-color3);
    --container-inside-border-color: var(--".$_SESSION['colortheme']."palet-color4);
    --background-screen:var(--".$_SESSION['colortheme']."palet-color5);
    --background-contactlist:var(--".$_SESSION['colortheme']."palet-color5);
    --background-newusermsg:var(--".$_SESSION['colortheme']."palet-color5);
    --background-contactadd:var(--".$_SESSION['colortheme']."palet-color5);
    }
    </style>";
}?>
<style>
    #cont{
        height: 100px;  
        text-align: center;
        font-size: 1.1em;
    }
</style>

</head>
<body>
    <div id="cont">
<?php echo $response_info; ?><br><br>
<a href="<?php echo $link_href;?>">POWRÓT</a>
    </div>
</body>
</html>