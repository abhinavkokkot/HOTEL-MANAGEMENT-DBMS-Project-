<?php
include 'conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);


    $sql = "INSERT INTO customers ( name,email,phone,address,password) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $name,$email,$phone,$address,$password);

    if ($stmt->execute()) {
        $_SESSION['email'] = $email;
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
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
