<?php
// Database credentials
$servername = "localhost";
$username = "root"; // Update with your MySQL username
$password = ""; // Update with your MySQL password
$dbname = "hotel_tilicho";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind booking statement
$stmt = $conn->prepare("INSERT INTO bookings (checkin_date, checkout_date, adult, children, rooms, room_type, username, contact) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssiiisss", $checkin_date, $checkout_date, $adult, $children, $rooms, $room_type, $username, $contact);

// Set parameters and execute
$checkin_date = $_POST['checkin-date'];
$checkout_date = $_POST['checkout-date'];
$adult = $_POST['adult'];
$children = $_POST['children'];
$rooms = $_POST['rooms'];
$room_type = $_POST['room-type'];
$username = $_POST['username'];
$contact = $_POST['contact'];

if ($stmt->execute()) {
    echo "<div class='success-message'>";
    echo "<h1>Booking Confirmed!</h1>";
    echo "<p>Thank you, $username. Your booking has been confirmed.</p>";
    echo "<p>Check-in Date: $checkin_date</p>";
    echo "<p>Check-out Date: $checkout_date</p>";
    echo "<p>Adults: $adult</p>";
    echo "<p>Children: $children</p>";
    echo "<p>Rooms: $rooms</p>";
    echo "<p>Room Type: $room_type</p>";
    echo "<p>We have sent a confirmation to: $contact</p>";
    echo "</div>";
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
