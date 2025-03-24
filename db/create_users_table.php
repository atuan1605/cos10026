<?php
require_once './settings.php'; 

$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tableCheckQuery = "SHOW TABLES LIKE 'users'";
$tableCheckResult = $conn->query($tableCheckQuery);

if ($tableCheckResult && $tableCheckResult->num_rows > 0) {
    echo "Table 'users' already exists. Skipping creation.<br>";
} else {
    $createTableSQL = "CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(191) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        deleted_at TIMESTAMP NULL DEFAULT NULL,
        role ENUM('Admin', 'Member', 'User') NOT NULL DEFAULT 'User',
        name VARCHAR(255) NOT NULL,
        age INT NOT NULL,
        experience TEXT NOT NULL,
        skills TEXT NOT NULL,
        hobbies TEXT NOT NULL,
        hometown VARCHAR(100) NOT NULL,
        image VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    if ($conn->query($createTableSQL) === TRUE) {
        echo "Table 'users' created successfully.<br>";
    } else {
        die("Error creating table: " . $conn->error);
    }
}
$sampleUsername = "admin";
$plainPassword = "123456";
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
$sampleRole = "Admin";

$checkStmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$checkStmt->bind_param("s", $sampleUsername);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows === 0) {
    $insertStmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $insertStmt->bind_param("sss", $sampleUsername, $hashedPassword, $sampleRole);

    if ($insertStmt->execute()) {
        echo "Sample user added successfully.<br>";
    } else {
        echo "Error adding sample user: " . $insertStmt->error . "<br>";
    }

    $insertStmt->close();
} else {
    echo "Sample user already exists. Skipping insert.<br>";
}

$checkStmt->close();
$conn->close();
?>
