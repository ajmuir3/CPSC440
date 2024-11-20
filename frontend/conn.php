<?php
// Database connection parameters
$host = 'cpsc-440-rds.cj24gusco7ni.us-east-2.rds.amazonaws.com';  // RDS endpoint
$dbname = 'CPSC440';
$username = 'admin';
$password = 'CPSC440password';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

return $conn;
?>