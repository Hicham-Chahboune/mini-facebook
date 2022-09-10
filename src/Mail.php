<?php
require_once __DIR__.'/smtp/PHPMailerAutoload.php';
class Mail
{
    public function __construct()
    {
        
        
    }
    function send_mail($recipient,$subject,$message)
        {
        
          $mail = new PHPMailer();
          $mail->IsSMTP();
        
          $mail->SMTPDebug  = 0;  
          $mail->SMTPAuth   = TRUE;
          $mail->SMTPSecure = "ssl";
          $mail->Port       = 465;
          $mail->Host       = "smtp.gmail.com";
          //$mail->Host       = "smtp.mail.yahoo.com";
          $mail->Username   = "info.software.ensas@gmail.com";
          $mail->Password   = "jee2022.";
        
          $mail->IsHTML(true);
          $mail->AddAddress($recipient, "esteemed customer");
          $mail->SetFrom("info.software.ensas@gmail.com", "My website");
          //$mail->AddReplyTo("reply-to-email", "reply-to-name");
          //$mail->AddCC("cc-recipient-email", "cc-recipient-name");
          $mail->Subject = $subject;
          $content = $message;
        
          $mail->MsgHTML($content); 
          if(!$mail->Send()) {
            //echo "Error while sending Email.";
            //echo "<pre>";
            //var_dump($mail);
            return false;
          } else {
            //echo "Email sent successfully";
            return true;
          }
        
        }

    
}