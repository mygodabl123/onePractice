<?php
/**
 * 整个系统回复请求的核心类
 * 该类用于向页面回复请求
 * @author mao
 */
class Result{
    //状态码   一般定义 1 是成功
    public $status;
    //回复信息
    public $msg;
    //回复数据
    public $data;
    //其他数据
    public $other;
}