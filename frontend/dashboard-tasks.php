<?php
session_start();

include 'conn.php';

try{
    $sql = "SELECT Task.* FROM Task JOIN User ON Task.UserID = User.UserID WHERE User.UserID = 1;"
}

$stmt = $conn->prepare("INSERT INTO User (UserName, UserEmail, UserRole, UserPassword) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $user, $email, $role, $pass);

// Execute the query
if ($stmt->execute()) {
    header("Location: home.html");
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>