<?php
// send_email.php - Sample PHP script for sending email notifications

function sendEmailNotification($materialId, $fileName, $subject, $content) {
    // Include the PHPMailer library (assuming you use PHPMailer for sending emails)
    require 'vendor/autoload.php';  // Include the autoload file for PHPMailer

    // Create a new PHPMailer instance
    $mailer = new PHPMailer\PHPMailer\PHPMailer();

    // Configure email settings (SMTP, sender, etc.)
    $mailer->isSMTP();
    $mailer->Host = 'smtp.example.com';
    $mailer->Port = 587;
    $mailer->SMTPAuth = true;
    $mailer->Username = 'your_smtp_username';
    $mailer->Password = 'your_smtp_password';
    $mailer->setFrom('sender@example.com', 'Your Name');
    $mailer->addAddress('recipient@example.com', 'Recipient Name');

    // Set email subject and content
    $mailer->Subject = $subject;
    $mailer->Body = $content;

    // Send the email
    if ($mailer->send()) {
        // Email sent successfully
        echo 'Email notification sent successfully.';
    } else {
        // Email sending failed
        echo 'Failed to send email notification.';
    }
}

// Example usage (called from trigger)
sendEmailNotification(
    $materialId,
    $fileName,
    $email_subject,
    $email_content
);
?>
