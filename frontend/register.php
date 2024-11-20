<?php
include 'conn.php';

<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405); // Method Not Allowed
    die("Only POST requests are allowed.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Retrieve form data
    $user = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $pass = $_POST['password'];
    $pass2 = $_POST['confirm-password'];
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