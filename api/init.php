<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
require '../lib/Db.php';
require  '../User.php';
$arr=array("openid"=>"23123","headimgurl"=>"http://www.baidu.com","nickname"=>"大");
/*主要输出当前的用户信息  */
$_SESSION['openid']="111";
$arr=array(
    "type"=>"success",
    "status"=>"1",
    "data"=>array(
        "headimgurl"=>"",
        "name"=>"小明",
        "openid"=>111
    ),
    "str"=>"输出成功"
);
echo json_encode($arr);




