<?php
  session_start();
  if(session_destroy())
  {
    header("Location: /dashboard/login.php");
  }
?>