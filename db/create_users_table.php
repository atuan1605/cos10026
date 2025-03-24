<?php
require_once './settings.php'; // Include DB connection settings

$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. Check if 'users' table exists
$tableCheckQuery = "SHOW TABLES LIKE 'users'";
$tableCheckResult = $conn->query($tableCheckQuery);

if ($tableCheckResult && $tableCheckResult->num_rows > 0) {
    echo "Table 'users' already exists. Skipping creation.<br>";
} else {
    // 2. Create 'users' table
    $createTableSQL = "CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(191) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        deleted_at TIMESTAMP NULL DEFAULT NULL,
        role ENUM('Admin', 'Member', 'User') NOT NULL DEFAULT 'User', -- Thêm dấu phẩy ở đây
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

// 3. Add sample user if not exists
$sampleUsername = "admin";
$plainPassword = "123456";
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
$sampleRole = "Admin";

// Check if sample user already exists
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

// 4. Kiểm tra xem có dữ liệu user nào chưa
$checkUsersQuery = "SELECT COUNT(*) AS count FROM users";
$checkUsersResult = $conn->query($checkUsersQuery);
$row = $checkUsersResult->fetch_assoc();
$insertUsersSQL = "INSERT IGNORE INTO users (username, password, created_at, deleted_at, role, name, age, experience, skills, hobbies, hometown, image) 
VALUES 
('anhtuanle', '" . password_hash('anhtuanle', PASSWORD_DEFAULT) . "', NOW(), NULL, 'Member', 'Anh Tuan Le', 28, '+5 years of experience in App/Web Dev', 'Java, Vue.js, Swift, PostgreSQL', 'Pickleball', 'HN', './styles/images/anhtuan.jpg'),
('trungnguyen', '" . password_hash('trungnguyen', PASSWORD_DEFAULT) . "', NOW(), NULL, 'Member', 'Nguyen Quoc Trung', 18, 'Certificate in Mindx Web-Advanced Course', 'Ruby, HTML, CSS', 'Sleep', 'HN', './styles/images/Trung.png'),
('dminh', '" . password_hash('dminh', PASSWORD_DEFAULT) . "', NOW(), NULL, 'Member', 'Nguyen Duc Minh', 19, '0 years, learning for 3 months', 'HTML, CSS', 'Playing sports', 'HN', './styles/images/dminh.jpg'),
('haininh', '" . password_hash('haininh', PASSWORD_DEFAULT) . "', NOW(), NULL, 'Member', 'Nguyen Van Hai Ninh', 18, '+17 years of bumming around', 'Band-aid fixes', 'Video games', 'Hai Duong', './styles/images/haininh.jpg')";
if ($conn->query($insertUsersSQL) === TRUE) {
    echo "Sample users added successfully.<br>";
} else {
    echo "Error inserting users: " . $conn->error . "<br>";
}
$conn->close();
?>