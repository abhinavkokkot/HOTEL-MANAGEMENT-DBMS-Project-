

<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST['room_id'];
    $stmt = $conn->prepare("DELETE FROM rooms WHERE room_id = ?");
    $stmt->bind_param("i", $room_id);
    if ($stmt->execute()) {
        echo "<p style='color:red;'>Room removed successfully!</p>";
         header("refresh:2;url=admin.php");

            } else {
                echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
            }
            $stmt->close();
            }
?>