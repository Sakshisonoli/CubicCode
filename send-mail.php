<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $name = htmlspecialchars($_POST['your-name']);
    $email = filter_var($_POST['your-email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['your-number']);
    $subject = htmlspecialchars($_POST['your-subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "invalid-email";
        exit;
    }

    // Your email address where you want to receive messages
    $to = "kakkerisarvesh@gmail.com"; // Replace with your email
    $email_subject = "New Message from Contact Form: $subject";
    $email_body = "
    You have received a new message from your website contact form.\n\n
    Here are the details:\n
    Name: $name\n
    Email: $email\n
    Phone: $phone\n
    Message:\n$message\n
    ";

    // Email headers
    $headers = "From: no-reply@cubiccode.in\r\n"; // Use a valid domain-based email
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "success"; // Output success message
    } else {
        echo "error"; // Output error message
    }
} else {
    echo "invalid"; // Invalid request
}
?>
