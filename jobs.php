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

      <!-- Working schedule -->
      <div class="filter-group">
        <h4>Working schedule</h4>
        <label>
          <input type="radio" name="working-schedule" /> Full time
        </label>
        <label>
          <input type="radio" name="working-schedule" /> Part time
        </label>
        <label>
          <input type="radio" name="working-schedule" /> Internship
        </label>
        <label>
          <input type="radio" name="working-schedule" /> Project work
        </label>
        <label>
          <input type="radio" name="working-schedule" /> Volunteering
        </label>
      </div>

      <!-- Employment type -->
      <div class="filter-group">
        <h4>Employment type</h4>
        <label>
          <input type="checkbox" /> Full day
        </label>
        <label>
          <input type="checkbox" /> Flexible schedule
        </label>
        <label>
          <input type="checkbox" /> Shift work
        </label>
        <label>
          <input type="checkbox" /> Distant work
        </label>
        <label>
          <input type="checkbox" /> Shift method
        </label>
      </div>
    </aside>

    <!-- JOB DESCRIPTIONS -->
    <section class="content-job-area">
      <div class="filter-container">
        <div class="searching-bar">
          <input type="text" id="searching-space" placeholder="Search here...">
          <button type="submit" class="enter-searching-btn">Enter</button>
        </div>
        <div class="filter-bar">
          <select name="position">
            <option>Designer</option>
            <option>Developer</option>
            <option>Product Manager</option>
          </select>

          <select name="location">
            <option>Work Location</option>
            <option>Remote</option>
            <option>On-site</option>
          </select>

          <select name="experience">
            <option>Experience</option>
            <option>Junior</option>
            <option>Middle</option>
            <option>Senior</option>
          </select>

          <select name="perMonth">
            <option>Per month</option>
            <option>Per hour</option>
            <option>Per day</option>
          </select>

          <div class="salary-range">
            <label for="salaryRange">Salary range</label>
            <input type="range" id="salaryRange" min="1200" max="20000" value="5000" />
          </div>
        </div>
      </div>
      <h1>Current Openings</h1>

      <?php
      require_once './db/settings.php'; // Import kết nối database

      $conn = new mysqli($host, $user, $pwd, $sql_db);
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Lấy danh sách công việc từ database
      $sql = "SELECT * FROM jobs"; // Giả sử bảng lưu job là `jobs`
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
                  <p><strong>Reports to:</strong> <?php echo htmlspecialchars($row['report_to']); ?></p>
                </div>
                <div class="other-info">
                  <h3>Other Information:</h3>
                  <p><strong><?php echo htmlspecialchars($row['total']); ?>+</strong> hiring people, <strong><?php echo htmlspecialchars($row['available_position']); ?></strong> is active</p>
                </div>
                <a href="apply.html"> <button>Apply</button> </a>
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