<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require './vendor/autoload.php';

Class Mailer 
{

    public function ConfigurarServidor()
    {
        $mail = new PHPMailer(true);

        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth   = TRUE;
        $mail->Username   = "infoneteg7@gmail.com";
        $mail->Password   = "tggvslsdporwtjqj";//"Infoneteg7$$";
        $mail->SMTPOptions = array('ssl' => array('verify_peer' => false,
                                                    'verify_peer_name' => false,
                                                    'allow_self_signed' => true)
                                                    );
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;  

        return $mail;            
    }

    public function EnviarMail($nombre, $email)
    {
        try{
        $mail = $this->ConfigurarServidor();
        $mail->setFrom('infoneteg7@gmail.com', 'Infonete');
        //$mail->AddAddress('fernando.icardi@gmail.com', 'Fer');     //Add a recipient        
            
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


    // este metodo si funciona
    public function enviar($nombre, $email)
    {

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth   = TRUE;
            $mail->Username   = "infoneteg7@gmail.com";
            $mail->Password   = "tggvslsdporwtjqj";//"Infoneteg7$$";
            $mail->SMTPOptions = array('ssl' => array('verify_peer' => false,
                                                    'verify_peer_name' => false,
                                                    'allow_self_signed' => true)
                                                    );
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;  

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
}
    