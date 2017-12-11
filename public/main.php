<?php
  ob_start();
  session_start();
  require_once("includes/functions.php");

  if(isset($_SESSION['id']) == null)
  {
    echo "<h3>You need to <a href='public/log_in.php'>log in</a>..</h3>";
    echo "<h3>{$_SESSION['id']}</h3>";
    die();
  }
  else
  {
    
  }
?>
