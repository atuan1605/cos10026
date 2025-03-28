<?php
require_once __DIR__ . '/settings.php'; // Include DB connection settings

$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tableCheckQuery = "SHOW TABLES LIKE 'jobs'";
$tableCheckResult = $conn->query($tableCheckQuery);

if ($tableCheckResult && $tableCheckResult->num_rows === 0) {
    $createTableSQL = "CREATE TABLE jobs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        deleted_at TIMESTAMP NULL DEFAULT NULL,
        updated_at TIMESTAMP NULL DEFAULT NULL,
        company_name VARCHAR(100) DEFAULT NULL,
        position VARCHAR(100) DEFAULT NULL,
        salary_range TEXT,
        per ENUM('hour', 'day', 'month') DEFAULT NULL,
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
        experience ENUM('Senior', 'Middle', 'Junior') DEFAULT 'Junior',
        essential TEXT,
        preferable TEXT,
        logo_image TEXT,
        working_schedule ENUM('Full time', 'Part time', 'Internship', 'Project work', 'Volunteering') DEFAULT NULL,
        employment_types TEXT 
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    if (!$conn->query($createTableSQL)) {
        die("Error creating table: " . $conn->error);
    }
}

$jobs = [
    [
        'jobNumber' => 'fourth',
        "company_name" => "TechCorp",
        "title" => "Frontend Developer",
        "position" => "Developer",
        "per" => "month",
        "job_reference_number" => "FE123",
        "address" => "123 Tech Street",
        "salary_range" => "1200-1800",
        'date' => '20 May, 2023',
        "tags" => ["HTML", "CSS", "JS", "React", "Vue"],
        "short_description" => "Responsible for creating engaging, user-friendly web interfaces and ensuring cross-browser compatibility.",
        "key_responsibilities" => "Implement new frontend features and functionality\nOptimize code for maximum performance\nCollaborate with UX designers and backend developers",
        "report_to" => "Head of Engineering",
        "available_position" => 5,
        "total" => 20,
        "type" => "Remote",
        "experience" => "Senior",
        "essential" => ["Proficient in HTML5, CSS3, JS (2+ years)", "Experience with React or Vue"],
        "preferable" => ["Familiarity with Docker and CI/CD", "Good communication in English"],
        "logo_image" => "./styles/images/dribble.png",
        "working_schedule" => "Full time",
        "employment_types" => ["Full day", "Flexible schedule"]

    ],
    [
        'jobNumber' => 'second',
        "company_name" => "Designify",
        "title" => "UI/UX Designer",
        "position" => "Designer",
        "per" => "hour",
        "job_reference_number" => "UX789",
        "address" => "456 Design Avenue",
        "salary_range" => "100-800",
        'date' => '15 June, 2023',
        "tags" => ["UX", "UI", "Figma", "Sketch"],
        "short_description" => "Plan and create visually appealing, user-centered interfaces for both web and mobile platforms.",
        "key_responsibilities" => "Develop wireframes and prototypes\nDesign UI based on core UX principles\nConduct user research and A/B testing",
        "report_to" => "Product Manager",
        "available_position" => 1,
        "total" => 30,
        "type" => "OnSite",
        "experience" => "Junior",
        "essential" => ["Figma or Sketch proficiency", "Solid grasp of UX best practices"],
        "preferable" => ["Illustration skills", "Familiar with Agile/Scrum"],
        "logo_image" => "./styles/images/figma.png",
        "working_schedule" => "Part time",
        "employment_types" => ["Flexible schedule", "Shift method"]

    ],
    [
        'jobNumber' => 'first',
        "company_name" => "CloudNet Solutions",
        "title" => "Backend Developer",
        "position" => "Developer",
        "per" => "month",
        "job_reference_number" => "BE456",
        "address" => "789 Cloud Road",
        "salary_range" => "1500-2500",
        'date' => '10 July, 2023',
        "tags" => ["Node.js", "Express", "MongoDB", "API", "Docker"],
        "short_description" => "Develop and maintain scalable server-side applications and APIs.",
        "key_responsibilities" => "Design RESTful APIs\nOptimize database queries\nImplement security best practices",
        "report_to" => "CTO",
        "available_position" => 3,
        "total" => 15,
        "type" => "Remote",
        "experience" => "Junior",
        "essential" => ["Proficient in Node.js and Express", "Understanding of databases (SQL/NoSQL)"],
        "preferable" => ["Experience with Docker", "Knowledge of cloud services"],
        "logo_image" => "cloudnet_logo.png",
        "working_schedule" => "Part time",
        "employment_types" => ["Shift method", "Flexible schedule"]
    ],
    [
        'jobNumber' => 'third',
        "company_name" => "Appify Inc.",
        "title" => "Mobile App Developer",
        "position" => "Developer",
        "per" => "day",
        "job_reference_number" => "MOB202",
        "address" => "101 App Street",
        "salary_range" => "800-1500",
        'date' => '05 August, 2023',
        "tags" => ["Flutter", "Android", "iOS", "Dart"],
        "short_description" => "Build high-performance mobile applications for Android and iOS.",
        "key_responsibilities" => "Develop cross-platform mobile apps\nOptimize app performance\nCollaborate with UX/UI designers",
        "report_to" => "Mobile Lead",
        "available_position" => 2,
        "total" => 10,
        "type" => "OnSite",
        "experience" => "Middle",
        "essential" => ["Familiarity with Flutter and Dart", "Understanding of mobile app lifecycle"],
        "preferable" => ["Experience with Firebase", "Basic knowledge of native Android/iOS"],
        "logo_image" => "appify_logo.png",
        "working_schedule" => "Internship",
        "employment_types" => ["Shift work", "Flexible schedule"]
    ],
    [
        'jobNumber' => 'last',
        "company_name" => "DataWorks",
        "title" => "Data Analyst",
        "position" => "Product Manager",
        "per" => "hour",
        "job_reference_number" => "DA789",
        "address" => "222 Analytics Lane",
        "salary_range" => "1000-2000",
        'date' => '12 September, 2023',
        "tags" => ["SQL", "Python", "Excel", "Power BI", "Data Visualization"],
        "short_description" => "Analyze datasets to extract insights and support data-driven decisions.",
        "key_responsibilities" => "Clean and process data\nGenerate reports\nCreate visualizations",
        "report_to" => "Head of Analytics",
        "available_position" => 4,
        "total" => 12,
        "type" => "Remote",
        "experience" => "Middle",
        "essential" => ["Proficiency in SQL and Python", "Experience with data visualization tools"],
        "preferable" => ["Machine learning knowledge", "Strong presentation skills"],
        "logo_image" => "dataworks_logo.png",
        "working_schedule" => "Project work",
        "employment_types" => ["Full day", "Distant work"]
    ],
    [
        'jobNumber' => 'fifth',
        "company_name" => "CyberSec Solutions",
        "title" => "Cybersecurity Analyst",
        "position" => "Product Manager",
        "per" => "day",
        "job_reference_number" => "CS987",
        "address" => "555 Secure Drive",
        "salary_range" => "1800-3000",
        'date' => '15 Mar, 2024',
        "tags" => ["Cybersecurity", "Network Security", "SIEM", "Incident Response"],
        "short_description" => "Monitor and defend against cybersecurity threats to protect critical infrastructure.",
        "key_responsibilities" => "Analyze security breaches\nDevelop response plans\nImplement security protocols",
        "report_to" => "Security Operations Manager",
        "available_position" => 3,
        "total" => 12,
        "type" => "Remote",
        "experience" => "Senior",
        "essential" => ["Experience with SIEM tools", "Understanding of network protocols"],
        "preferable" => ["Cybersecurity certifications (e.g., CISSP, CEH)", "Knowledge of threat intelligence"],
        "logo_image" => "cybersec_logo.png",
        "working_schedule" => "Full Time",
        "employment_types" => ["Full day", "Distant work"]
    ]
];


$insertJobSQL = "
    INSERT INTO jobs (
        company_name, title, position, salary_range, per, address, tags,
        short_description, key_responsibilities, job_reference_number,
        report_to, available_position, total, type, experience,
        essential, preferable, logo_image, working_schedule, employment_types
    ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
    ) ON DUPLICATE KEY UPDATE job_reference_number = job_reference_number";

$stmt = $conn->prepare($insertJobSQL);

foreach ($jobs as $job) {
    $tags_json = json_encode($job['tags']);
    $essential_json = json_encode($job['essential']);
    $preferable_json = json_encode($job['preferable']);
    $employment_types_json = json_encode($job['employment_types']);

  
    $stmt->bind_param(
        "sssssssssssiisssssss",
        $job['company_name'],
        $job['title'],
        $job['position'],
        $job['salary_range'],
        $job['per'],
        $job['address'],
        $tags_json,
        $job['short_description'],
        $job['key_responsibilities'],
        $job['job_reference_number'],
        $job['report_to'],
        $job['available_position'], // INT
        $job['total'],              // INT
        $job['type'],
        $job['experience'],
        $essential_json,
        $preferable_json,
        $job['logo_image'],
        $job['working_schedule'],
        $employment_types_json
    );

    $stmt->execute();
}

$stmt->close();
$conn->close();
