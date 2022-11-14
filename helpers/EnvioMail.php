<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
            
    require ('dependencies/PHPMailer/PHPMailer.php');
    require ('dependencies/PHPMailer/SMTP.php');
    require ('dependencies/PHPMailer/Exception.php');

Class EnvioMail {

    public static function enviar()
    {
        //Crear una instancia de PHPMailer
        $mail = new PHPMailer(true);
        //Definir que vamos a usar SMTP
        $mail->IsSMTP();
        //Esto es para activar el modo depuración. En entorno de pruebas lo mejor es 2, en producción siempre 0
        // 0 = off (producción)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug  = 2;
        //Ahora definimos gmail como servidor que aloja nuestro SMTP
        $mail->Host       = 'smtp.gmail.com';
        //El puerto será el 587 ya que usamos encriptación TLS
        $mail->Port       = 587;
        //Definmos la seguridad como TLS
        $mail->SMTPSecure = 'TLS';

        //Tenemos que usar gmail autenticados, así que esto a TRUE
        $mail->SMTPAuth   = true;        
        //Definimos la cuenta que vamos a usar. Dirección completa de la misma
        $mail->Username   = "infoneteg7@gmail.com";
        //Introducimos nuestra contraseña de gmail
        $mail->Password   = "tggvslsdporwtjqj";//"Infoneteg7$$";
        //Definimos el remitente (dirección y, opcionalmente, nombre)
        $mail->SetFrom('infoneteg7@gmail.com', 'Infonete Noticias');
        //Y, ahora sí, definimos el destinatario (dirección y, opcionalmente, nombre)
        $mail->AddAddress('fernando.icardi@gmail.com', 'Fer');
        //Definimos el tema del email
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Esto es un correo de prueba';
        //Para enviar un correo formateado en HTML lo cargamos con la siguiente función. Si no, puedes meterle directamente una cadena de texto.
        //$mail->MsgHTML(file_get_contents('correomaquetado.html'), dirname(ruta_al_archivo));
        //Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
        $mail->Body = 'Por favor ingrese al siguiente link para poder verificar su cuenta';
        $mail->AltBody = 'This is a plain-text message body';
        //Enviamos el correo
        if(!$mail->Send()) {
        return "Error: " . $mail->ErrorInfo;
        } else {
            return  "Enviado!";
        }        
    }

    public static function Test()
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = "infoneteg7@gmail.com";                     //SMTP username
            $mail->Password   = "tggvslsdporwtjqj";//"Infoneteg7$$";                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
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
?>