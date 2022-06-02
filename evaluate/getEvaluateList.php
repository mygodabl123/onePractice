<?php
/**
 * Created by PhpStorm.
 * User: Zhangbaili
 * Date: 2022/5/30
 * Time: 20:51
 */
//获取评估列表
require_once ('../Result.php');
require_once ('../conn.php');

$user_id = isset($_GET['user_id']) ? $_GET['user_id'] :null;
$result = new Result();
if(empty($user_id)){
    $result->msg = '用户参数缺失';
    $result->status = 0;
    echo json_encode($result);
    exit;
}
$sql = "select a.*,b.name as username from evaluate a left join user b on a.user_id = b.id where a.user_id=".$user_id;
//echo $sql;
//exit;
$stmt = mysqli_query($link,$sql);
$length = mysqli_num_rows($stmt);
$data = array();
for($i = 0 ; $i < $length;$i++){
    $item = mysqli_fetch_assoc($stmt);
    $item['createtime'] = date('Y-m-d H:i:s',$item['createtime']);
    $data[] = $item;
}
$result->status = 1;
$result->data = $data;
$result->msg = '查询成功';
echo json_encode($result);
exit;