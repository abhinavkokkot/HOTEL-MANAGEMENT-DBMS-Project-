<?php
session_start();
include 'conn.php';

$name = ""; // initialize

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    
    // Prepare statement
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
    <title>My Website</title>
    <link rel="stylesheet" href="style-rooms.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body>

<?php if (isset($_SESSION['email'])): ?>
    <div class="nav">
        <div class="logo">
<<<<<<< HEAD
            <a href="#">WELCOME</a>
        </div>
        <div class="nav-link">
        <a href="#">Home</a>
        <a href="rooms.php">rooms</a>
        <a href="about.html">about</a>
        <a href="contact.php">contact us</a>
        <a href="logout.php">Logout</a>
=======
            <a href="#">hotel transylvania</a>
        </div>
        <div class="nav-link">
            <a href="index.php">Home</a>
            <a href="rooms.php">Rooms</a>
            <a href="about.html">About</a>
            <a href="contact.html">Contact Us</a>
            <a href="profile.php">profile</a>
            <a href="logout.php">Logout</a>
>>>>>>> ec1b4f0 (contact)
        </div>
    </div>
    </div>

    <div id="rooms" class="section-p1">
        <h2>Our Rooms</h2>

        <p>Discover our rooms</p>
        <div class="pro-container">
            <div class="pro">
                <a href="single-room.php">
                <img src="https://i.pinimg.com/736x/e7/73/b0/e773b09f1432bdf6c73695708fd15f3a.jpg" alt="">
                <div class="des">
                    <span>single room</span>
                    <h5>standard single room</h5>
                </div>
                </a>
            </div>
            <div class="pro">
                <a href="double-room.php">
                <img src="https://i.pinimg.com/1200x/e3/b3/d2/e3b3d2f55912e6afbe6fe2b952860b3a.jpg" alt="">
                <div class="des">
                    <span>double room</span>
                    <h5>deluxe double room</h5>
                </div>
                </a>
            </div>
            <div class="pro">
                <a href="luxury-room.php">
                <img src="https://i.pinimg.com/736x/e7/73/b0/e773b09f1432bdf6c73695708fd15f3a.jpg" alt="">
                <div class="des">
                    <span>suite room</span>
                    <h5>luxury suite room</h5>
                </div>
                </a>
            </div>  
    </div>
<?php else: ?>
    <h2>
        <a href="login.php">Login</a>
        <a href="signup.php">Signup</a>
    </h2>
<?php endif; ?>

</body>
</html>
