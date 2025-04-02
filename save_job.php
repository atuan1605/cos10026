<?php
session_start();
require_once './db/settings.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    echo "<div class='response error'><h2>Access Denied</h2></div>";
    exit();
}

$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$isEdit = isset($_POST['is_edit']) && $_POST['is_edit'] === '1';
$ref = $_POST['job_reference_number'] ?? '';

$title = $_POST['title'] ?? '';
$company = $_POST['company_name'] ?? '';
$position = $_POST['position'] ?? '';
$salary = $_POST['salary_range'] ?? '';
$per = $_POST['per'] ?? '';
$address = $_POST['address'] ?? '';
$tags = $_POST['tags'] ?? '[]';
$desc = $_POST['short_description'] ?? '';
$resp = $_POST['key_responsibilities'] ?? '';
$reportTo = $_POST['report_to'] ?? '';
$available = intval($_POST['available_position'] ?? 0);
$total = intval($_POST['total'] ?? 0);
$type = $_POST['type'] ?? '';
$experience = $_POST['experience'] ?? '';
$essential = $_POST['essential'] ?? '[]';
$preferable = $_POST['preferable'] ?? '[]';
$logo = $_POST['logo_image'] ?? '';
$schedule = $_POST['working_schedule'] ?? '';
$employmentTypes = $_POST['employment_types'] ?? '[]';

if ($isEdit) {
    $stmt = $conn->prepare("
        UPDATE jobs SET
            title = ?, company_name = ?, position = ?, salary_range = ?, per = ?, address = ?, tags = ?,
            short_description = ?, key_responsibilities = ?, report_to = ?, available_position = ?, total = ?,
            type = ?, experience = ?, essential = ?, preferable = ?, logo_image = ?, working_schedule = ?, employment_types = ?, updated_at = NOW()
        WHERE job_reference_number = ?
    ");
    $stmt->bind_param(
        "ssssssssssiissssssss",
        $title, $company, $position, $salary, $per, $address, $tags,
        $desc, $resp, $reportTo, $available, $total, $type, $experience, $essential, $preferable,
        $logo, $schedule, $employmentTypes, $ref
    );

} else {
    if (empty($ref)) {
        do {
            $ref = uniqid("REF");
            $check = $conn->prepare("SELECT 1 FROM jobs WHERE job_reference_number = ?");
            $check->bind_param("s", $ref);
            $check->execute();
            $check->store_result();
        } while ($check->num_rows > 0);
        $check->close();
    } else {
        $check = $conn->prepare("SELECT 1 FROM jobs WHERE job_reference_number = ?");
        $check->bind_param("s", $ref);
        $check->execute();
        $check->store_result();
        if ($check->num_rows > 0) {
            echo "<div class='response error'><h2>Error</h2><p>Job Reference Number '$ref' already exists. Please use another.</p></div>";
            exit();
        }
        $check->close();
    }

    $stmt = $conn->prepare("
        INSERT INTO jobs (
            job_reference_number, title, company_name, position, salary_range, per, address, tags,
            short_description, key_responsibilities, report_to, available_position, total,
            type, experience, essential, preferable, logo_image, working_schedule, employment_types
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param(
        "ssssssssssiissssssss",
        $ref, $title, $company, $position, $salary, $per, $address, $tags,
        $desc, $resp, $reportTo, $available, $total, $type, $experience, $essential, $preferable,
        $logo, $schedule, $employmentTypes
    );
}

if ($stmt->execute()) {
    header("Location: manageJobs.php?success=" . ($isEdit ? 'edit' : 'create'));
    exit();
} else {
    echo "<div class='response error'><h2>Error Saving Job</h2><p>" . $stmt->error . "</p></div>";
}

$stmt->close();
$conn->close();
?>
