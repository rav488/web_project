<?php
session_start();


$_SESSION["user"] = '';
$_SESSION['iduser'] = '';
$_SESSION["colortheme"] ='';
$_SESSION['time_sesion'] = '';
$_SESSION['pc_info'] = '';
session_destroy() ;

echo "<script>location.href='../index.html'</script>";
?>