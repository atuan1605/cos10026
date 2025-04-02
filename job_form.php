<?php
require_once './db/settings.php';

$isEdit = isset($_GET['job']);
$job = [];

if ($isEdit) {
    $jobRef = $_GET['job'];
    $conn = new mysqli($host, $user, $pwd, $sql_db);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    $stmt = $conn->prepare("SELECT * FROM jobs WHERE job_reference_number = ?");
    $stmt->bind_param("s", $jobRef);
    $stmt->execute();
    $result = $stmt->get_result();
    $job = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $isEdit ? 'Edit' : 'Create' ?> Job</title>
  <link rel="stylesheet" href="./styles/style.css">
</head>
<body>

<div class="job-form-container">
  <h1><?= $isEdit ? 'Edit' : 'Create' ?> Job</h1>
  <form action="save_job.php" method="POST">

    <!-- Indicate Edit or Create mode -->
    <input type="hidden" name="is_edit" value="<?= $isEdit ? '1' : '0' ?>">

    <!-- Job Reference -->
    <div class="job-form-group">
      <label for="job_reference_number">Job Reference Number</label>
      <input type="text" name="job_reference_number" id="job_reference_number"
             value="<?= htmlspecialchars($job['job_reference_number'] ?? '') ?>"
             <?= $isEdit ? 'readonly' : 'required' ?>>
    </div>

    <!-- Other Fields -->
    <div class="job-form-group">
      <label for="title">Title</label>
      <input type="text" name="title" id="title" value="<?= htmlspecialchars($job['title'] ?? '') ?>" required>
    </div>

    <div class="job-form-group">
      <label for="company_name">Company</label>
      <input type="text" name="company_name" id="company_name" value="<?= htmlspecialchars($job['company_name'] ?? '') ?>" required>
    </div>

    <div class="job-form-group">
      <label for="position">Position</label>
      <input type="text" name="position" id="position" value="<?= htmlspecialchars($job['position'] ?? '') ?>" required>
    </div>

    <div class="job-form-group">
      <label for="salary_range">Salary Range</label>
      <input type="text" name="salary_range" id="salary_range" value="<?= htmlspecialchars($job['salary_range'] ?? '') ?>" required>
    </div>

    <div class="job-form-group">
      <label for="per">Per</label>
      <select name="per" id="per" required>
        <option value="">Select...</option>
        <?php foreach (['hour', 'day', 'month'] as $option): ?>
          <option value="<?= $option ?>" <?= ($job['per'] ?? '') == $option ? 'selected' : '' ?>><?= ucfirst($option) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="job-form-group">
      <label for="address">Address</label>
      <input type="text" name="address" id="address" value="<?= htmlspecialchars($job['address'] ?? '') ?>">
    </div>

    <div class="job-form-group">
      <label for="tags">Tags (JSON array)</label>
      <textarea name="tags" id="tags"><?= htmlspecialchars($job['tags'] ?? '') ?></textarea>
    </div>

    <div class="job-form-group">
      <label for="short_description">Short Description</label>
      <textarea name="short_description" id="short_description"><?= htmlspecialchars($job['short_description'] ?? '') ?></textarea>
    </div>

    <div class="job-form-group">
      <label for="key_responsibilities">Key Responsibilities</label>
      <textarea name="key_responsibilities" id="key_responsibilities"><?= htmlspecialchars($job['key_responsibilities'] ?? '') ?></textarea>
    </div>

    <div class="job-form-group">
      <label for="report_to">Report To</label>
      <input type="text" name="report_to" id="report_to" value="<?= htmlspecialchars($job['report_to'] ?? '') ?>">
    </div>

    <div class="job-form-group">
      <label>Available Position</label>
      <input type="number" name="available_position" value="<?= htmlspecialchars($job['available_position'] ?? 0) ?>">
    </div>

    <div class="job-form-group">
      <label>Total</label>
      <input type="number" name="total" value="<?= htmlspecialchars($job['total'] ?? 0) ?>">
    </div>

    <div class="job-form-group">
      <label for="type">Type</label>
      <select name="type" id="type">
        <?php foreach (['Remote', 'OnSite'] as $type): ?>
          <option value="<?= $type ?>" <?= ($job['type'] ?? '') == $type ? 'selected' : '' ?>><?= $type ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="job-form-group">
      <label for="experience">Experience</label>
      <select name="experience" id="experience">
        <?php foreach (['Senior', 'Middle', 'Junior'] as $level): ?>
          <option value="<?= $level ?>" <?= ($job['experience'] ?? '') == $level ? 'selected' : '' ?>><?= $level ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="job-form-group">
      <label for="essential">Essential (JSON array)</label>
      <textarea name="essential" id="essential"><?= htmlspecialchars($job['essential'] ?? '') ?></textarea>
    </div>

    <div class="job-form-group">
      <label for="preferable">Preferable (JSON array)</label>
      <textarea name="preferable" id="preferable"><?= htmlspecialchars($job['preferable'] ?? '') ?></textarea>
    </div>

    <div class="job-form-group">
      <label for="logo_image">Logo Image URL</label>
      <input type="text" name="logo_image" id="logo_image" value="<?= htmlspecialchars($job['logo_image'] ?? '') ?>">
    </div>

    <div class="job-form-group">
      <label for="working_schedule">Working Schedule</label>
      <select name="working_schedule" id="working_schedule">
        <?php foreach (['Full time', 'Part time', 'Internship', 'Project work', 'Volunteering'] as $schedule): ?>
          <option value="<?= $schedule ?>" <?= ($job['working_schedule'] ?? '') == $schedule ? 'selected' : '' ?>><?= $schedule ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="job-form-group">
      <label for="employment_types">Employment Types (JSON array)</label>
      <textarea name="employment_types" id="employment_types"><?= htmlspecialchars($job['employment_types'] ?? '') ?></textarea>
    </div>

    <div class="job-form-actions">
      <button type="submit" class="btn-submit"><?= $isEdit ? 'Update Job' : 'Create Job' ?></button>
      <button type="reset" class="btn-reset">Reset</button>
    </div>
  </form>
</div>

</body>
</html>
