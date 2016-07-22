<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://api.weimi.cc/2/sms/send.html");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_POST, TRUE);
/*
短信接口一，自写短信内容。该接口提交的短信均由人工审核，下发后请联系在线客服。适合：节假日祝福、会员营销群发等。
1、设定微米账号的接口UID和接口密码
2、传入目标手机号码，多个以“,”分隔，一次性调用最多100个号码，示例：139********,138********
3、传入短信内容。必须设置好短信签名，签名规范：
	1）短信内容一定要带签名，签名放在短信内容的最前面；
	2）签名格式：【***】，签名内容为三个汉字以上（包括三个）；
	3）短信内容不允许双签名，即短信内容里只有一个“【】”
*/
curl_setopt($ch, CURLOPT_POSTFIELDS, 'uid=<enter your UID>&pas=<enter your UID Pass>&mob=<enter your mobiles>&con='.urlencode('【微米网】尊敬的用户，您的手机验证码是：fgrwah，3分钟内有效。请不要把此验证码泄露给任何人，以便您能安全使用。‍').'&type=json');
$res = curl_exec( $ch );
curl_close( $ch );
echo($res);
/*
注意：以上参数传入时不包括“<>”符号
*/
?>