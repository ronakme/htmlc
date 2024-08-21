<?php
// download_receipt.php

$receiptFileName = $_GET['file'];

// Ensure the file exists
if (file_exists($receiptFileName)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($receiptFileName).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($receiptFileName));
    readfile($receiptFileName);
    exit;
} else {
    echo "File not found!";
}
?>
