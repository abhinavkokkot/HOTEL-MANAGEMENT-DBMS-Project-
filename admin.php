<?php

include 'conn.php';
$sql = "SELECT room_id, title, type FROM rooms";
$sql1 = "SELECT name, email, phone FROM customers";
$sql2 = "SELECT * FROM bookings";
$result = $conn->query($sql);
$result1 = $conn->query($sql1);
$result2 = $conn->query($sql2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <div class="rooms">
        <h1>all rooms</h1>
        <div class="room-list">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "Room ID: " . $row["room_id"] . " | Title: " . $row["title"] . " | type : " . $row["type"] . "<br>";
                }
            }
            else {
    echo "No results found!";
}
            ?>
    </div>
    </div>

    <div class="customers">
        <h1>customers</h1>
        <div class="customer-list">
            <?php
            if ($result1->num_rows > 0) {
                while($row = $result1->fetch_assoc()) {
                    echo "Name: " . $row["name"] . " | Email: " . $row["email"] . " | Phone : " . $row["phone"] . "<br>";
                }
            }
            else {
    echo "No results found!";
}
            ?>
        </div>
    </div>

    <div class="booking">
        <h1>bookings</h1>
        <div class="booking-list">
            <?php
            if ($result2->num_rows > 0) {
                while($row = $result2->fetch_assoc()) {
                    echo "Booking ID: " . $row["booking_id"] . " | Room ID: " . $row["room_id"] . " | Customer Email : " . $row["customer_email"] . " | Checkin : " . $row["checkin"] . " | Checkout : " . $row["checkout"] . "<br>";
                }
            }
            else {
                echo "No results found!";
            }
            ?>
    </div>

    <div class="add">
        <h2>Add Room</h2>
        <form method="POST" action="admin.php">
            <input type="text" name="title" placeholder="Title" required>
            <input type="text" name="type" placeholder="Type (single/double/luxury)" required>
            <input type="text" name="description" placeholder="Description" required>
            <input type="number" name="price" placeholder="Price" required>
            <input type="text" name="image" placeholder="Image URL" required>
            <button type="submit">Add Room</button>
        </form>
        <?php


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST['title'];
            $type = $_POST['type'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $image = $_POST['image'];

            $stmt = $conn->prepare("INSERT INTO rooms (title, type, description, price, image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssds", $title, $type, $description, $price, $image);

            if ($stmt->execute()) {
                echo "<p style='color:green;'>Room added successfully!</p>";
            } else {
                echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
            }
            $stmt->close();
        }

        $sql = "SELECT room_id, title, type FROM rooms";
        $sql1 = "SELECT name, email, phone FROM customers";
        $sql2 = "SELECT * FROM bookings";
        $result = $conn->query($sql);
        $result1 = $conn->query($sql1);
        $result2 = $conn->query($sql2);
        ?>

    </div>

    <div class="remove">
        <h1>remove rooms</h1>
        <div class="remove">
            <form method="POST" action="remove_room.php">
                <input type="number" name="room_id" placeholder="Room ID to delete" required>
                <button type="submit">Delete Room</button>
            </form>
        </div>
    </div>
</body>
</html>