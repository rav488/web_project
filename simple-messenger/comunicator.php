<?php
session_start();

if(isset($_SESSION['user'])){
    echo "<script>var user='".$_SESSION['user']."';</script>";
} else {
    echo "<script>location.href='index.html'</script>";
}

if($_SESSION['pc_info'] != $_SERVER['HTTP_USER_AGENT']){
    $_SESSION["user"] = '';
    $_SESSION['iduser'] = '';
    $_SESSION["colortheme"] ='';
    $_SESSION['time_sesion'] = '';
    $_SESSION['pc_info'] = '';
    session_destroy() ;
    echo "<script>location.href='index.html'</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-colors.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Komunikator</title>
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
}
    ?>
</head>
<body>
    <div id="cont">
        
        <div id="contactlist"></div>
        <div id="newusermsg"></div>
        <div id="contactadd">
            <input type="text" id='addName'><br><br>
            <button id='addConBtn'>DODAJ</button><br>
            <span id="addInfo"></span>
        </div>
        
        <form id="getmsg">
            <div id="nickscr"><img src="images/logo-no-background.png" id="logo">Nick: <input type="text" id="inpnick" readonly="readonly"><button id='logout'>LOGOUT</button><button id='settings'><img id="settingsico" src="images/setting.png"></button> <br><br></div>
            <div id="screen"></div>
            <textarea id="msgtext"></textarea><br><br>
            <button id="sendbtn">Wyślij</button>

        </form>
        
    </div>
    <script src="js/app.js"></script>
</body>
</html>