<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
require_once  '../lib/Db.php';

/**
 * 该用户是否有抽奖资格
 * 上一次的抽奖时间
 */
$openid=$_SESSION['openid']; 

$times = getRaffleTimes($openid);

$arr=array(
    "type"=>"success",
    "status"=>1,
    "times"=>$times
);

echo json_encode($arr);

function getRaffleTimes($openid){
    $result =Db::instance('user')->select("lastTime")->from('user')->where("openid='$openid'")->single();
    if($result&&$result==date("Y/m/d"))
    {
        //不能抽奖
        return 0;
    }else{
        //可以抽奖
        return 1;
    }
}
