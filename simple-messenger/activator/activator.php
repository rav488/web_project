<?php
session_start();

if(!isset($_SESSION['user'])){
    echo "<script>location.href='index.html'</script>";
}


?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administracyjny</title>
    <link rel="stylesheet" href="css/activator.css">
</head>
<body>
    <h3>Witamy w panelu obsługi użytkowników.</h3>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Nick</th>
                <th>Status</th>
                <th>Aktywuj</th>
                <th>Zablokuj</th>
                <th>Usuń</th>
                <th>Nowe Hasło</th>
                <th>Zmień Hasło</th>
                <th>Info</th>
            </tr>
        </thead>
        <tbody id="userList"></tbody>
    </table>
    <hr>
    <button id="logout">LOGOUT</button>
<script src="js/active_app.js"></script>
</body>
</html>