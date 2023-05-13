<?php
session_start();


$_SESSION['user'] = '';
session_destroy() ;

echo "<script>location.href='../index.html'</script>";
?>