
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
    <title>Hotel Management - Home</title>
    <style>
        body {
            background: linear-gradient(120deg, #89f7fe 0%, #66a6ff 100%);
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            min-height: 100vh;
        }
        .nav {
            background: #fff;
            box-shadow: 0 2px 8px rgba(102,166,255,0.08);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo a {
            font-size: 1.7rem;
            font-weight: bold;
            color: #66a6ff;
            text-decoration: none;
            letter-spacing: 1px;
        }
        .nav-link a {
            margin: 0 1rem;
            color: #333;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 500;
            transition: color 0.2s;
        }
        .nav-link a:hover {
            color: #66a6ff;
        }
        .welcome-section {
            text-align: center;
            margin-top: 3rem;
            margin-bottom: 2rem;
        }
        .welcome-section h1 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 0.5rem;
        }
        .welcome-section p {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 1.5rem;
        }
        .features {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 3rem;
        }
        .feature-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(102,166,255,0.10);
            padding: 2rem 1.5rem;
            width: 260px;
            text-align: center;
            transition: transform 0.2s;
        }
        .feature-card:hover {
            transform: translateY(-6px) scale(1.04);
        }
        .feature-card h3 {
            color: #66a6ff;
            margin-bottom: 0.7rem;
        }
        .feature-card p {
            color: #555;
            font-size: 1rem;
        }
        .user-info {
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
            font-size: 1.1rem;
        }
        @media (max-width: 900px) {
            .features {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>

<?php if (isset($_SESSION['email'])): ?>
    <div class="nav">
        <div class="logo">
            <a href="#">vishal kumar</a>
        </div>
        <div class="nav-link">
            <a href="#">Home</a>
            <a href="rooms.php">Rooms</a>
            <a href="about.html">About</a>
            <a href="contact.php">Contact Us</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="user-info">
        Logged in user: <strong><?php echo htmlspecialchars($name); ?></strong>
    </div>
    <div class="welcome-section">
        <h1>Welcome to Vishal Kumar Hotel</h1>
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