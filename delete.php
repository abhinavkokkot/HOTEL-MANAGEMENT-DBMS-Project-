<?php
session_start();
include 'conn.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$customer_email = $_SESSION['email'];

// Check if booking_id is provided
if (!isset($_GET['id'])) {
    echo "No booking selected!";
    exit;
}

$booking_id = intval($_GET['id']);

// Delete booking only if it belongs to this customer
$stmt = $conn->prepare("
    DELETE FROM bookings 
    WHERE booking_id = ? AND customer_email = ?
");
$stmt->bind_param("is", $booking_id, $customer_email);

if ($stmt->execute() && $stmt->affected_rows > 0) {
    // Success
    header("Location: profile.php?msg=Booking+deleted+successfully");
    
    exit;
} else {
    echo "Error: Could not delete booking or you don’t own this booking.";
}

$stmt->close();
$conn->close();
?>
