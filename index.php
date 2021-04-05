<?php
// 调用方法
// file_get_contents("https://bug.ijysc.com/index.php?p=qwer1234&m=1165198170@qq.com&s=订单通知&b=<p>哈哈<br>哈</p>");


// 设置访问密码
$pass_set = "qwer1234";
$pass_get = $_GET["p"];
if ($pass_get != $pass_set) {echo "<p>禁止访问！</p>"; die;}

// 获取推送信息
$to_mail_get = $_GET["m"];
$to_subject = $_GET["s"];
$to_body = $_GET["b"]; //支持HTML

header("Content-type: text/html;charset=utf-8");
require 'phpmailer/class.phpmailer.php';
require 'phpmailer/class.smtp.php';

// 设置推送邮箱
$mail = new PHPMailer();

// $mail->CharSet = "GB2312";
$mail->CharSet = "UTF-8";
$mail->Encoding = "base64";

$mail->isSMTP(); //开启smtp
$mail->Host = 'smtp.aliyun.com'; //设置smtp地址
$mail->Port = '465'; //设置smtp端口
$mail->SMTPSecure = 'ssl'; //加密
$mail->SMTPAuth = true; //smtp认证开启

$mail->setFrom('huiyuanhezi@aliyun.com', '会员盒子'); //设置发送者，一般和username相同。后面填写简称
$mail->Username = 'huiyuanhezi@aliyun.com'; //发送者邮件地址
$mail->Password = 'qwer1234'; //密码

$mail->addAddress($to_mail_get); //添加接受者
$mail->Subject = $to_subject; //邮件主题
$mail->isHTML(); //邮件正文使用html
$mail->Body = $to_body; //邮件正文
// $mail->addAttachment('D:\myweb\www\resume.html', '简历.zip'); //如果没有附件需求，删除该行即可

// 推送邮件
if(!$mail->Send()) {
    echo "推送失败，错误代码：" . $mail->ErrorInfo;
} else {
    echo "邮件推送成功。";
}

?>
