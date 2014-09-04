<?php
echo "before start";
  session_start();

echo "after start";
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
    echo 'redirect';
    header("Location: /dashboard/login");
}
else{
echo 'trying';
    try{
        $username = $_SESSION['username'];
        echo $username;
        $data = my_query('s', array(&$username), "SELECT * FROM user WHERE Username = ?");

        $admin = $data['admin'];
        echo $admin;
        $userID = $data['ID'];


echo $userID;
        require '../userLog.php';
        recordEvent('log out', $userID);
    }
    catch (Exception $e){
        echo 'exception';
        echo $e->getMessage();
    }

  if(session_destroy())
  {
    header("Location: /dashboard/login");
  }

}