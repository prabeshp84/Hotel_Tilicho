<?php
session_start();
header('Content-Type: application/json');

// Database connection details
$servername = "localhost";
$username = "your_db_username"; // Replace with your database username
$password = "your_db_password"; // Replace with your database password
$dbname = "hotel_tilicho";

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit();
}

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

// Get POST data
$data = $_POST;
$new_email = trim($data['newEmail']);
$new_password = trim($data['newPassword']);
$user_id = $_SESSION['user_id'];

if (empty($new_email) && empty($new_password)) {
    echo json_encode(['status' => 'error', 'message' => 'No updates provided']);
    exit();
}

// Prepare the SQL update query
$updateFields = [];
$params = [];
if (!empty($new_email)) {
    $updateFields[] = "email = :email";
    $params[':email'] = $new_email;
}
if (!empty($new_password)) {
    $updateFields[] = "password_hash = :password";
    $params[':password'] = password_hash($new_password, PASSWORD_DEFAULT);
}

if (empty($updateFields)) {
    echo json_encode(['status' => 'error', 'message' => 'No updates provided']);
    exit();
}

$sql = "UPDATE users SET " . implode(", ", $updateFields) . " WHERE id = :id";
$params[':id'] = $user_id;

$stmt = $pdo->prepare($sql);
$result = $stmt->execute($params);

if ($result) {
    // Retrieve updated user information
    $stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = :id");
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Update session variables
    $_SESSION['username'] = $user['username'];

    echo json_encode(['status' => 'success', 'username' => $user['username'], 'email' => $user['email']]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update profile']);
}
?>
