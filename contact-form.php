<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'] ?? "";
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validate form fields
    $errors = [];

    if (empty($name)) {
        $errors[] = 'Name is required.';
    }

  

    if (empty($phone)) {
        $errors[] = 'Phone is required.';
    }

    if (empty($subject)) {
        $errors[] = 'Subject is required.';
    }

    if (empty($message)) {
        $errors[] = 'Message is required.';
    }

    // If there are no validation errors, send data via email
    if (empty($errors)) {
        $to = 'info@cosnovix.com'; // Replace with the recipient email address
        $subject = 'New Contact Form Submission';
        $messageBody = "Name: $name\n";
        $messageBody .= "Email: $email\n";
        $messageBody .= "Phone: $phone\n";
        $messageBody .= "Subject: $subject\n";
        $messageBody .= "Message: $message\n";

        // Send email
        $headers = "From: info@cosnovix.com\r\n";
        if (mail($to, $subject, $messageBody, $headers)) {
            // Email sent successfully
            $response = ['success' => true];
        } else {
            // Error sending email
            $response = ['success' => false, 'message' => 'Error sending your message. Please try again later.'];
        }
    } else {
        // Validation errors occurred
        $response = ['success' => false, 'errors' => $errors];
    }

    echo json_encode($response);
}
?>
