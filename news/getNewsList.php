<?php
/**
 * Created by PhpStorm.
 * User: Zhangbaili
 * Date: 2022/5/27
 * Time: 21:54
 */
//获取通知公告列表
require_once ('../Result.php');
require_once ('../Common.php');
require_once ('../conn.php');
$sql = "select * from news";
$stmt = mysqli_query($link,$sql);
$data = array();
$result = new Result();
while($row = $stmt->fetch_array()){
    $item = array();
    $item['title'] = $row['title'];
    $item['id'] = $row['id'];
    $item['name'] = $row['name'];
    $item['createtime'] = date('Y-m-d H:i',$row['createtime']);
    $data[] = $item;
}
$result->status = 1;
$result->msg = '查询成功';
$result->data = $data;
echo json_encode($result);
exit;

