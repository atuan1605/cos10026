<?php
require_once './settings.php'; // Include DB connection settings

$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tableCheckQuery = "SHOW TABLES LIKE 'jobs'";
$tableCheckResult = $conn->query($tableCheckQuery);

if ($tableCheckResult && $tableCheckResult->num_rows > 0) {
    echo "Table 'jobs' already exists. Skipping creation.<br>";
} else {
    $createTableSQL = "CREATE TABLE jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    company_name VARCHAR(255) DEFAULT NULL,
    position VARCHAR(255) DEFAULT NULL,
    salary_range VARCHAR(100) DEFAULT NULL,
    address VARCHAR(255) DEFAULT NULL,
    tags TEXT DEFAULT NULL,
    short_description TEXT DEFAULT NULL,
    key_responsibilities TEXT DEFAULT NULL,
    job_reference_number VARCHAR(100) UNIQUE DEFAULT NULL,
    title VARCHAR(255) DEFAULT NULL,
    report_to VARCHAR(255) DEFAULT NULL,
    available_position INT DEFAULT NULL,
    total INT DEFAULT NULL,
    type ENUM('Remote', 'OnSite') DEFAULT 'OnSite',
    experience ENUM('Expert', 'Intern', 'Fresher', 'Junior') DEFAULT 'Junior',
    essential TEXT DEFAULT NULL,
    preferable TEXT DEFAULT NULL,
    logo_image VARCHAR(255) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    if ($conn->query($createTableSQL) === TRUE) {
        echo "Table 'users' created successfully.<br>";
    } else {
        die("Error creating table: " . $conn->error);
    }
}

$conn->close();
