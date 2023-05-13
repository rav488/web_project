<?php
session_start();

if(isset($_SESSION['user'])){
    echo "<script>var user='".$_SESSION['user']."';</script>";
} else {
    echo "<script>location.href='../index.html'</script>";
}
if($_SESSION['pc_info'] != $_SERVER['HTTP_USER_AGENT']){
    $_SESSION["user"] = '';
    $_SESSION['iduser'] = '';
    $_SESSION["colortheme"] ='';
    $_SESSION['time_sesion'] = '';
    $_SESSION['pc_info'] = '';
    session_destroy() ;
    echo "<script>location.href='../index.html'</script>";
}
echo "<script>let username = '".$_SESSION['user']."'</script>";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style-colors.css">
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
}
    ?>
</head>
<body>
<div id="cont">
    <hr>
    <form name='colorchange' id='colorchange'>
        Wybierz Skórkę: 
        <select id="colortheme">
            <option value="">Wybierz:</option>
            <option value="black">black</option>
            <option value="blue">blue</option>
            <option value="olive">olive</option>
            <option value="brown">brown</option>
            <option value="green">green</option>
            <option value="retro1">retro1</option>
    </select>
    </form>
    <hr><hr>
        <p>Zmiana hasła dla: <span id="login"><?php echo $_SESSION['user'];?></span></p><hr>
        <form action="changetestpsw.php" method="post" id="changeform" name="changeform">
            Stare hasło: <input type="text" name="old" id="old"><Hr>
            Nowe hasło: <input type="text" name="newone" id="newone"><br><span class='error'></span><br>
            Powtórz: <input type="text" name="newtwo" id="newtwo"><br><span class='error'></span>
            <span id="response"></span><button id="back">Powrót</button><button id="chpsw">Zmień</button>
        </form>

    <hr><spna id="delinfo">SKASUJ KONTO</spna>
    <div id="delbox">
        <form action="dellAcc.php" method='post'>
    NAZWA KONTA <input type="text" id='username' name='username'><br>
    PODAJ HASŁO <input type="password" id='delpswd' name='delpswd'><br>
    <button id='deleteAcc'>USUŃ</button>
    </form>
    <hr>
    </div>
</div>
<script src="chapp.js"></script>

</body>
</html>