<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require './vendor/autoload.php';

Class Mail {

    public static function enviarGmail()
    {
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'ssl://smtp.gmail.com';                    //Set the SMTP server to send through
        $mail->SMTPAuth   = TRUE;                                   //Enable SMTP authentication
        $mail->Username   = "infoneteg7@gmail.com";                     //SMTP username
        $mail->Password   = "tggvslsdporwtjqj";//"Infoneteg7$$";                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;  

        //Recipients
            //Recipients
            $mail->setFrom('infoneteg7@gmail.com', 'Infonete');
            $mail->AddAddress('fernando.icardi@gmail.com', 'Fer');     //Add a recipient        

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    }
    public static function enviar()
    {
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'in-v3.mailjet.com'; // host
        $mail->SMTPAuth = true;
        $mail->Username = '0636caf5f5b78c027a0866e0120855f7'; //username
        $mail->Password = '010b66f35896354646038903517b7ec9'; //password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;  
        
        $mail->setFrom('fernando.icardi@gmail.com', 'infonete');
        $mail->addAddress('fernando.icardi@hotmail.com', 'Fer');
      
        $mail->isHTML(true);
        $mail->Subject = 'Email Subject';
        $mail->Body    = '<b>Email Body</b>';
      
        $mail->send();
        echo 'Email sent successfully.';
    } catch (Exception $e) {
        echo 'Email could not be sent. Mailer Error: '. $mail->ErrorInfo;
    }
}
    
}