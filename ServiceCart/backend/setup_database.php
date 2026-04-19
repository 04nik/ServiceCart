<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS servicecart";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
}

$conn->select_db("servicecart");

// Create Users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    role ENUM('Customer', 'Provider', 'Admin') DEFAULT 'Customer',
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql);

// Create Providers table
$sql = "CREATE TABLE IF NOT EXISTS providers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    service VARCHAR(100) NOT NULL,
    rating DECIMAL(2,1) DEFAULT 0.0,
    experience INT DEFAULT 0,
    price INT DEFAULT 0,
    location VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL
)";
$conn->query($sql);

// Create Bookings table
$sql = "CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    provider VARCHAR(100),
    service VARCHAR(100),
    price INT,
    date DATE,
    time TIME,
    address TEXT,
    phone VARCHAR(15),
    status ENUM('Pending', 'Confirmed', 'Completed', 'Rejected') DEFAULT 'Pending'
)";
$conn->query($sql);

// Insert Sample Data
$sql = "INSERT INTO providers (name, service, rating, experience, price, location, phone, email) VALUES
('John Doe', 'Plumbing', 4.5, 5, 500, 'Mumbai', '9876543210', 'john@example.com'),
('Jane Smith', 'Electrical', 4.8, 8, 800, 'Delhi', '9876543211', 'jane@example.com'),
('Alice Brown', 'Cleaning', 4.2, 3, 400, 'Bangalore', '9876543212', 'alice@example.com'),
('Bob Wilson', 'Carpentry', 4.6, 6, 600, 'Pune', '9876543213', 'bob@example.com')
ON DUPLICATE KEY UPDATE name=name";
$conn->query($sql);

// Create Default Admin
$sql = "INSERT IGNORE INTO users (name, email, mobile, role, password) VALUES
('Admin', 'admin@servicecart.com', '0000000000', 'Admin', 'admin123')";
$conn->query($sql);

echo "Setup completed successfully. You can now login with admin@servicecart.com / admin123";

$conn->close();
?>
