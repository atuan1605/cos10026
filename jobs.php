<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>LuckyJob - Jobs</title>
  <link rel="stylesheet" href="./styles/style.css" />
</head>

<body>

  <!-- HEADER & NAV -->
  <?php include 'header.php'; ?>
  <!-- MAIN CONTENT -->
  <div class="main-content">

    <!-- ASIDE with extra details -->
    <aside class="sidebar">
      <h3>Filters</h3>
      <form method="GET" action="">
        <!-- Working schedule -->
        <div class="filter-group">
          <h4>Working schedule</h4>
          <label><input type="radio" name="working_schedule" value="Full time"
              <?php if (isset($_GET['working_schedule']) && $_GET['working_schedule'] == "Full time") echo "checked"; ?>> Full time</label>
          <label><input type="radio" name="working_schedule" value="Part time"
              <?php if (isset($_GET['working_schedule']) && $_GET['working_schedule'] == "Part time") echo "checked"; ?>> Part time</label>
          <label><input type="radio" name="working_schedule" value="Internship"
              <?php if (isset($_GET['working_schedule']) && $_GET['working_schedule'] == "Internship") echo "checked"; ?>> Internship</label>
          <label><input type="radio" name="working_schedule" value="Project work"
              <?php if (isset($_GET['working_schedule']) && $_GET['working_schedule'] == "Project work") echo "checked"; ?>> Project work</label>
          <label><input type="radio" name="working_schedule" value="Volunteering"
              <?php if (isset($_GET['working_schedule']) && $_GET['working_schedule'] == "Volunteering") echo "checked"; ?>> Volunteering</label>
        </div>

        <!-- Employment type -->
        <div class="filter-group">
          <h4>Employment type</h4>
          <label><input type="checkbox" name="employment_type[]" value="Full day"
              <?php if (!empty($_GET['employment_type']) && in_array("Full day", $_GET['employment_type'])) echo "checked"; ?>> Full day</label>
          <label><input type="checkbox" name="employment_type[]" value="Flexible schedule"
              <?php if (!empty($_GET['employment_type']) && in_array("Flexible schedule", $_GET['employment_type'])) echo "checked"; ?>> Flexible schedule</label>
          <label><input type="checkbox" name="employment_type[]" value="Shift work"
              <?php if (!empty($_GET['employment_type']) && in_array("Shift work", $_GET['employment_type'])) echo "checked"; ?>> Shift work</label>
          <label><input type="checkbox" name="employment_type[]" value="Distant work"
              <?php if (!empty($_GET['employment_type']) && in_array("Distant work", $_GET['employment_type'])) echo "checked"; ?>> Distant work</label>
          <label><input type="checkbox" name="employment_type[]" value="Shift method"
              <?php if (!empty($_GET['employment_type']) && in_array("Shift method", $_GET['employment_type'])) echo "checked"; ?>> Shift method</label>
        </div>
    </aside>
    <!-- JOB DESCRIPTIONS -->
    <section class="content-job-area">
      <h1>Current Openings</h1>
      <?php
      require_once './db/settings.php'; // Import database connection settings

      $conn = new mysqli($host, $user, $pwd, $sql_db);
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Base SQL Query
      $sql = "SELECT * FROM jobs WHERE 1";

      // Handle Working Schedule (Radio Button)
      if (!empty($_GET['working_schedule'])) {
        $working_schedule = $conn->real_escape_string($_GET['working_schedule']);
        $sql .= " AND working_schedule = '$working_schedule'";
      }

      // Corrected Employment Type filter
      if (!empty($_GET['employment_type'])) {
        $employment_types = array_map([$conn, 'real_escape_string'], $_GET['employment_type']);
        $sql .= " AND (" . implode(" OR ", array_map(fn($type) => "employment_types LIKE '%$type%'", $employment_types)) . ")";
      }

      // Xử lý tìm kiếm theo từ khóa
      if (!empty($_GET['title'])) {
        $title = $conn->real_escape_string(trim($_GET['title'])) . "%";
        $sql .= " AND (title LIKE '$title')";
      }

      // Lọc theo vị trí công việc
      if (!empty($_GET['position'])) {
        $position = $conn->real_escape_string($_GET['position']);
        $sql .= " AND position = '$position'";
      }

      // Lọc theo địa điểm làm việc
      if (!empty($_GET['type'])) {
        $type = $conn->real_escape_string($_GET['type']);
        $sql .= " AND type = '$type'";
      }

      // Lọc theo kinh nghiệm
      if (!empty($_GET['experience'])) {
        $experience = $conn->real_escape_string($_GET['experience']);
        $sql .= " AND experience = '$experience'";
      }

      // Lọc theo hình thức trả lương
      if (!empty($_GET['per'])) {
        $per = $conn->real_escape_string($_GET['per']);
        $sql .= " AND per = '$per'";
      }

      // Execute Filtered Query
      $result = $conn->query($sql);

      // Fix: Remove duplicate MySQL connection
      $search = isset($_POST['search']) ? trim($_POST['search']) : '';

      if (!empty($search)) {
        // Convert search term to lowercase and sanitize input
        $search = strtolower(trim($search));
        $search = $conn->real_escape_string($search);

        // Ensure that the search only matches the start of job titles
        $sql = "SELECT * FROM jobs WHERE job_title LIKE '$search%' ORDER BY job_title ASC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<p>" . htmlspecialchars($row['job_title']) . "</p>";
          }
        } else {
      ?>
          echo '<div class="no-results">
            <p>No results found</p>
          </div>';
      <?php
        }
      }
      $conn->close();
      ?>

      <!-- JOB DESCRIPTIONS -->
      <section class="content-job-area">
        <form method="GET" action="">
          <div class="filter-container">
            <div class="searching-bar">
              <input type="text" name="title" id="searching-space"
                placeholder="Search here..."
                value="<?php echo isset($_GET['title']) ? htmlspecialchars($_GET['title']) : ''; ?>">
              <button type="submit" class="enter-searching-btn">Search</button>
            </div>

            <div class="filter-bar">
              <select name="position">
                <option value="">Select Position</option>
                <option value="Designer" <?php if (isset($_GET['position']) && $_GET['position'] == 'Designer') echo 'selected'; ?>>Designer</option>
                <option value="Developer" <?php if (isset($_GET['position']) && $_GET['position'] == 'Developer') echo 'selected'; ?>>Developer</option>
                <option value="Product Manager" <?php if (isset($_GET['position']) && $_GET['position'] == 'Product Manager') echo 'selected'; ?>>Product Manager</option>
              </select>

              <select name="type">
                <option value="">Work Type</option>
                <option value="Remote" <?php if (isset($_GET['type']) && $_GET['type'] == 'Remote') echo 'selected'; ?>>Remote</option>
                <option value="OnSite" <?php if (isset($_GET['type']) && $_GET['type'] == 'OnSite') echo 'selected'; ?>>On-site</option>
              </select>

              <select name="experience">
                <option value="">Experience Level</option>
                <option value="Junior" <?php if (isset($_GET['experience']) && $_GET['experience'] == 'Junior') echo 'selected'; ?>>Junior</option>
                <option value="Middle" <?php if (isset($_GET['experience']) && $_GET['experience'] == 'Middle') echo 'selected'; ?>>Middle</option>
                <option value="Senior" <?php if (isset($_GET['experience']) && $_GET['experience'] == 'Senior') echo 'selected'; ?>>Senior</option>
              </select>

              <select name="per">
                <option value="">Salary Basis</option>
                <option value="month" <?php if (isset($_GET['per']) && $_GET['per'] == 'month') echo 'selected'; ?>>Per month</option>
                <option value="hour" <?php if (isset($_GET['per']) && $_GET['per'] == 'hour') echo 'selected'; ?>>Per hour</option>
                <option value="day" <?php if (isset($_GET['per']) && $_GET['per'] == 'day') echo 'selected'; ?>>Per day</option>
              </select>
            </div>
          </div>
        </form>
        <?php
        require_once './db/settings.php';
        $conn = new mysqli($host, $user, $pwd, $sql_db);
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
        ?>
            <article>
              <div class="job-title">
                <h2 id="job-name"><?php echo htmlspecialchars($row['title']); ?></h2>
                <div class="short-description">
                  <p id="work-type"><?php echo htmlspecialchars($row['type']); ?></p>
                  <p id="experience"><?php echo htmlspecialchars($row['experience']); ?></p>
                </div>
              </div>
              <div class="job-description-content">
                <div class="job-left-content">
                  <div class="description">
                    <h3>Short Description:</h3>
                    <p><?php echo htmlspecialchars($row['short_description']); ?></p>
                  </div>

                  <div class="responsibilities">
                    <h3>Key Responsibilities:</h3>
                    <ul>
                      <?php
                      $responsibilities = explode("\n", $row['key_responsibilities']);
                      foreach ($responsibilities as $task) {
                        echo "<li>" . htmlspecialchars(trim($task)) . "</li>";
                      }
                      ?>
                    </ul>
                  </div>
                  <div class="requirement">
                    <h3>Requirements:</h3>
                    <ol>
                      <li>Essential:
                        <ul>
                          <?php
                          $essentials = json_decode($row['essential'], true); // Decode JSON to array
                          if (is_array($essentials)) { // Ensure it's an array before looping
                            foreach ($essentials as $requirement) {
                              echo "<li>" . htmlspecialchars($requirement) . "</li>";
                            }
                          } else {
                            echo "<li>No essential requirements listed.</li>";
                          }
                          ?>
                        </ul>
                      </li>
                      <li>Preferable:
                        <ul>
                          <?php
                          $preferables = json_decode($row['preferable'], true); // Decode JSON to array
                          if (is_array($preferables)) {
                            foreach ($preferables as $preference) {
                              echo "<li>" . htmlspecialchars($preference) . "</li>";
                            }
                          } else {
                            echo "<li>No preferable requirements listed.</li>";
                          }
                          ?>
                        </ul>

                      <li>Employment Type:
                        <ul>
                          <?php
                          $employment_types = json_decode($row['employment_types'], true); // Decode JSON to array
                          if (is_array($employment_types)) {
                            foreach ($employment_types as $employment_types) {
                              echo "<li>" . htmlspecialchars($employment_types) . "</li>";
                            }
                          } else {
                            echo "<li>No employment types requirements listed.</li>";
                          }
                          ?>
                        </ul>
                      </li>

                    </ol>
                  </div>
                </div>
                <div class="job-right-content">
                  <div class="info">
                    <h3>Information:</h3>
                    <p><strong>Reference No.:</strong> <?php echo htmlspecialchars($row['job_reference_number']); ?></p>
                    <p><strong>Title:</strong> <?php echo htmlspecialchars($row['title']); ?></p>
                    <p><strong>Salary Range:</strong> $<?php echo htmlspecialchars($row['salary_range']); ?> per <?php echo htmlspecialchars($row['per']); ?></p>
                    <p><strong>Schedule:</strong> <?php echo htmlspecialchars($row['working_schedule']); ?></p>
                    <p><strong>Reports to:</strong> <?php echo htmlspecialchars($row['report_to']); ?></p>
                  </div>
                  <div class="other-info">
                    <h3>Other Information:</h3>
                    <p><strong><?php echo htmlspecialchars($row['total']); ?>+</strong> hiring people, <strong><?php echo htmlspecialchars($row['available_position']); ?></strong> is active</p>
                  </div>
                  <a href="apply.php?job_reference_number=<?php echo urlencode($row['job_reference_number']); ?>">
                    <button type="button">Apply</button>
                  </a>
                </div>
              </div>
            </article>
        <?php
          }
        } else {
          echo "<p>No jobs found.</p>";
        }
        $conn->close();
        ?>
      </section>
  </div>
  <?php include 'footer.php'; ?>


</body>

</html>
