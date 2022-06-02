<?php
     $serve = 'localhost:3306';
     $username = 'root';
     $password = 'root';
      $dbname = 'one';
      $link = mysqli_connect($serve,$username,$password,$dbname)  or die("数据库链接错误");
      mysqli_set_charset($link,'UTF8'); // 设置数据库字符集
 ?>