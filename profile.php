<?php
session_start();
include 'conn.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$customer_email = $_SESSION['email'];

// Fetch all bookings for this customer
$stmt = $conn->prepare("
    SELECT b.booking_id, r.title AS room_title, r.price AS room_price, r.image AS room_image, 
           b.checkin, b.checkout, c.name AS customer_name
    FROM bookings b
    JOIN rooms r ON b.room_id = r.room_id
    JOIN customers c ON b.customer_email = c.email
    WHERE b.customer_email = ?
");
$stmt->bind_param("s",  $customer_email);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>hotel transylvania</title>
    <link rel="stylesheet" href="style-profile.css">
</head>
<body>
<div class="nav">
    <div class="logo"><a href="index.php">hotel transylvania</a></div>
    <div class="nav-link">
        <a href="index.php">Home</a>
        <a href="rooms.php">Rooms</a>
        <a href="about.html">About</a>
        <a href="contact.html">Contact Us</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="section-p1">
    <h2>My Bookings</h2>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($booking = $result->fetch_assoc()): ?>
            <div class="pro">
                <img src="<?php echo $booking['room_image']; ?>" alt="<?php echo $booking['room_title']; ?>" style="width:300px;">
                <div class="des">
                    <h5><?php echo $booking['room_title']; ?></h5>
                    <p>Customer: <?php echo htmlspecialchars($booking['customer_name']); ?></p>
                    <p>Check-in: <?php echo $booking['checkin']; ?></p>
                    <p>Check-out: <?php echo $booking['checkout']; ?></p>
                    <p>Price: ₹<?php echo number_format($booking['room_price']); ?>/night</p>
                    <p>Booking ID: <?php echo $booking['booking_id']; ?></p>
                    <a href="delete.php?id=<?php echo $booking['booking_id']; ?>"
   onclick="return confirm('Are you sure you want to cancel this booking?');">
   Cancel Booking
</a>
                </div>
            </div>
            
        <?php endwhile; ?>
    <?php else: ?>
        <p>No bookings found!</p>
    <?php endif; ?>

    <a href="index.php" class="book-btn">Back to Home</a>
</div>
</body>
</html>
