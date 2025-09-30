
<?php
session_start();
include 'conn.php';

$name = ""; // initialize

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $stmt = $conn->prepare("SELECT name FROM customers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($name);
    $stmt->fetch();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>hotel transylvania</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php if (isset($_SESSION['email'])): ?>
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
    <div class="user-info">
        <strong>Hey <?php echo htmlspecialchars($name); ?></strong>
    </div>
    <div class="welcome-section">
        <h1>Welcome to hotel transylvania</h1>
        <p>Experience comfort, luxury, and convenience at the best hotel in town.<br>
        Book your stay, explore our rooms, and enjoy world-class amenities!</p>
    </div>
    <div class="features">
        <div class="feature-card">
            <h3>Easy Booking</h3>
            <p>Reserve your room in just a few clicks with our simple booking system.</p>
        </div>
        <div class="feature-card">
            <h3>Premium Rooms</h3>
            <p>Choose from a variety of room types designed for your comfort and style.</p>
        </div>
        <div class="feature-card">
            <h3>24/7 Support</h3>
            <p>Our team is always available to assist you with any queries or requests.</p>
        </div>
    </div>
<?php else: ?>
    <?php header("Location: login.php"); exit; ?>
<?php endif; ?>

</body>
</html>