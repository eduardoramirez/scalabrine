<?php
  session_start();

    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $data = my_query('s', array(&$username), "SELECT id FROM user WHERE Username = ?");
        $id = $data['id'];

        require '../userLog.php';
        recordEvent('log out', $id);
    }

  if(session_destroy())
  {
    header("Location: /dashboard/login");
  }
?>