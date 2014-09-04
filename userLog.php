<?php

require 'database.php';

function recordEvent($eventType, $userID){
    $sql = 'INSERT INTO audit(userID, event, timestamp) values (?,?,?)';

    date_default_timezone_set('America/Los_Angeles');
    $date = new DateTime();
    $time = $date->format('Y-m-d H:i:s');

    $param = array(&$userID, &$eventType, &$time);

    my_update('iss', $param, $sql);
}
