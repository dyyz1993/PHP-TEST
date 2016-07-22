<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
require '../lib/Db.php';

if(isset($_SESSION['openid'])||isset($_REQUEST['openid'])){
    $openid=$_SESSION['openid']||$_REQUEST['openid'];
    $reusltArr=array(
        "type"=>"success",
        "status"=>1,
        "data"=>array(
            "info"=>query($openid),
            "list"=>queryList($openid)
        )
        
        
    );
    echo json_encode($reusltArr);
    
}else {
        
    echo "openid缺失";
}
function query($openid){

    return Db::instance('user')->select("*")->from('user')->where("openid='$openid'")->row();

}


function queryList($openid){
    $other=Db::instance('user')->select("*")->from('user_gift')->where("openid!='$openid'")->limit(30)->query();
    $self = Db::instance('user')->select("*")->from('user_gift')->where("openid='$openid'")->query();
    return array("self"=>$self,"other"=>$other);
    
}