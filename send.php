<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

// Sanitize input
$firstName = htmlspecialchars($_POST['Fname'] ?? '');
$lastName = htmlspecialchars($_POST['Lname'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$phone = htmlspecialchars($_POST['phone'] ?? '');
$message = htmlspecialchars($_POST['message'] ?? '');

$responseMessage = "";

if (!$firstName || !$email || !$message) {
    $responseMessage = "❌ Please fill in all required fields.";
} else {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'test.email.abdullah.831@gmail.com';  // your Gmail
        $mail->Password = 'vaczoeqjkxlnbizd';                   // your app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Recipients
        $mail->setFrom($email, "$firstName $lastName");
        $mail->addAddress('test.email.abdullah.831@gmail.com'); // your Gmail

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Message From Website";
        $mail->Body = "
            <h3>New Contact Form Submission</h3>
            <p><strong>Name:</strong> $firstName $lastName</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Message:</strong><br>$message</p>
        ";

        $mail->send();
        $responseMessage = "✅ Your message has been sent successfully!<br>Thank you, <strong>$firstName $lastName</strong>.";
    } catch (Exception $e) {
        $responseMessage = "❌ Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Message Status</title>
    <style>
        body {
            background-color: #1f242d;
            color: #00ffff;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        .box {
            font-family: Bodoni MT, Didot, Didot LT STD, Hoefler Text, Garamond, Times New Roman, serif;
            background-color: #000;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px #00ffff;
            display: inline-block;
        }
        a {
            display: block;
            margin-top: 20px;
            color: #00ffff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>Form Response</h2>
        <p><?= $responseMessage ?></p>
        <a href="index.html">← Go Back</a>
    </div>
</body>
</html>
