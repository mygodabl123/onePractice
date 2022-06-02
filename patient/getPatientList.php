<?php
/**
 * Created by PhpStorm.
 * User: Zhangbaili
 * Date: 2022/5/26
 * Time: 21:14
 */
require_once ('../conn.php');
require_once ('../Result.php');
require_once ('../Common.php');
$key = $_GET['key'];
$limit = $_GET['limit'];
$page = $_GET['page'];
$offset = ($page-1)*$limit;
$where = "";
if(!empty($key)){
    $where = " where name like '%".$key."%'";
}
$sql = "select * from patient".$where." limit ".$offset.",".$limit;
$stmt = mysqli_query($link,$sql);
$data = array();
while($row = $stmt->fetch_array()){
   $item = array();
   $item['name'] = $row['name'];
   $item['age'] = $row['age'];
   $item['gender'] = $row['gender'];
   $data[] = $item;

}
$result = new Result();
$result->status = 1;
$result->data = $data;
$result->msg = '查询成功';
echo Common::objectToJson($result);
exit;


