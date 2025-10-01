<?php
session_start();
include 'conn.php';

// Fetch all single rooms from database
$sql = "SELECT * FROM rooms WHERE type = 'single'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Single Rooms - hotel transylvania</title>
    <link rel="stylesheet" href="style-rooms.css">
</head>
<body>

<div class="nav">
        <div class="logo">
            <a href="#">hotel transylvania</a>
        </div>
        <div class="nav-link">
            <a href="index.php">Home</a>
            <a href="rooms.php">Rooms</a>
            <a href="about.html">About</a>
            <a href="contact.html">Contact Us</a>
            <a href="profile.php">profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

<div class="section-p1">
    <h2>Single Rooms</h2>
    <p>Choose from our single rooms </p>

    <div class="pro-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while($room = $result->fetch_assoc()): ?>
                <div class="pro">
                    <img src="<?php echo $room['image']; ?>" alt="<?php echo $room['title']; ?>">
                    <div class="des">
                        <span><?php echo ucfirst($room['type']); ?> Room</span>
                        <h5><?php echo $room['title']; ?></h5>
                        <p><?php echo $room['description']; ?></p>
                        <h6>Price: ₹<?php echo number_format($room['price']); ?>/night</h6>
                        <a href="book.php?room_id=<?php echo urlencode($room['room_id']); ?>" class="book-btn">Book Now</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No single rooms available.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
