<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Retrieve form data
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $ssn_last4 = $_POST['ssn'];
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users (username, email, password, ssn_last4) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $user, $email, $pass, $ssn_last4);

// Execute the query
if ($stmt->execute()) {
    header("Location: welcome.html");
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>