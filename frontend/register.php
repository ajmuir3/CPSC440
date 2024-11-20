<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Retrieve form data
    $user = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role']
    $pass = $_POST['password'];
    $pass2 = $_POST['confirm-password'];
}

if ($pass == $pass2){
    $stmt = $conn->prepare("INSERT INTO User (UserName, UserEmail, UserRole, UserPassword) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssss", $user, $email, $role, $pass);

    // Execute the query
    if ($stmt->execute()) {
        header("Location: home.html");
    } else {
        echo "Error: " . $stmt->error;
    }
}

else {
    echo "<p> Passwords do not match </p>";
}

// Close connection
$stmt->close();
$conn->close();
?>