<?php
  session_start();
  $prompt=" ";
  if(isset($_SESSION["authenticated"])) {
    if (($connection = mysql_connect("localhost", "root")) === false)
      die("连接Mysql失败");
    if (mysql_select_db($exam_db, $connection) === false)
      die("选择数据库失败");
    if (isset($_POST["tm"]) && isset($_POST["da"])) {
      mysql_query("set names utf8");
      $sql = sprintf("INSERT INTO `%s` (`question`, `answer`) VALUES ('%s', '%s')",
        $exam_table,
        mysql_real_escape_string($_POST["tm"]),
        mysql_real_escape_string($_POST["da"]));
      $sql_insert = mysql_query($sql);
      if ($sql_insert === false) { 
        $prompt ="<br/>提交失败！";
      } 
      else {
        $prompt = "<br/>提交成功！";
      }
    }
  } 
  else {
    $host = $_SERVER["HTTP_HOST"];
    $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
    header("Location: http://$host$path/index.php");
    exit;
  }
?>

