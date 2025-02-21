<?php
// login.php
session_start();
header('Content-Type: application/json');

// Dummy data for illustration purposes; in real implementation, you would fetch this from your database
$users = [
    'user1' => 'password1',
    'user2' => 'password2'
];

$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

if (isset($users[$username]) && $users[$username] === $password) {
    // Login successful
    $_SESSION['username'] = $username;  // Store username in session
    echo json_encode(['status' => 'success']);
} else {
    // Login failed
    echo json_encode(['status' => 'error', 'message' => 'Invalid username or password']);
}
?>
