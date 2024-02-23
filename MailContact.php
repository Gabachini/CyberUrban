<?php
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'cyberurban';

    $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $fname = $conn->escape_string($_POST['fname']);
    $lname = $conn->escape_string($_POST['lname']);
    $email = $conn->escape_string($_POST['email']);
    $subject = $conn->escape_string($_POST['subject']);
    $message = $conn->escape_string($_POST['message']);

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'PHPMailer-master/Exception.php';
    require 'PHPMailer-master/PHPMailer.php';
    require 'PHPMailer-master/SMTP.php';
    
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'poalla22@bemen3.cat';                     //SMTP username
        $mail->Password   = '!3Duc4c10#';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom($email, $fname . ' ' . $lname);
        $mail->addAddress('poalla22@bemen3.cat', 'Joe User');     //Add a recipient
        // ... (other recipients and CC/BCC)
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = "$message <br> Enviado por: $email <br> Nombre: $fname $lname";
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    header("Location: contact.html");
?>