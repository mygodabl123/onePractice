<?php
/**注册
 * Created by PhpStorm.
 * User: Zhangbaili
 * Date: 2022/5/22
 * Time: 14:52
 */
require_once ('../conn.php');
require_once ('../Result.php');
require_once ('../Common.php');

$name = $_GET['name'];
$mobile = $_GET['mobile'];
$email = $_GET['email'];
$gender = $_GET['gender'];
$password = $_GET['password'];
$cutime = time();
//限查找该电话是否注册过
$sql = "select * from user where mobile='".$mobile."'";
$stmt = mysqli_query($link,$sql);
$data = mysqli_fetch_assoc($stmt); // 从结果集中获取所有数据
$result = new Result();
if($data){
    $result->status = 0;
    $result->msg = '该电话已被注册！';
    echo Common::objectToJson($result);
    exit;
}
$sql = "insert into user(name,mobile,email,gender,password,createtime) values ('".$name."',".$mobile.",'".$email."',".$gender.",'".$password."','".$cutime."')";
$stmt = mysqli_query($link,$sql);
if ($stmt < 1) {
   $result->status = 0;
   $result->msg = '注册失败';
   echo Common::objectToJson($result);
   exit;
}
$result->status = 1;
$result->msg = '注册成功';
echo Common::objectToJson($result);
exit;


