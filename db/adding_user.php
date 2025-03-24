<?php
require_once './settings.php'; 

$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
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

