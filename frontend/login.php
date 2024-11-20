<?php
session_start(); // Start the session

// Database connection
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to authenticate the user
    $sql = "SELECT * FROM User WHERE UserEmail = :email AND UserPassword = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Store user data in the session
        $_SESSION['UserID'] = $user['UserID'];
        $_SESSION['UserName'] = $user['UserName']; // Optional for convenience
        header("Location: home.html"); // Redirect to the dashboard
        exit();
    } else {
        echo "Invalid email or password.";
    }
}
?>
