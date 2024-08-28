<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    
    require '../assets/class/databaseClass.php';
    require '../assets/class/function.class.php';

    require '../assets/packages/phpmailer/src/Exception.php';
    require '../assets/packages/phpmailer/src/PHPMailer.php';
    require '../assets/packages/phpmailer/src/SMTP.php';

    if ($_POST){
        $post = $_POST;
        if($post['email_id']){
            $email_id = $db->real_escape_string($post['email_id']);
            $result = $db->query("SELECT id, full_name FROM users WHERE(email_id='$email_id')");
            $result = $result->fetch_assoc();
            if($result){
                $otp = rand(100000, 999999);
                $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'nahlohkokaneh@gmail.com';                     //SMTP username
    $mail->Password   = '';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('verify@resumebuilder.com', 'Resume builder');
    $mail->addAddress($email_id);     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Forgot password';
    $mail->Body    = 'Your 6 digit verification code: <b>'.$otp.'</b> <br><br>Hello there, <br>It seems that you have requested a password reset for your account on Resume builder. Do not worry, we are here to help you get back into your account safely. <br><br>To reset your password, please use the verification code. <br>For your security, the link will expire in 60 minutes. After this period, you will need to initiate the reset process again.';

    $mail->send();
    $fn->setSession('otp', $otp);
    $fn->setSession('email', $email_id);
    $fn->redirect('../verification.php');
} catch (Exception $e) {
    $fn->setError($mail->ErrorInfo);
    $fn->redirect('../forgot-password.php');
}
            }
        } else{
            $fn->setError($email_id.' is not registered');
            $fn->redirect('../forgot-password.php');
        }
    }else{
        $fn->setError('Please fill the form');
        $fn->redirect('../forgot-password.php');
    }
?>