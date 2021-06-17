<?php
  session_start();
  $prompt = " ";
  if (isset($_POST["user"]) && isset($_POST["pass1"]) && isset($_POST["pass2"]))
  {
    if (($connection = mysql_connect("localhost", "root")) === false)
      die("连接Mysql失败");
    if (mysql_select_db("exam", $connection) === false)
      die("选择数据库失败");
    $name = sprintf("SELECT 1 FROM `users` WHERE `user` = '%s'", mysql_real_escape_string($_POST["user"]));
    $result = mysql_query($name);
    if (mysql_num_rows($result) == 0) {
      $sql = sprintf("INSERT INTO `users` (`user`, `pass`) VALUES ('%s' , AES_ENCRYPT('%s', '%s'))",
                      mysql_real_escape_string($_POST["user"]),
                      mysql_real_escape_string($_POST["pass1"]),
                      mysql_real_escape_string($_POST["pass1"]));
      $result = mysql_query($sql);
      if ($result === false) {
        die("无法查询");
      }
      else {
        $_SESSION["authenticated"] = true;
        $_SESSION["user"] = $_POST["user"];
        $host = $_SERVER["HTTP_HOST"];
        $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
        header("Location: http://$host$path/index.php");
        exit;
      }
    } 
    else {
      $prompt = "用户名已存在，请重新输入";
    }
  }
  require 'utils/header.php';
?>
<script>
  function validate()  {
    if (document.forms.registration.user.value == "") {
      alert("用户名不能为空");
      return false;
    }
    else if (document.forms.registration.pass1.value == "") {
      alert("密码不能为空");
      return false;
    }
    else if (document.forms.registration.pass1.value != document.forms.registration.pass2.value) {
      alert("两次必须输入同样的密码");
      return false;
    }
    return true;
  }
</script>
<h1>用户注册</h1>
<br />
<form action="<?php  print($_SERVER["PHP_SELF"]) ?>" method="post" name="registration" onsubmit="return validate();">
<table>
  <tr>
    <td>用户名:</td>
    <td><input name="user" type="text"></td>
  </tr>
  <tr>    
    <td>设置密码:</td>
    <td><input name="pass1" type="text"></td>
  </tr>
  <tr>      
    <td>确认密码:</td>
    <td><input name="pass2" type="text"></td>
  <tr>
    <td></td>
    <td><input type="submit" class="push" value="注册"></td>
  </tr>
</table>   
</form>
<p><?php print($prompt) ?></p>
<?php
  require 'utils/footer.php';
?>