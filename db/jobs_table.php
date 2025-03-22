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
    company_name VARCHAR(100) DEFAULT NULL,
    position VARCHAR(100) DEFAULT NULL,
    salary_range TEXT,
    per ENUM('hour', 'day', 'month', 'week') DEFAULT NULL,
    address VARCHAR(255) DEFAULT NULL,
    tags TEXT,
    short_description TEXT,
    key_responsibilities TEXT,
    job_reference_number VARCHAR(100) UNIQUE DEFAULT NULL,
    title VARCHAR(100) DEFAULT NULL,
    report_to VARCHAR(100) DEFAULT NULL,
    available_position INT DEFAULT NULL,
    total INT DEFAULT NULL,
    type ENUM('Remote', 'OnSite') DEFAULT 'OnSite',
    experience ENUM('Expert', 'Intern', 'Fresher', 'Junior') DEFAULT 'Junior',
    essential TEXT,
    preferable TEXT,
    logo_image TEXT
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    if ($conn->query($createTableSQL) === TRUE) {
        echo "Table 'jobs' created successfully.<br>";
    } else {
        die("Error creating table: " . $conn->error);
    }
}

$jobs = [
    [
        "company_name" => "TechCorp",
        "position" => "Frontend Developer",
        "salary_range" => "1200-1800",
        "per" => "week",
        "address" => "123 Tech Street",
        "tags" => ["HTML", "CSS", "JS", "React", "Vue"],
        "short_description" => "Responsible for creating engaging, user-friendly web interfaces and ensuring cross-browser compatibility.",
        "key_responsibilities" => "Implement new frontend features and functionality\nOptimize code for maximum performance\nCollaborate with UX designers and backend developers",
        "job_reference_number" => "FE123",
        "title" => "Frontend Developer",
        "report_to" => "Head of Engineering",
        "available_position" => 5,
        "total" => 20,
        "type" => "Remote",
        "experience" => "Expert",
        "essential" => ["Proficient in HTML5, CSS3, JS (2+ years)", "Experience with React or Vue"],
        "preferable" => ["Familiarity with Docker and CI/CD", "Good communication in English"],
        "logo_image" => "techcorp_logo.png"
    ],
    [
        "company_name" => "Designify",
        "position" => "UI/UX Designer",
        "salary_range" => "100-800",
        "per" => "week",
        "address" => "456 Design Avenue",
        "tags" => ["UX", "UI", "Figma", "Sketch"],
        "short_description" => "Plan and create visually appealing, user-centered interfaces for both web and mobile platforms.",
        "key_responsibilities" => "Develop wireframes and prototypes\nDesign UI based on core UX principles\nConduct user research and A/B testing",
        "job_reference_number" => "UX789",
        "title" => "UI/UX Designer",
        "report_to" => "Product Manager",
        "available_position" => 1,
        "total" => 30,
        "type" => "OnSite",
        "experience" => "Intern",
        "essential" => ["Figma or Sketch proficiency", "Solid grasp of UX best practices"],
        "preferable" => ["Illustration skills", "Familiar with Agile/Scrum"],
        "logo_image" => "designify_logo.png"
    ]
];

$insertJobSQL = "
    INSERT INTO jobs (
        company_name, position, salary_range, per, address, tags,
        short_description, key_responsibilities, job_reference_number,
        title, report_to, available_position, total, type, experience,
        essential, preferable, logo_image
    ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
    ) ON DUPLICATE KEY UPDATE job_reference_number = job_reference_number";

$stmt = $conn->prepare($insertJobSQL);

foreach ($jobs as $job) {
    $tags_json = json_encode($job['tags']);
    $essential_json = json_encode($job['essential']);
    $preferable_json = json_encode($job['preferable']);

    $stmt->bind_param(
        "sssssssssssiisssss",
        $job['company_name'], $job['position'], $job['salary_range'], $job['per'],
        $job['address'], $tags_json, $job['short_description'],
        $job['key_responsibilities'], $job['job_reference_number'],
        $job['title'], $job['report_to'], $job['available_position'],
        $job['total'], $job['type'], $job['experience'],
        $essential_json, $preferable_json, $job['logo_image']
    );

    if ($stmt->execute()) {
        echo "Job '{$job['position']}' added successfully!<br>";
    } else {
        die("Error inserting job: " . $conn->error);
    }
}

// ===== Retrieve Data =====
echo "<h2>Job Listings:</h2>";

$selectJobSQL = "SELECT * FROM jobs";
$result = $conn->query($selectJobSQL);

if ($result->num_rows > 0) {
    while ($job = $result->fetch_assoc()) {
        echo "<h3>{$job['position']} ({$job['type']}, {$job['experience']})</h3>";
        echo "<strong>Company:</strong> {$job['company_name']}<br>";
        echo "<strong>Salary Range:</strong> {$job['salary_range']} per {$job['per']}<br>";
        echo "<strong>Reports to:</strong> {$job['report_to']}<br>";
        echo "<strong>Tags:</strong> " . implode(", ", json_decode($job['tags'], true)) . "<br>";
        echo "<strong>Essential Skills:</strong> " . implode(", ", json_decode($job['essential'], true)) . "<br>";
        echo "<strong>Preferable Skills:</strong> " . implode(", ", json_decode($job['preferable'], true)) . "<br>";
        echo "<hr>";
    }
} else {
    echo "No jobs found.";
}

$stmt->close();
$conn->close();
?>

