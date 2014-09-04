<?php
  session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
    header("Location: /dashboard/login");
}
else{

    try{
        $username = $_SESSION['username'];
        $data = my_query('s', array(&$username), "SELECT id FROM user WHERE Username = ?");
        $id = $data['id'];

        require '../userLog.php';
        recordEvent('log out', $id);
    }
    catch (Exception $e){
        echo $e->getMessage();
    }

  if(session_destroy())
  {
    header("Location: /dashboard/login");
  }

}