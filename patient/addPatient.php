<?php
/**
 * Created by PhpStorm.
 * User: Zhangbaili
 * Date: 2022/5/26
 * Time: 21:23
 */
require_once ('../Result.php');
require_once ('../Common.php');
require_once ('../conn.php');
$name = $_GET['name'];
$gender = $_GET['gender'];
$age = $_GET['age'];
$createtime = time();
$sql = "insert into patient(name,gender,age,createtime) values ('".$name."','".$gender."',".$age.",'".$createtime."')";
//echo $sql;
//exit;
$stmt = mysqli_query($link,$sql);
$result = new Result();
if($stmt < 1){
    $result->status = 0;
    $result->msg = '添加失败';
    echo Common::objectToJson($result);
    exit;
}else{
    $result->status = 1;
    $result->data = 1;
    $result->msg = '添加成功';
    echo Common::objectToJson($result);
    exit;
}