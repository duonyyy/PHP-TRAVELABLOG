    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    include "admin/database/database.php";
    include "admin/database/mailsettings.php";
    include "admin/database/subscribers.php";

    $database = new database();
    $db = $database->connect();

    $mailsettings = new mailsettings($db);
    $mailsettings->id = 1;
    $mailsettings->read();

    //Load Composer's autoloader
    require 'admin/mail/vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    if(!empty($_POST['email'])){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        
        $title = "Mail contact from visitor";
        
        try{
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $mailsettings->mail_server;             //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $mailsettings->mail_username;           //SMTP username
            $mail->Password   = $mailsettings->mail_password;           //SMTP password
            $mail->Port       = $mailsettings->mail_port;               //TCP port to connect to
            $mail->CharSet    = 'utf-8';
            
            //Recipients
            $mail->setFrom($mailsettings->email, 'Support');
            $mail->addAddress($mailsettings->email);                    //Add a recipient
            
            //Content
            $mail->isHTML(true);                                        //Set email format to HTML
            $mail->Subject = $title;
            $mail->Body    = nl2br($message);                           //Convert newlines to <br> tags for HTML email content
            
            $mail->send();
            echo "success";
        }catch(Exception $e){
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    ?>


    
        
