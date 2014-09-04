<?php

require 'database.php';

function recordEvent($eventType, $userID){
    $sql = 'INSERT INTO audit(userID, event, timestamp) values (?,?,?)';

    date_default_timezone_set('America/Los_Angeles');
    $date = new DateTime();

    $param = array(&$userID, &$eventType, &$date);

    my_update('iss', $param, $sql);
}

?>