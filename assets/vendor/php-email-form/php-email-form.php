<?php
require_once __DIR__ . '/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/SMTP.php';
require_once __DIR__ . '/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // إعدادات SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mohamedessamdev07@gmail.com'; // ✉️ ايميلك
        $mail->Password = 'mope tcbk nljn zdeq'; // 🔑 App Password من Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // بيانات المرسل والمستقبل
        $mail->setFrom($email, $name);
        $mail->addAddress('mohamedessamdev07@gmail.com'); // نفس ايميلك

        // محتوى الرسالة
        $mail->isHTML(true);
        $mail->Subject = "New message from: $name - $subject";
        $mail->Body    = "
            <h3>You received a new message</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong><br>$message</p>
        ";

        $mail->send();
        echo 'OK';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request method.";
}
?>
