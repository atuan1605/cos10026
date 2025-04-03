<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Enhancements 2 - LuckyJob</title>
  <link rel="stylesheet" href="./styles/style.css" />
  <link rel="preload" as="image" href="./styles/images/snackbar-example.jpg">
  <link rel="preload" as="image" href="./styles/images/dynamic-application.jpg">
  <link rel="preload" as="image" href="./styles/images/create-job-browser.jpg">
  <link rel="preload" as="image" href="./styles/images/jobref-autofill.jpg">
</head>
<body class="homepage">

<?php include 'header.php'; ?>

<div class="main-content">
  <section class="enhancements">
    <div class="tab-navigation">
      <a href="enhancements.php" class="<?= $currentPage == 'enhancements.php' ? 'active-tab' : '' ?>">Part 1</a>
      <a href="enhancements_part2.php" class="<?= $currentPage == 'enhancements_part2.php' ? 'active-tab' : '' ?>">Part 2</a>
    </div>

    <h1>Dynamic Enhancements</h1>
    <p>These enhancements make the LuckyJob system more dynamic and automated by eliminating the need for manual database edits.</p>

    <!-- 1. Dynamic Snackbar -->
    <div class="enhancement">
      <h2>1. Dynamic Snackbar Notification System</h2>
      <p>Instead of manually echoing alert messages, the site now uses a global <code>snackbar.php</code> component that displays dynamic success/error messages across pages.</p>
      <p>These messages are passed to the snackbar using <code>$_SESSION['snackbarMessage']</code> and <code>$_SESSION['snackbarType']</code>:</p>
      <pre><code>// In any page
$_SESSION['snackbarMessage'] = "Action successful!";
$_SESSION['snackbarType'] = "success"; // or "error"
include 'snackbar.php';
      </code></pre>
      <div class="enhancement-image">
        <img src="./styles/images/snackbar-example.jpg" alt="Snackbar example" />
      </div>
    </div>

    <!-- 2. Fully Dynamic Application System -->
    <div class="enhancement">
      <h2>2. Fully Dynamic Application System</h2>
      <p>When a user successfully applies for a job:</p>
      <ul>
        <li>They are automatically assigned the <strong>Member</strong> role (visible on <a href="about.php">About page</a>).</li>
        <li>The <strong>job's available_position</strong> value is decreased by 1.</li>
        <li>If available positions reach 0, that job is automatically hidden from the <a href="jobs.php">Jobs page</a>.</li>
         <li>Member or Admin cannot submit an EOI</li>
      </ul>
      <p>This eliminates the need for admins to manually update the database after each application.</p>
      <div class="enhancement-image">
        <img src="./styles/images/dynamic-application.jpg" alt="Dynamic job and member system">
      </div>
      <pre><code>
// In manage.php
if ($action === 'approve' && $available > 0 && $status !== 'Approved') {

  $conn->query("UPDATE eoi SET status = 'Approved' WHERE id = $eoi_id");

  $conn->query("UPDATE users SET role = 'Member' WHERE id = $user_id");

  $conn->query("UPDATE jobs SET available_position = available_position - 1 WHERE job_reference_number = '$jobRef'");
}

// In process_eoi.php
UPDATE jobs SET available_position = available_position - 1 WHERE job_reference_number = ?

UPDATE users SET role = 'Member' WHERE id = ?

// In jobs.php
SELECT * FROM jobs WHERE available_position > 0

//In process_eoi.php
if (in_array($userRole, ['Admin', 'Member'])) {
    //print the Application Denied
}

      </code></pre>
    </div>

    <!-- 3. One-File Database Setup -->
    <div class="enhancement">
      <h2>3. One-File Database and Model Setup</h2>
      <p>All database tables, including <strong>users</strong>, <strong>jobs</strong>, <strong>eoi</strong>, and <strong>timetables</strong>, are created using a single PHP script.</p>
      <p>This provides a fast and efficient way to set up new environments and simplifies deployment.</p>
      <pre><code>// initializeBD.php
require_once 'create_users_table.php';
require_once 'adding_user.php';
require_once 'create_jobs_table.php';
require_once 'create_timetables.php';
require_once 'create_eoi_table.php';
      </code></pre>
      <p>Running the <code>create_all_tables.php</code> script will automatically create all necessary tables for the system.</p>
    </div>

    <!-- 4. Auto-Fill Job Reference Number -->
    <div class="enhancement">
      <h2>4. Auto-Fill Job Reference Number</h2>
      <p>When a user clicks on a job to apply, the job reference number is passed as a query parameter to <code>apply.php</code>. This automatically fills in the job reference number on the form:</p>
      <pre><code>// In apply.php
$jobRef = $_GET['job_reference_number'] ?? '';
      </code></pre>
      <p>This allows users to apply without needing to remember or manually input the job reference number.</p>
      <div class="enhancement-image">
        <img src="./styles/images/jobref-autofill.jpg" alt="Auto-filled Job Reference">
      </div>
    </div>

    <!-- 5. Create Job Directly in Browser -->
    <div class="enhancement">
      <h2>5. Create Job Directly from Browser</h2>
      <p>Admins can create job listings directly from the browser using a form in <a href="manageJobs.php">manageJobs.php</a>.</p>
      <p>This functionality is secured for admins only, ensuring that job creation is done properly without accessing the database directly.</p>
      <div class="enhancement-image">
        <img src="./styles/images/create-job-browser.jpg" alt="Create Job from Browser">
      </div>
    </div>

  </section>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
