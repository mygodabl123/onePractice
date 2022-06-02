<?php
/**
 * Created by PhpStorm.
 * User: Zhangbaili
 * Date: 2022/5/26
 * Time: 14:51
 */
require_once ('../Common.php');
//文件要保存的地方
$save_path = 'D:\phpstudy_pro\WWW\one\upload/kindeditor/';
//文件保存目录URL
$save_url =  'http://one/upload/kindeditor/';
//定义允许上传的文件扩展名
$ext_arr = array(
    'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
    'flash' => array('swf', 'flv'),
    'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
    'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
);
//最大文件大小[1M]
$max_size = 1000000;
//有上传文件时
if (empty($_FILES) === false) {
    //原文件名
    $file_name = $_FILES['imgFile']['name'];
    //服务器上临时文件名
    $tmp_name = $_FILES['imgFile']['tmp_name'];
    //文件大小
    $file_size = $_FILES['imgFile']['size'];
    //检查文件名
    if (!$file_name) {
        $result = array('error' => 1, 'message' => "请选择文件。");
        echo Common::objectToJson($result);
        exit;
    }
    //检查目录
    if (@is_dir($save_path) === false) {
        if (!file_exists($save_path)) {
            mkdir($save_path);
        }
    }
    //检查目录写权限
    if (@is_writable($save_path) === false) {
        $result = array('error' => 1, 'message' => "上传目录没有写权限。");
        echo Common::objectToJson($result);
        exit;
    }
    //检查是否已上传
    if (@is_uploaded_file($tmp_name) === false) {
        $result = array('error' => 1, 'message' => "上传失败。");
        echo Common::objectToJson($result);
        exit;
    }
    //检查文件大小
    if ($file_size > $max_size) {
        $result = array('error' => 1, 'message' => "上传文件大小超过限制。");
        echo Common::objectToJson($result);
        exit;
    }
    //检查目录名
    $dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
    if (empty($ext_arr[$dir_name])) {
        $result = array('error' => 1, 'message' => "目录名不正确。");
        echo Common::objectToJson($result);
        exit;
    }
    //获得文件扩展名
    $temp_arr = explode(".", $file_name);
    $file_ext = array_pop($temp_arr);
    $file_ext = trim($file_ext);
    $file_ext = strtolower($file_ext);
    //检查扩展名
    if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
        $result = array('error' => 1, 'message' => "上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr[$dir_name]) . "格式。");
        echo Common::objectToJson($result);
        exit;
    }

    //创建文件夹
    if ($dir_name !== '') {
        $save_path .= $dir_name . "/";
        $save_url .= $dir_name . "/";
        if (!file_exists($save_path)) {
            mkdir($save_path);
        }
    }
    if (!file_exists($save_path)) {
        mkdir($save_path);
    }
    //新文件名
    $new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
    //移动文件
    $file_path = $save_path . $new_file_name;
    if (move_uploaded_file($tmp_name, $file_path) === false) {
        $result = array('error' => 1, 'message' => "上传文件失败。");
        echo Common::objectToJson($result);
        exit;
    }
    @chmod($file_path, 0644);
    $file_url = $save_url . $new_file_name;
    header('Content-type: text/html; charset=UTF-8');
    $result = array('error' => 0, 'message' => '','url' => $file_url);
    echo Common::objectToJson($result);
    exit;
}else{
    $result = array('error' => 1, 'message' => "无上传文件");
    echo Common::objectToJson($result);
    exit;
}
