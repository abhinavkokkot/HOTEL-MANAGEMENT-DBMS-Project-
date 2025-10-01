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
    <title>Book <?php echo $room['title']; ?> - Room</title>
    <link rel="stylesheet" href="style-rooms.css">
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            margin: 0;
            background: #f9f9f9;
        }

        /* Navigation */
        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #2c3e50;
            padding: 15px 30px;
            color: white;
        }
        .nav .logo a {
            font-size: 22px;
            font-weight: bold;
            text-decoration: none;
            color: #f39c12;
        }
        .nav-link a {
            margin-left: 20px;
            text-decoration: none;
            color: white;
            font-weight: 500;
            transition: 0.3s;
        }
        .nav-link a:hover {
            color: #f39c12;
        }

        /* Section */
        .section-p1 {
            max-width: 900px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .room-image {
            width: 100%;
            max-width: 500px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .price {
            font-size: 20px;
            font-weight: bold;
            color: #27ae60;
        }

        /* Booking Form */
        form {
            margin-top: 20px;
        }
        label {
            font-weight: 600;
            display: block;
            margin: 10px 0 5px;
        }
        input[type="date"] {
            padding: 10px;
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            margin-top: 20px;
            padding: 12px 25px;
            background: #f39c12;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            color: white;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background: #e67e22;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .section-p1 {
                padding: 20px;
            }
            input[type="date"] {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<<<<<<< HEAD
<div class="nav">
    <div class="logo"><a href="index.php">Room</a></div>
    <div class="nav-link">
        <a href="index.php">Home</a>
        <a href="rooms.php">Rooms</a>
        <a href="about.html">About</a>
        <a href="contact.php">Contact</a>
        <a href="logout.php">Logout</a>
=======
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
>>>>>>> ec1b4f0 (contact)
    </div>

<div class="section-p1">
    <h2>Book: <?php echo $room['title']; ?></h2>
    <img src="<?php echo $room['image']; ?>" alt="<?php echo $room['title']; ?>" class="room-image">
    <p><?php echo $room['description']; ?></p>
    <p class="price">Price: ₹<?php echo number_format($room['price']); ?>/night</p>

    <h3>Booking Details</h3>
    <form method="POST">
        <label>Check-in:</label>
        <input type="date" name="checkin" required>

        <label>Check-out:</label>
        <input type="date" name="checkout" required>

        <button type="submit">Book Now</button>
    </form>
</div>
</body>
</html>
