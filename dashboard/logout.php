<?php
  session_start();

    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $data = my_query('s', array(&$username), "SELECT ID FROM user WHERE Username=?");
        $id = $data['ID'];

        require '../database.php';
        recordEvent('log out', $id);
    }

  if(session_destroy())
  {
    header("Location: /dashboard/login");
  }
?>