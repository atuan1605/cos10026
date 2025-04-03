<?php
require_once './settings.php'; 

$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tableCheckQuery = "SHOW TABLES LIKE 'timetables'";
$tableCheckResult = $conn->query($tableCheckQuery);

if ($tableCheckResult && $tableCheckResult->num_rows > 0) {
    echo "Table 'timetables' already exists. Skipping creation.";
} else {
    $createTableSQL = "CREATE TABLE IF NOT EXISTS timetables (
        id INT AUTO_INCREMENT PRIMARY KEY,
        date DATE NOT NULL,
        time VARCHAR(20) NOT NULL,
        task VARCHAR(255) NOT NULL,
        status BOOLEAN NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UNIQUE(date, time, task)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if ($conn->query($createTableSQL) === TRUE) {
    echo "Table 'timetables' created successfully.\n";
} else {
    die("Error creating table: " . $conn->error);
}
}

// Lệnh INSERT IGNORE để tránh trùng lặp
$insertTimetableSQL = "INSERT IGNORE INTO timetables (date, time, task, status) VALUES
('2025-02-10', '8:00 - 11:00', 'Summarize the assignment requirements and grading criteria', TRUE),
('2025-02-15', '13:00 - 16:00', 'Assign tasks and finalize code submission approach', TRUE),
('2025-02-16', '9:00 - 12:00', 'Work on individually assigned tasks', TRUE),
('2025-02-17', '9:00 - 12:00', 'Meeting', FALSE),
('2025-02-18', '13:00 - 17:00', 'Team meeting to solve technical issues while coding', TRUE),
('2025-02-20', '19:00 - 23:00', 'Resolve Responsive design problems', TRUE),
('2025-03-15', '14:00 - 18:00', 'Create Database schema and design', TRUE),
('2025-03-16', '09:00 - 12:00', 'Set up MySQL Database and configure phpMyAdmin', TRUE),
('2025-03-17', '13:00 - 17:00', 'Refactor code to connect frontend with PHP backend', TRUE),
('2025-03-18', '10:00 - 15:00', 'Develop and complete User Registration & Login pages', TRUE),
('2025-03-19', '16:00 - 20:00', 'Implement logic for Admin Management Dashboard', TRUE),
('2025-03-21', '08:00 - 11:30', 'Handle form validation and display validation messages', TRUE),
('2025-03-22', '09:30 - 12:30', 'Draw System Diagram for database structure', TRUE),
('2025-04-01', '14:00 - 17:00', 'Design Flowchart for user interaction process', TRUE),
('2025-04-01', '19:00 - 22:00', 'Finalize and polish Slide Presentation', TRUE),
('2025-04-03', '23:00 - 00:00', 'Final check before submission', TRUE);";


if ($conn->query($insertTimetableSQL) === TRUE) {
    echo "Data inserted successfully!\n";
} else {
    die("Error inserting data: " . $conn->error);
}
$conn->close();
?>
