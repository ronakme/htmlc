<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['ronakzgupta@gmail.com'];
    $subject = $_POST['subject'];
    $tableNumber = $_POST['tableNumber'];
    
    // Extract the PDF file from the form data
    $pdfFile = $_FILES['receipt']['tmp_name'];
    $pdfFileName = $_FILES['receipt']['name'];

    $message = ",\n\nPlease find your order receipt attached.\n\nTable Number: $tableNumber\n\n";
    
    $boundary = md5(time());

    // Email headers
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "From: Your Restaurant <no-reply@yourdomain.com>\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

    // Email body
    $body = "--$boundary\r\n";
    $body .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $body .= $message . "\r\n\r\n";

    // Attach the PDF
    $body .= "--$boundary\r\n";
    $body .= "Content-Type: application/pdf; name=\"$pdfFileName\"\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n";
    $body .= "Content-Disposition: attachment; filename=\"$pdfFileName\"\r\n\r\n";
    $body .= chunk_split(base64_encode(file_get_contents($pdfFile))) . "\r\n";
    $body .= "--$boundary--";

    // Send the email
    if (mail($email, $subject, $body, $headers)) {
        echo 'Email sent successfully.';
    } else {
        echo 'Failed to send email.';
    }
} else {
    echo 'Invalid request method.';
}
?>
