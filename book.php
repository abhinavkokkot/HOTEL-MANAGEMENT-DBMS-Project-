<?php
session_start();
include 'conn.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$customer_email = $_SESSION['email'];

// Check room_id
if (!isset($_GET['room_id'])) {
    echo "No room selected!";
    exit;
}

$room_id = $_GET['room_id'];

// Fetch room details
$stmt = $conn->prepare("SELECT * FROM rooms WHERE room_id = ?");
$stmt->bind_param("i", $room_id);
$stmt->execute();
$room = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$room) {
    echo "Room not found!";
    exit;
}

// Handle booking form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    $stmt = $conn->prepare("INSERT INTO bookings (room_id, customer_email, checkin, checkout) VALUES (?,?,?,?)");
    $stmt->bind_param("isss", $room_id, $customer_email, $checkin, $checkout);



    if ($stmt->execute()) {
        $newBookingId = $stmt->insert_id;
        header("Location: booking_confirmation.php?booking_id=" . $newBookingId);
        exit;
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Book <?php echo $room['title']; ?> - GrandStay</title>
    <link rel="stylesheet" href="style-rooms.css">
</head>
<body>
<div class="nav">
    <div class="logo"><a href="index.php">GrandStay</a></div>
    <div class="nav-link">
        <a href="index.php">Home</a>
        <a href="rooms.php">Rooms</a>
        <a href="about.html">About</a>
        <a href="contact.php">Contact Us</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="section-p1">
    <h2>Book: <?php echo $room['title']; ?></h2>
    <img src="<?php echo $room['image']; ?>" alt="<?php echo $room['title']; ?>" style="width:300px;">
    <p><?php echo $room['description']; ?></p>
    <p>Price: ₹<?php echo number_format($room['price']); ?>/night</p>

    <h3>Booking Details</h3>
    <form method="POST">
        <label>Check-in:</label>
        <input type="date" name="checkin" required><br><br>

        <label>Check-out:</label>
        <input type="date" name="checkout" required><br><br>

        <button type="submit">Book Now</button>
    </form>
</div>
</body>
</html>
