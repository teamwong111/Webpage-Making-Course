<?php 
  $exam_db = "exam";
  $exam_table = "judge";
  include 'utils/header.php';
?>
<script>
  $(document).ready(function(){
    $("#xs").click(function(){
      $("#da").toggle();
    });
  });
</script>
<h1>判断题测试</h1>
<a href="index.php">返回主页</a>
<a href="add-judge.php">添加题目</a>
<?php
  include 'utils/problem.php';
?>
<br/>
<?php
  include 'utils/footer.php'; 
?>
