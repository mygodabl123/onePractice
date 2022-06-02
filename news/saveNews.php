<?php
/**
 * Created by PhpStorm.
 * User: Zhangbaili
 * Date: 2022/5/26
 * Time: 14:36
 */
require_once ('../Result.php');
require_once ('../Common.php');
require_once ('../conn.php');

//保存通知公告
$title = $_POST['title'];
$content = $_POST['content'];
$name=$_POST['name'];
$data = time();
$sql = "insert into news(title,content,name,createtime) values ('".$title."','".$content."','".$name."','".$data."')";
$stmt = mysqli_query($link,$sql);
$result = new Result();
if($stmt < 1){
   $result->status = 0;
   $result->msg = '保存失败';
   echo Common::objectToJson($result);
   exit;
}else{
    $result->status = $stmt;
    $result->msg = '保存成功';
    echo Common::objectToJson($result);
    exit;
}

