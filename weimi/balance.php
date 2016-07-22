<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://api.weimi.cc/2/account/balance.html");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_POST, TRUE);
/*
设定微米账号的接口UID和接口密码
*/
curl_setopt($ch, CURLOPT_POSTFIELDS, 'uid=<enter your UID>&pas=<enter your UID Pass>&type=json');
$res = curl_exec( $ch );
curl_close( $ch );
echo($res);
/*
注意：以上参数传入时不包括“<>”符号
*/
?>