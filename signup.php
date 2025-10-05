<style>
    .alert-box {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        padding: 15px 25px;
        border-radius: 8px;
        font-weight: bold;
        color: white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        z-index: 9999;
        animation: fadeInOut 4s ease-in-out;
    }
    .alert-success { background-color: #4CAF50; } /* Green */
    .alert-error { background-color: #f44336; }   /* Red */

    @keyframes fadeInOut {
        0% { opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { opacity: 0; }
    }
</style>
<?php
include 'conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $phone    = trim($_POST['phone']);
    $address  = trim($_POST['address']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if email already exists
    $check = $conn->prepare("SELECT email FROM customers WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<div class='alert-box alert-error'>⚠️ Email already registered. Please log in.</div>";
    } else {
        $sql = "INSERT INTO customers (name, email, phone, address, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiss", $name, $email, $phone, $address, $password);

        if ($stmt->execute()) {
            $_SESSION['email'] = $email;
            echo "<div class='alert-box alert-success'>✅ Registration successful! Redirecting...</div>";
            header("refresh:2; url=index.php"); // waits 2 seconds before redirect
            exit;
        } else {
            echo "<div class='alert-box alert-error'>❌ Error: " . htmlspecialchars($stmt->error) . "</div>";
        }
    }

    $check->close();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {
            background: linear-gradient(120deg, #f6d365 0%, #fda085 100%);
            font-family: 'Segoe UI', Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .signup-container {
            background: #fff;
            padding: 2rem 2.5rem;
            border-radius: 14px;
            box-shadow: 0 8px 32px rgba(253, 160, 133, 0.15);
            text-align: center;
            min-width: 340px;
        }
        h2 {
            margin-bottom: 1.5rem;
            color: #fd7e50;
            font-weight: 600;
        }
        input[type="text"], input[type="email"], input[type="number"], input[type="password"] {
            width: 92%;
            padding: 0.7rem;
            margin: 0.7rem 0;
            border: 1px solid #fda085;
            border-radius: 7px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }
        input:focus {
            border-color: #fd7e50;
            outline: none;
        }
        button {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(90deg, #fda085 0%, #f6d365 100%);
            border: none;
            border-radius: 7px;
            color: #fff;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 1rem;
            transition: background 0.2s;
        }
        button:hover {
            background: linear-gradient(90deg, #f6d365 0%, #fda085 100%);
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="name" required><br>
            <input type="email" name="email" placeholder="email" required><br>
            <input type="number" name="phone" placeholder="phone" required><br>
            <input type="text" name="address" placeholder="address" required><br>
            <input type="password" name="password" placeholder="password" required><br>
            <button type="submit">Sign Up</button>
        </form>
        <a href="login.php">already have an account?</a>
    </div>
</body>
</html>
