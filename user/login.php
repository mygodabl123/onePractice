<?php
/**登录
 * Created by PhpStorm.
 * User: Zhangbaili
 * Date: 2022/5/22
 * Time: 12:30
 */

require_once('../conn.php');
require_once('../Common.php');
require_once('../Result.php');
$mobile = $_GET['mobile'];
$password = $_GET['password'];
$result = new Result();
$sql = "select * from user where mobile='".$mobile."'";
$stmt = mysqli_query($link,$sql);
$data = mysqli_fetch_assoc($stmt); // 从结果集中获取所有数据
if($data){
    if($password == $data['password']){
        $result->status = 1;
        $result->data = $data;
        $result->msg = '登录成功';
        echo   Common::objectToJson($result);
        exit;
    }else{
        $result->status = 0;
        $result->data = $data;
        $result->msg = '密码错误';
        echo   Common::objectToJson($result);
        exit;
    }

}else{
    $result->status = 0;
    $result->msg = '无该账号';
    echo   Common::objectToJson($result);
    exit;
}




