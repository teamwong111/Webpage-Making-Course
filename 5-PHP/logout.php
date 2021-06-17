<?php 
  session_start();
  setcookie("user", "", time() - 3600);
  setcookie("pass", "", time() - 3600);
  setcookie(session_name(), "", time() - 3600);
  session_destroy();
  $host = $_SERVER["HTTP_HOST"];
  $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
  header("Location: http://$host$path/index.php");
  exit;
?>

