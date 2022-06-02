<?php
/**
 * Created by PhpStorm.
 * User: Zhangbaili
 * Date: 2022/5/30
 * Time: 10:32
 */
//保存患者评价
require_once ('../Result.php');
require_once ('../Common.php');
require_once ('../conn.php');
$result = new Result();
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
if(empty($user_id)){
    $result->status = 0;
    $result->msg = '被评人参数缺失';
    echo Common::objectToJson($result);
    exit;
}
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$comment = $_POST['content'];
$allScore = $_POST['allScore'];
$curtime = time();
$sql = "insert into evaluate(user_id,name,mobile,comment,score,createtime) values(".$user_id.",'".$name."','".$mobile."','".$comment."','".$allScore."','".$curtime."')";
$stmt = mysqli_query($link,$sql);
$result = new Result();
if($stmt == 1){
    $result->status = 1;
    $result->msg = '保存成功';
    echo json_encode($result);
    exit;
}else{
    $result->status = 0;
    $result->msg = '保存失败';
    echo json_encode($result);
    exit;
}