<?php
session_start();
require_once './db/settings.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    echo "<div class='response error'><h2>Access Denied</h2><p>You must be an admin to access this page.</p></div>";
    exit();
}

$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Handle delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['job_id'], $_POST['action']) && $_POST['action'] === 'delete') {
    $jobId = $_POST['job_id'];
    $conn->query("DELETE FROM jobs WHERE job_reference_number = '$jobId'");
}

// Search
$searchBy = $_GET['search_by'] ?? 'title';
$searchTerm = trim($_GET['search'] ?? '');
$validFields = ['job_reference_number', 'title', 'company_name', 'position', 'address'];
if (!in_array($searchBy, $validFields)) $searchBy = 'title';

$sql = "SELECT * FROM jobs WHERE $searchBy LIKE ? ORDER BY created_at DESC, available_position DESC";
$stmt = $conn->prepare($sql);
$likeTerm = "%$searchTerm%";
$stmt->bind_param("s", $likeTerm);
$stmt->execute();
$results = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Jobs</title>
  <link rel="stylesheet" href="./styles/style.css">
</head>


<body>
<?php include 'header.php'; ?>
<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>

<div class="manage-container">
  <div class="tab-navigation">
  <a href="manage.php" class="<?= $currentPage == 'manage.php' ? 'active-tab' : '' ?>">EOI</a>
  <a href="manageJobs.php" class="<?= $currentPage == 'manageJobs.php' ? 'active-tab' : '' ?>">Job</a>
</div>
  <h1>Manage Jobs</h1>

  <form class="manage-form" method="GET" action="manageJobs.php">
    <select name="search_by">
      <option value="title" <?= $searchBy == 'title' ? 'selected' : '' ?>>Title</option>
      <option value="job_reference_number" <?= $searchBy == 'job_reference_number' ? 'selected' : '' ?>>Job Ref</option>
      <option value="company_name" <?= $searchBy == 'company_name' ? 'selected' : '' ?>>Company</option>
      <option value="position" <?= $searchBy == 'position' ? 'selected' : '' ?>>Position</option>
      <option value="address" <?= $searchBy == 'address' ? 'selected' : '' ?>>Location</option>
    </select>
    <input type="text" name="search" placeholder="Search jobs..." value="<?= htmlspecialchars($searchTerm) ?>">
    <button type="submit" class="btn-login">Search</button>
    <a href="job_form.php" class="manage-btn" style="margin-left:auto;">+ Add Job</a>
  </form>

  <?php if ($results->num_rows > 0): ?>
    <div class="table-wrapper">
      <table class="manage-table">
        <thead>
          <tr>
            <th>Job Ref</th>
            <th>Title</th>
            <th>Company</th>
            <th>Position</th>
            <th>Type</th>
            <th>Experience</th>
            <th>Salary</th>
            <th>Schedule</th>
            <th>Available</th>
            <th>Created</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php while ($job = $results->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($job['job_reference_number']) ?></td>
              <td><?= htmlspecialchars($job['title']) ?></td>
              <td><?= htmlspecialchars($job['company_name']) ?></td>
              <td><?= htmlspecialchars($job['position']) ?></td>
              <td><?= htmlspecialchars($job['type']) ?></td>
              <td><?= htmlspecialchars($job['experience']) ?></td>
              <td><?= htmlspecialchars($job['salary_range']) . ' / ' . $job['per'] ?></td>
              <td><?= htmlspecialchars($job['working_schedule']) ?></td>
              <td><?= (int)$job['available_position'] ?></td>
              <td><?= htmlspecialchars($job['created_at']) ?></td>
              <td class="action-buttons" id="job-action-cell">
                <div class="job-action-wrapper">
                 <a href="job_form.php?job=<?= $job['job_reference_number'] ?>" class="btn-approve job-action-btn">Edit</a>
                  <form method="POST" action="manageJobs.php"
                        onsubmit="return confirm('Are you sure you want to delete this job?');"
                        style="display:inline;">
                    <input type="hidden" name="job_id" value="<?= $job['job_reference_number'] ?>">
                    <input type="hidden" name="action" value="delete">
                    <button type="submit" class="btn-delete job-action-btn">Delete</button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>

      </table>
    </div>
  <?php else: ?>
    <div class="no-results">No jobs found.</div>
  <?php endif; ?>

  <?php $stmt->close(); $conn->close(); ?>
</div>


</body>
</html>
