<?php
session_start();
$appid = "wx313c6213804b6842";  
$secret = "31c8a7181af48204071e67cc6f863624";
$url="http://tx.dyyz1993.com/index.php";
if(empty($_SESSION['user'])){
    if (empty($_GET["code"]) || empty($_GET["state"])){
        //授权第一步
        $url1 = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.urlencode($url).'&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect';
        header("Location:".$url1);  
        exit;
    }
    else{
        $code = $_GET["code"];
        $get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';
        $result = httpGet($get_token_url);
        $json_obj = json_decode($result,true);
        $access_token = $json_obj['access_token'];
        $openid = $json_obj['openid'];
        $_SESSION['user']["openid"] = $openid;
        //根据openid和access_token查询用户信息
        echo   $access_token."\n";
        echo $openid;
        exit();
        $user_info_url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
        $result = httpGet($user_info_url);
        $json_obj = json_decode($result,true);
        $_SESSION['user']=$json_obj;
        //$_SESSION['user']["headimgurl"] = $json_obj['headimgurl'];
        //$_SESSION['user']["nickname"] = $json_obj['nickname'];
        header("Location:".$url);  
        exit;
    }
}
function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_URL, $url);

    $res = curl_exec($curl);
    curl_close($curl);
    return $res;
}
var_dump($_SESSION['user']);
?>