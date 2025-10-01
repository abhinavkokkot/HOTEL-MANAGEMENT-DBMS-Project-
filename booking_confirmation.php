<?php
session_start();
include 'conn.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

// Check if booking_id is provided
if (!isset($_GET['booking_id'])) {
    echo "No booking selected!";
    exit;
}

$booking_id = $_GET['booking_id'];
$customer_email = $_SESSION['email'];

// Fetch booking details
$stmt = $conn->prepare("
    SELECT b.booking_id, r.title AS room_title, r.price AS room_price, r.image AS room_image, 
           b.checkin, b.checkout, c.name AS customer_name
    FROM bookings b
    JOIN rooms r ON b.room_id = r.room_id
    JOIN customers c ON b.customer_email = c.email
    WHERE b.booking_id = ? AND b.customer_email = ?
");
$stmt->bind_param("is", $booking_id, $customer_email);
$stmt->execute();
$booking = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$booking) {
    echo "Booking not found!";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="style-rooms.css">
</head>
<body>
<div class="nav">
        <div class="logo">
            <a href="#">hotel transylvania</a>
        </div>
        <div class="nav-link">
            <a href="#">Home</a>
            <a href="rooms.php">Rooms</a>
            <a href="about.html">About</a>
            <a href="contact.html">Contact Us</a>
            <a href="profile.php">profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

<div class="section-p1">
    <h2>Booking Confirmation</h2>

    <div class="pro">
        <img src="<?php echo $booking['room_image']; ?>" alt="<?php echo $booking['room_title']; ?>" style="width:300px;">
        <div class="des">
            <h5><?php echo $booking['room_title']; ?></h5>
            <p>Customer: <?php echo htmlspecialchars($booking['customer_name']); ?></p>
            <p>Check-in: <?php echo $booking['checkin']; ?></p>
            <p>Check-out: <?php echo $booking['checkout']; ?></p>
            <p>Price: ₹<?php echo number_format($booking['room_price']); ?>/night</p>
            <p>Booking ID: <?php echo $booking['booking_id']; ?></p>
        </div>
    </div>

    <p>Thank you for booking with GrandStay! We look forward to your stay.</p>
    <a href="index.php" class="book-btn">Back to Home</a>
</div>
</body>
</html>
