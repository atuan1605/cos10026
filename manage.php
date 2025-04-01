<?php
session_start();
require_once './db/settings.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    echo "<div class='response error'><h2>Access Denied</h2><p>You must be an admin to access this page.</p></div>";
    exit();
}

$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Handle POST actions (Approve, Reject, Delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eoi_id'], $_POST['action'])) {
    $eoi_id = intval($_POST['eoi_id']);
    $action = $_POST['action'];

    $getInfo = $conn->prepare("SELECT e.user_id, e.job_reference_number, j.available_position FROM eoi e JOIN jobs j ON e.job_reference_number = j.job_reference_number WHERE e.id = ?");
    $getInfo->bind_param("i", $eoi_id);
    $getInfo->execute();
    $infoResult = $getInfo->get_result();
    $info = $infoResult->fetch_assoc();
    $getInfo->close();

    if ($info) {
        $user_id = $info['user_id'];
        $jobRef = $info['job_reference_number'];
        $available = (int)$info['available_position'];

        if ($action === 'approve' && $available > 0) {
            // Update EOI status to approved
            $conn->query("UPDATE eoi SET status = 'Approved' WHERE id = $eoi_id");

            // Update user role to 'Member'
            $conn->query("UPDATE users SET role = 'Member' WHERE id = $user_id");

            // Decrease available positions for the job
            $conn->query("UPDATE jobs SET available_position = available_position - 1 WHERE job_reference_number = '$jobRef'");
        } elseif ($action === 'reject') {
            // Update EOI status to rejected
            $conn->query("UPDATE eoi SET status = 'Rejected' WHERE id = $eoi_id");
        } elseif ($action === 'delete') {
            // Delete the EOI
            $conn->query("DELETE FROM eoi WHERE id = $eoi_id");
        }
    }
}

// Filtering
$searchBy = $_GET['search_by'] ?? 'job_reference_number';
$searchTerm = trim($_GET['search'] ?? '');
$validFields = ['job_reference_number', 'first_name', 'last_name', 'email'];
if (!in_array($searchBy, $validFields)) $searchBy = 'job_reference_number';

$sql = "SELECT e.*, u.username, j.available_position FROM eoi e
        JOIN users u ON e.user_id = u.id
        JOIN jobs j ON e.job_reference_number = j.job_reference_number
        WHERE e.$searchBy LIKE ?";
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
  <title>Manage EOIs</title>
  <link rel="stylesheet" href="./styles/style.css">
</head>
<?php include 'header.php'; ?>

<div class="manage-container">
  <h1>Manage EOIs</h1>

  <form class="manage-form" method="GET" action="manage.php">
    <select name="search_by">
      <option value="job_reference_number" <?= $searchBy == 'job_reference_number' ? 'selected' : '' ?>>Job Ref</option>
      <option value="first_name" <?= $searchBy == 'first_name' ? 'selected' : '' ?>>First Name</option>
      <option value="last_name" <?= $searchBy == 'last_name' ? 'selected' : '' ?>>Last Name</option>
      <option value="email" <?= $searchBy == 'email' ? 'selected' : '' ?>>Email</option>
    </select>
    <input type="text" name="search" placeholder="Enter search..." value="<?= htmlspecialchars($searchTerm) ?>">
    <button type="submit" class="btn-login">Filter</button>
  </form>

  <?php if ($results->num_rows > 0): ?>
    <table class="manage-table">
      <thead>
        <tr>
          <th>EOI ID</th>
          <th>Job Ref</th>
          <th>Username</th>
          <th>Applicant</th>
          <th>Email</th>
          <th>Status</th>
          <th>Submitted</th>
          <th>Available</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $results->fetch_assoc()): ?>
          <tr>
            <td><?= 'EOI' . $row['id'] ?></td>
            <td><?= htmlspecialchars($row['job_reference_number']) ?></td>
            <td><?= htmlspecialchars($row['username']) ?></td>
            <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['status']) ?></td>
            <td><?= htmlspecialchars($row['created_at'] ?? 'N/A') ?></td>
            <td><?= (int)$row['available_position'] ?></td>
            <td class="action-buttons">
              <?php if ((int)$row['available_position'] > 0): ?>
                <form method="POST" action="manage.php" style="display:inline;">
                  <input type="hidden" name="eoi_id" value="<?= $row['id'] ?>">
                  <input type="hidden" name="action" value="approve">
                  <button type="submit" class="btn-approve manage-btn">Approve</button>
                </form>
                <form method="POST" action="manage.php" style="display:inline;">
                  <input type="hidden" name="eoi_id" value="<?= $row['id'] ?>">
                  <input type="hidden" name="action" value="reject">
                  <button type="submit" class="btn-reject manage-btn">Reject</button>
                </form>
              <?php endif; ?>
              <form method="POST" action="manage.php" style="display:inline;">
                <input type="hidden" name="eoi_id" value="<?= $row['id'] ?>">
                <input type="hidden" name="action" value="delete">
                <button type="submit" class="btn-delete manage-btn">Delete</button>
              </form>
              <?php if ((int)$row['available_position'] <= 0): ?>
                <div style="font-size: 0.85rem; color: red;">Job full</div>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="no-results">No EOIs found.</div>
  <?php endif; ?>

  <?php $stmt->close(); $conn->close(); ?>
</div>
</body>
</html>
