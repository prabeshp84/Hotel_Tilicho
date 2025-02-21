<?php
// The password to be hashed
$password = 'KingTyrant';

// Create a password hash
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Output the hashed password
echo $hashedPassword;
?>