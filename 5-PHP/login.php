<?php
  session_start();
  $prompt = " ";
  if (isset($_POST["user"]) && isset($_POST["pass"]))
  {
    if (($connection = mysql_connect("localhost", "root")) === false)
        die("连接Mysql失败");
    if (mysql_select_db("exam", $connection) === false)
        die("选择数据库失败");
    $sql = sprintf("SELECT 1 FROM users WHERE user='%s' AND pass=AES_ENCRYPT('%s', '%s')",
                    mysql_real_escape_string($_POST["user"]),
                    mysql_real_escape_string($_POST["pass"]),
                    mysql_real_escape_string($_POST["pass"]));
    $result = mysql_query($sql);
    if ($result === false)
        die("无法查询");
    if (mysql_num_rows($result) == 1) {
        $_SESSION["authenticated"] = true;
        $_SESSION["user"] = $_POST["user"];
        $host = $_SERVER["HTTP_HOST"];
        $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
        header("Location: http://$host$path/index.php");
        exit;
    } 
    else {
      $prompt =  "用户名或密码错误！！";
    }
  } 
  require 'utils/header.php';
?>
<h1>用户登录</h1>
<br />
<form action="<?php  print($_SERVER["PHP_SELF"]) ?>" method="post">
  <table>
    <tr>
      <td>用户名:</td>
      <td>
        <input name="user" type="text"></td>
    </tr>
    <tr>
      <td>密码:</td>
      <td><input name="pass" type="password"></td>
    </tr>
    <tr>
      <td></td>
      <td><input type="submit" class="push" value="登陆"></td>
    </tr>
  </table>      
  <p><?php print($prompt) ?></p>
</form>
<?php
  require 'utils/footer.php';
?>
