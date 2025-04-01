<?php
session_start();
require_once './db/settings.php';

if (!isset($_SESSION['user'])) {
    die("<div class='response error'><h2>Access Denied</h2><p>You must be logged in to apply.</p></div>");
}

$currentUser = $_SESSION['user'];
$userId = $currentUser['id'] ?? null;
$userRole = $currentUser['role'] ?? '';

if (in_array($userRole, ['Admin', 'Member'])) {
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Application Denied</title>
      <link rel="stylesheet" href="./styles/style.css" />
    </head>
    <body>
      <div class="response-container">
        <div class="response error">
          <h2>Application Denied</h2>
          <p>You are already part of the company and cannot submit an EOI.</p>
          <a href="index.php"><button>Back to homepage</button></a>
        </div>
      </div>
    </body>
    </html>
    HTML;
    exit();
}

function isValidDOB($dob) {
    $birthDate = DateTime::createFromFormat('Y-m-d', $dob);
    if (!$birthDate) return false;
    $today = new DateTime();
    $age = $today->diff($birthDate)->y;
    return $age >= 15 && $age <= 80;
}

$jobRef = $_POST['jobRef'] ?? '';
$firstName = trim($_POST['firstName'] ?? '');
$lastName = trim($_POST['lastName'] ?? '');
$dob = $_POST['dob'] ?? '';
$gender = $_POST['gender'] ?? '';
$address = trim($_POST['address'] ?? '');
$suburb = trim($_POST['suburb'] ?? '');
$state = $_POST['state'] ?? '';
$postcode = $_POST['postcode'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$skills = $_POST['skills'] ?? [];
$otherSkills = trim($_POST['otherSkills'] ?? '');

$errors = [];

if (!preg_match('/^[A-Za-z0-9]{5}$/', $jobRef)) {
    $errors[] = "Job reference number must be exactly 5 alphanumeric characters.";
}

if (!preg_match('/^[A-Za-z ]{1,20}$/', $firstName)) {
    $errors[] = "First name must contain only letters and max 20 characters.";
}

if (!preg_match('/^[A-Za-z ]{1,20}$/', $lastName)) {
    $errors[] = "Last name must contain only letters and max 20 characters.";
}

if (!isValidDOB($dob)) {
    $errors[] = "Date of birth must result in an age between 15 and 80.";
}

if (empty($gender)) {
    $errors[] = "Gender is required.";
}

if (strlen($address) > 40) {
    $errors[] = "Street address must be max 40 characters.";
}

if (strlen($suburb) > 40) {
    $errors[] = "Suburb/Town must be max 40 characters.";
}

$validStates = ['VIC','NSW','QLD','NT','WA','SA','TAS','ACT'];
if (!in_array($state, $validStates)) {
    $errors[] = "Invalid state selected.";
}

if (!preg_match('/^[0-9]{4}$/', $postcode)) {
    $errors[] = "Postcode must be exactly 4 digits.";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email address.";
}

if (!preg_match('/^[0-9 ]{8,12}$/', $phone)) {
    $errors[] = "Phone must be 8–12 digits or spaces.";
}

if (in_array('Other', $skills) && empty($otherSkills)) {
    $errors[] = "Please describe your other skills.";
}

if (!empty($errors)) {
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Validation Errors</title>
      <link rel="stylesheet" href="./styles/style.css" />
    </head>
    <body>
      <div class="response-container">
        <div class="response error">
          <h2>Validation Errors</h2>
          <ul>
    HTML;

    foreach ($errors as $e) {
        echo "<li>" . htmlspecialchars($e) . "</li>";
    }

    echo <<<HTML
          </ul>
          <a href="apply.php?job_reference_number={$jobRef}"><button>Go back</button></a>
        </div>
      </div>
    </body>
    </html>
    HTML;
    exit();
}

$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$checkStmt = $conn->prepare("SELECT id FROM eoi WHERE user_id = ? AND job_reference_number = ?");
$checkStmt->bind_param("is", $userId, $jobRef);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Duplicate Application</title>
      <link rel="stylesheet" href="./styles/style.css" />
    </head>
    <body>
      <div class="response-container">
        <div class="response error">
          <h2>Duplicate Application</h2>
          <p>You have already submitted an EOI for this job.</p>
          <a href="index.php"><button>Back to homepage</button></a>
        </div>
      </div>
    </body>
    </html>
    HTML;
    $checkStmt->close();
    $conn->close();
    exit();
}
$checkStmt->close();

$skillsList = implode(", ", $skills);
$stmt = $conn->prepare("INSERT INTO eoi (user_id, job_reference_number, first_name, last_name, dob, gender, address, suburb, state, postcode, email, phone, skills, other_skills, status)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'New')");
$stmt->bind_param("isssssssssssss", $userId, $jobRef, $firstName, $lastName, $dob, $gender, $address, $suburb, $state, $postcode, $email, $phone, $skillsList, $otherSkills);

if ($stmt->execute()) {
    $eoiId = $stmt->insert_id;
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>EOI Submitted</title>
      <link rel="stylesheet" href="./styles/style.css" />
    </head>
    <body>
      <div class="response-container">
        <div class="response success">
          <h2>Application submitted successfully!</h2>
          <p>Your EOI Number is: <strong>EOI{$eoiId}</strong></p>
          <a href="index.php"><button>Back to homepage</button></a>
        </div>
      </div>
    </body>
    </html>
    HTML;
} else {
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Submission Error</title>
      <link rel="stylesheet" href="./styles/style.css" />
    </head>
    <body>
      <div class="response-container">
        <div class="response error">
          <h2>Error submitting application</h2>
          <p>" . htmlspecialchars($stmt->error) . "</p>
          <a href="index.php"><button>Back to homepage</button></a>
        </div>
      </div>
    </body>
    </html>
    HTML;
}

$stmt->close();
$conn->close();
?>
