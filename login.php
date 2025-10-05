<style>
    .alert-box {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #f44336; /* red background */
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        font-weight: bold;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        z-index: 9999;
        animation: fadeInOut 4s ease-in-out;
    }

    @keyframes fadeInOut {
        0% { opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { opacity: 0; }
    }
</style>
<?php
session_start();
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM customers WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

   if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password'])) {
        $_SESSION['email'] = $row['email'];
        header("Location: index.php");
        exit;
    } else {
        echo "<div class='alert-box'>⚠️ Incorrect password. Please try again.</div>";
    }
} else {
    echo "<div class='alert-box'>❌ No account found with that email address.</div>";
}

}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
            font-family: 'Segoe UI', Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: #fff;
            padding: 2rem 2.5rem;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(44, 62, 80, 0.15);
            text-align: center;
            min-width: 320px;
        }
        h1 {
            margin-bottom: 1.5rem;
            color: #2d3e50;
        }
        input[type="email"], input[type="password"] {
            width: 90%;
            padding: 0.7rem;
            margin: 0.7rem 0;
            border: 1px solid #bfc9d4;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }
        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #74ebd5;
            outline: none;
        }
        button {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(90deg, #74ebd5 0%, #ACB6E5 100%);
            border: none;
            border-radius: 6px;
            color: #fff;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 1rem;
            transition: background 0.2s;
        }
        button:hover {
            background: linear-gradient(90deg, #ACB6E5 0%, #74ebd5 100%);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form method="POST">
            <input type="email" name="email" placeholder="email" required><br>
            <input type="password" name="password" placeholder="password" required><br>
            <button type="submit">Login</button>
            <a href="signup.php">don't have an account?</a>
        </form>
    </div>
</body>
</html>
