<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>LuckyJob - About</title>
  <link rel="stylesheet" href="./styles/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Dosis:wght@200..800&family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Fondamento:ital@0;1&family=Satisfy&display=swap" rel="stylesheet">
</head>

<body>

  <!-- HEADER & NAV -->
  <header>
    <div class="navbar">
      <div class="navbar-left">
        <div class="logo">LuckyJob</div>
        <input type="checkbox" id="menu-toggle" />
        <nav class="navbar-menu">
          <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="jobs.html">Jobs</a></li>
            <li><a href="apply.html">Apply</a></li>
            <li><a href="about.html" class="active">About</a></li>
            <li><a href="enhancements.html">Enhancements</a></li>
            <li><a href="mailto:yourID@swin.edu.au">Email</a></li>
          </ul>
        </nav>
      </div>
      <div class="navbar-right">
        <div class="location">Hanoi, VN</div>
        <img src="/styles/images/avatar.png" class="user-avatar" alt="avatar">
        <label for="menu-toggle" class="menu-btn">&#9776; Menu</label>
      </div>
    </div>
  </header>

  <!-- MAIN CONTENT -->
  <div class="main-content" style="flex-direction: column;">

    <section id="section_head" style="border-radius: 8px; padding: 1rem; min-height: 240px;">
      <div class="section_left">
        <div id="section_left_title">
          <h1 id="our_group">Our Group</h1>
          <h2 id="group_name">LuckyJob Warriors</h2>
        </div>
        <div id="small_des">
          <p>Tutor: Mr.Binh </p>
          <p>Group ID: 06</p>
        </div>
      </div>

      <div class="section_group_picture" style="min-width: 300px;">
        <figure style="float: right; text-align: center;">
          <img src="/styles/images/logo_minh.avif" alt="Our team photo" style="max-width: 200px; border: 1px solid #7a7979;" />
          <figcaption style="font-weight: 500; font-family: Fondamento, serif; font-size: 19px;">LuckyJob Warriors Team</figcaption>
        </figure>
      </div>
      </dl>
    </section>


    <!-- Genneral Introduction -->
    <section class="background-section" style="border-radius: 8px; padding: 1rem; margin-top: 1rem;">
      <div class="card" style="color: #7a7979;">
        <dl class="group-info">
          <dt>Group Name:</dt>
          <dd>LuckyJob Warriors</dd>

          <dt>Group ID:</dt>
          <dd>06</dd>

          <dt>Tutor's Name:</dt>
          <dd>Mr.Binh</dd>
        </dl>
        <dl class="members">
          <dt>Members Contribution:</dt>
          <dd>
            <dl class="member-list">
              <dt>Le Anh Tuan (ID: 02765)</dt>
              <dd>Nav bar, Footer, Fixing Errors</dd>

              <dt>Nguyen Duc Minh (ID: 02640)</dt>
              <dd>ABOUT Page</dd>

              <dt>Nguyen Quoc Trung (ID: 02774)</dt>
              <dd>HOME Page</dd>

              <dt>Nguyen Van Hai Ninh (ID: 102805)</dt>
              <dd>APPLY Page</dd>
            </dl>
          </dd>
        </dl>
      </div>
    </section>

    <!-- Member Detail -->
    <h2>MORE ABOUT US .....</h2>
    <?php
require_once "./db/settings.php"; // Kết nối database

$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Truy vấn lấy danh sách thành viên
$sql = "SELECT name, age, experience, skills, hobbies, hometown, image FROM users WHERE role = 'Member'";
$result = $conn->query($sql);

$members = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $members[] = $row;
    }
}
$conn->close();
?>

<div id="member_details_container">
    <?php if (!empty($members)): ?>
        <?php foreach ($members as $member): ?>
            <div class="info_member">
                <img class="member-photo" src="<?= htmlspecialchars($member["image"]) ?>" alt="<?= htmlspecialchars($member["name"]) ?>">
                <div class="info_member_desc">
                    <ul class="desc_details">
                        <li>
                            <h3>👋 Name: <?= htmlspecialchars($member["name"]) ?></h3>
                        </li>
                        <li>🎂 Age: <?= htmlspecialchars($member["age"]) ?></li>
                        <li>💼 Work experience: <?= htmlspecialchars($member["experience"]) ?></li>
                        <li>🛠️ Key skills: <?= htmlspecialchars($member["skills"]) ?></li>
                        <li>😍 Hobbies: <?= htmlspecialchars($member["hobbies"]) ?></li>
                        <li>🏡 About my Hometown: <?= htmlspecialchars($member["hometown"]) ?></li>
                    </ul>
                    <a href="mailto:105313596@student.swin.edu.au" class="contact-btn">Contact Me</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No members found.</p>
    <?php endif; ?>
</div>

    <!-- Timetable -->
    <?php include "about_setting.php" ?>
    <section style="background: #fff; border-radius: 8px; padding: 1rem; margin-top: 1rem;">
      <h2 id="timetable_title">Group Timetable (Assumed)</h2>
      <table id="timetable">
        <thead>
          <tr id="tr_head">
            <th>Date</th>
            <th>Time</th>
            <th>Tasks</th>
            <th class="table-status">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($timetable as $event): ?>
            <tr>
              <td><?= $event["date"] ?></td>
              <td><?= $event["time"] ?></td>
              <td><?= $event["task"] ?></td>
              <td class="<?= $event["status"] ? 'table-status-success' : 'table-status-fail' ?>">
                <?= $event["status"] ? "&#10004;" : "&#10008;" ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>
  </div>
  <footer>
    <div class="footer-container">
      <div class="footer-column">
        <ul>
          <li><a href="index.html" class="active">Home</a></li>
          <li><a href="jobs.html">Jobs</a></li>
          <li><a href="apply.html">Apply</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="enhancements.html">Enhancements</a></li>
          <!-- An email link as required -->
          <li><a href="105313596@student.swin.edu.au">Email</a></li>
        </ul>
      </div>
      <div class="footer-contact">
        <h3>Contact</h3>
        <p>Phone: 0962863399</p>
        <p>Email: 105313596@student.swin.edu.au</p>
        <p>Add: 221 Burwood Highway Burwood Victoria 3125 Australia</p>
      </div>
      <div class="footer-time">
        <h3>Opening</h3>
        <p>Mon - Friday: 9AM - 5PM</p>
        <p>Saturday: 9AM - 2PM</p>
        <p>Sunday: 9AM - 2PM</p>
      </div>
    </div>
  </footer>
</body>
</html>