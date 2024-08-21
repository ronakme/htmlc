<?php
// order_success.php

session_start();

// Assuming you have saved the order details and email in the session
$orderDetails = $_SESSION['orderDetails'];
$customerEmail = $_SESSION['customerEmail'];

// Function to send an email
function sendReceiptEmail($email, $orderDetails) {
    $subject = "Your Order Receipt";
    $message = "Thank you for your order!\n\nHere are your order details:\n\n";
    foreach ($orderDetails as $item) {
        $message .= "{$item['name']} - {$item['quantity']} x {$item['price']}\n";
    }
    $message .= "\nTotal: {$orderDetails['total']}\nPayment Method: Cash";
    $headers = "From: no-reply@yourdomain.com";

    mail($email, $subject, $message, $headers);
}

// Send the email as soon as the page loads
sendReceiptEmail($customerEmail, $orderDetails);

// Function to generate receipt content
function generateReceipt($orderDetails) {
    $receipt = "Receipt\n\n";
    foreach ($orderDetails as $item) {
        $receipt .= "{$item['name']} - {$item['quantity']} x {$item['price']}\n";
    }
    $receipt .= "\nTotal: {$orderDetails['total']}\nPayment Method: Cash";
    return $receipt;
}

// Generate receipt content for downloading
$receiptContent = generateReceipt($orderDetails);
$receiptFileName = "receipt_" . time() . ".txt";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Placed Successfully</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #ff758c, #ff7eb3);
            color: #fff;
            text-align: center;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 50px;
            border-radius: 15px;
        }

        .container h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        .container p {
            font-size: 1.2em;
            margin-bottom: 40px;
        }

        .btn {
            padding: 15px 30px;
            font-size: 1.2em;
            color: #fff;
            background-color: #ff758c;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #ff7eb3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Placed Successfully!</h1>
        <p>Your order has been placed. A receipt has been sent to your email.</p>
        <a class="btn" href="download_receipt.php?file=<?php echo urlencode($receiptFileName); ?>">Download Receipt</a>
    </div>
</body>
</html>
