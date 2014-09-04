<?php

session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
    header("Location: /dashboard/login");
}
else{
    require("../database.php");
    require("../userLog.php");

    $username = $_SESSION['username'];
    $data = my_query('s', array(&$username), "SELECT * FROM user WHERE username = ?");
    $userID = $data['ID'];

    recordEvent('log out', $userID);

    if(session_destroy())
    {
        header("Location: /dashboard/login");
    }
}