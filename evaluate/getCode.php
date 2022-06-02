<?php
/**
 * Created by PhpStorm.
 * User: Zhangbaili
 * Date: 2022/5/28
 * Time: 8:42
 */
require_once ('../phpqrcode/phpqrcode.php');
require_once ('../Result.php');
require_once ('../Common.php');
$flag = isset($_GET["flag"]) ? intval($_GET["flag"]) : 0;
$user_id = isset($_GET["user_id"]) ? intval($_GET["user_id"]) : null;
$user_name= isset($_GET["user_name"]) ? ($_GET["user_name"]) : null;
$result = new Result();
if(empty($user_id) || empty($user_name)){
    $result->status = 0;
    $result->msg = '用户参数缺失';
    echo Common::objectToJson($result);
    exit;
}
$value="http://192.168.177.202:7000/one/evaluate/index.html?user_id=".$user_id."&user_name=".$user_name;
$errorCorrectionLevel = "L";
$matrixPointSize = "10";

if($flag == 1){
    //返回base64字符串
    ob_start();//开启缓冲区
    QRcode::pngString($value,false,$errorCorrectionLevel,$matrixPointSize);
    $img = ob_get_contents();//获取缓冲区内容
    ob_end_clean();//清除缓冲区内容
    $base64 = 'data:png;base64,' . base64_encode($img);//转base64
    ob_flush();
    $result = new Result();
    $result->status = 1;
    $result->data = $base64;
    echo Common::objectToJson($result);
    exit;
}else {
    ob_end_clean();//清除缓冲区内容
    QRcode::png($value, false, $errorCorrectionLevel, $matrixPointSize);
}
exit;