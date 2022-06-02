<?php
/**
 * Created by PhpStorm.
 * User: Zhangbaili
 * Date: 2022/5/27
 * Time: 22:23
 */
//获取通知公告详情
require_once ('../Common.php');
require_once ('../conn.php');
require_once ('../Result.php');
require_once ('replacePicUrl.php');
$id = $_GET['id'];
$sql = "select * from news where id = ".$id;
$stmt = mysqli_query($link,$sql);
$data = mysqli_fetch_assoc($stmt);
$result = new Result();
if($data){
   //$data['content'] = replacePicUrl::replace( $data['content'],'http://172.20.10.6/one');
    $data['content'] =  preg_replace('/(<img.+?src=")(.*?)/','$1http://172.20.10.6/one$2', $data['content']);
  //  preg_replace('/(<img.+?src=")(.*?)/','$1http://www.baidu.com$2', $img);
    $data['createtime'] = date('Y-m-d H:i');
   $result->status = 1;
   $result->data = $data;
   $result->msg = '查询成功';
   echo json_encode($result);
   exit;
}else{
   $result->status = 0;
   $result->msg = '查询失败';
   echo json_encode($result);
}