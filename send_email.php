<?php
// Allow cross-origin requests (CORS) if needed
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Get the raw POST data
$data = json_decode(file_get_contents("php://input"), true);

// Extract the amount from the request
$amount = isset($data["amount"]) ? $data["amount"] : "Unknown";

// Email configuration
$to = "your_email@example.com";  // Change to your email
$subject = "Payment Received";
$message = "A payment of ₹" . $amount . " has been received.";
$headers = "From: no-reply@yourdomain.com" . "\r\n" .
           "Reply-To: no-reply@yourdomain.com" . "\r\n" .
           "Content-Type: text/plain; charset=UTF-8";

// Send the email
if (mail($to, $subject, $message, $headers)) {
    echo json_encode(["status" => "success", "message" => "Email sent successfully!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to send email."]);
}
?>
