<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>LuckyJob - About</title>
  <link rel="stylesheet" href="./styles/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Dosis:wght@200..800&family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <!-- HEADER & NAV -->
  <?php include 'header.php'; ?>
</head>

<body>
  <!-- MAIN CONTENT -->
  <div class="main-content" style="flex-direction: column;">
    <div class="test-about">
      <div class="animation01">
        <div class="rhombus_small">
          <div class="rhombus">
            <div class="border_box">
              <span class="line line01"></span>
              <span class="line line02"></span>
              <span class="line line03"></span>
              <span class="line line04"></span>
              <span class="circle circle01"></span>
              <span class="circle circle02"></span>
              <span class="circle circle03"></span>
              <span class="circle circle04"></span>
              <span class="animation_line animation_line01"></span>
              <span class="animation_line_wrapper animation_line02_wrapper"><span class="animation_line animation_line02"></span></span>
              <span class="animation_line animation_line03"></span>
              <span class="animation_line_wrapper animation_line04_wrapper"><span class="animation_line animation_line04"></span></span>
              <span class="animation_line animation_line05"></span>
              <span class="animation_line_wrapper animation_line06_wrapper"><span class="animation_line animation_line06"></span></span>
              <span class="animation_line animation_line07"></span>
              <span class="animation_line_wrapper animation_line08_wrapper"><span class="animation_line animation_line08"></span></span>
            </div>
            <div class="wave">
              <div class="wave_wrapper">
                <div class="wave_box"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="animation02">
        <div class="rhombus_box">
          <span class="rhombus_item_wrapper rhombus_item01_wrapper"><span class="rhombus_item"></span></span>
          <span class="rhombus_item_wrapper rhombus_item02_wrapper"><span class="rhombus_item"></span></span>
        </div>
        <div class="double_content">
          <div class="double_wrapper02 dotted02">
            <div class="dotted_hide">
              <div class="double_wrapper01 dotted01"><span class="dotted_right"></span></div>
            </div>
          </div>
          <div class="double_wrapper02 white02">
            <div class="double_wrapper01 white01"></div>
          </div>
          <div class="double_wrapper02 gray02">
            <div class="double_wrapper01 gray01"></div>
          </div>
          <div class="double_wrapper02 orange02">
            <div class="double_wrapper01 orange01"></div>
          </div>
        </div>
        <div class="name">
          <p>Group 6</p>
          <span class="name_circle01"></span>
          <span class="name_circle02"></span>
        </div>
      </div>
    </div>

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
    require_once "./db/settings.php";

    $conn = new mysqli($host, $user, $pwd, $sql_db);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

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
            <div id="container-member-photo">
            <?php
            $imageSrc = !empty($member["image"]) ? $member["image"] : 'styles/images/default.png';
            ?>
            <img class="member-photo" src="<?= htmlspecialchars($imageSrc) ?>" alt="<?= htmlspecialchars($member["name"]) ?>">
            </div>
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
    <?php
    require_once "./db/settings.php";

    $conn = new mysqli($host, $user, $pwd, $sql_db);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT date, time, task, status FROM timetables ORDER BY date ASC";
    $result = $conn->query($sql);

    $timetable = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $timetable[] = $row;
      }
    }
    $conn->close();
    ?>

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
          <?php if (!empty($timetable)): ?>
            <?php foreach ($timetable as $event): ?>
              <tr>
                <td><?= htmlspecialchars($event["date"]) ?></td>
                <td><?= htmlspecialchars($event["time"]) ?></td>
                <td><?= htmlspecialchars($event["task"]) ?></td>
                <td class="<?= $event["status"] ? 'table-status-success' : 'table-status-fail' ?>">
                  <?= $event["status"] ? "&#10004;" : "&#10008;" ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" style="text-align: center;">No timetable events found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </section>
  </div>
  <?php include 'footer.php'; ?>
</body>

</html>