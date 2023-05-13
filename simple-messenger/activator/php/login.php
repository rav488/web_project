<?php
session_start();
$login = $_POST['login'];
$pswd = $_POST['pswd'];

require_once 'data.php';


//password_verify($pswd_get, $hashpass)

if (($login == $org_log)&&(password_verify($pswd, $org_pass))){

    $_SESSION['user'] = $login;
    $yourURLOK = '../activator.php';
    echo "<script>location.href='$yourURLOK'</script>";
} else {
    $yourURLFail = '../index.html';
    echo 'błąd';
    session_destroy() ;
    echo "<script>location.href='$yourURLFail'</script>";
}

?>