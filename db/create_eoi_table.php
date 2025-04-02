<?php
require_once './settings.php';

$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tableCheckQuery = "SHOW TABLES LIKE 'eoi'";
$tableCheckResult = $conn->query($tableCheckQuery);

if ($tableCheckResult && $tableCheckResult->num_rows > 0) {
    echo "Table 'eoi' already exists. Skipping creation.<br>";
} else {
    $createTableSQL = "CREATE TABLE eoi (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        job_reference_number VARCHAR(5) NOT NULL,
        first_name VARCHAR(20) NOT NULL,
        last_name VARCHAR(20) NOT NULL,
        dob DATE NOT NULL,
        gender ENUM('Male', 'Female') NOT NULL,
        address VARCHAR(40) NOT NULL,
        suburb VARCHAR(40) NOT NULL,
        state ENUM('VIC','NSW','QLD','NT','WA','SA','TAS','ACT') NOT NULL,
        postcode VARCHAR(4) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        skills TEXT NOT NULL,
        other_skills TEXT,
        status ENUM('New','Approved','Rejected') DEFAULT 'New',
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    if ($conn->query($createTableSQL) === TRUE) {
        echo "Table 'eoi' created successfully with user_id column and foreign key.<br>";
    } else {
        die("Error creating table: " . $conn->error);
    }
}

$conn->close();
?>
