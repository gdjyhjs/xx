<?php

 echo "你好";

 include 'smtp.class.php';
 
 $relay_host = 'smtp.163.com';
 $user2 = 'thbfio12@163.com';
 $pass = 'a11111';
 $smtp = new smtp($relay_host,25,true,$user2,$pass);
 
 $toemail = 'thbfio12@163.com';
 $from = 'thbfio12@163.com';
 $subject = '测试';
 $message = '邮件测试内容';
 if($smtp->sendmail($toemail,$from,$subject,$message))
 {
 }
 else
 {
 }


?>
