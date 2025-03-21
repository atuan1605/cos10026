<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>LuckyJob - Home</title>
  <link rel="stylesheet" href="./styles/style.css" />
</head>

<body class="homepage">

  <!-- HEADER & NAV -->
  <header>
    <div class="navbar">
      <div class="navbar-left">
        <div class="logo">LuckyJob</div>
        <input type="checkbox" id="menu-toggle" />
        <nav class="navbar-menu">
          <ul>
            <li><a href="index.html" class="active">Home</a></li>
            <li><a href="jobs.html">Jobs</a></li>
            <li><a href="apply.html">Apply</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="enhancements.html">Enhancements</a></li>
            <!-- An email link as required -->
            <li><a href="105313596@student.swin.edu.au">Email</a></li>
          </ul>
        </nav>
      </div>
      <div class="navbar-right">
        <div class="location">Hanoi, VN</div>
        <img src="./styles/images/avatar.png" class="user-avatar" alt="avatar">
        <label for="menu-toggle" class="menu-btn">&#9776; Menu</label>
      </div>
    </div>
  </header>

  <!-- MAIN CONTENT -->
  <div class="main-intro" style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.658), rgba(0, 0, 0, 0.658)), url('./styles/images/indexmeeting.jpg'); background-repeat: no-repeat; background-size: cover;">

    <!-- Section 1: Company intro -->
    <section id="index-welcome">
      <img src="./styles/images/company_logo.png" alt="indexlogo" id="intro-logo"></img>
      <h1 class="narow-head">Welcome to LuckyJob</h1>
      <p>
        LuckyJob is a leading tech recruitment agency that connects top talent
        with the world's best technology companies. Our headquarters are located
        in San Francisco, and we have global offices to serve both employers and applicants.
      </p>
      <br>
      <p>
        We specialize in matching qualified IT professionals—developers, UI/UX, data scientists,
        and more—to organizations worldwide. We provide professional consulting services to ensure
        you find the best career opportunities available.
      </p>
      <a id="show-product" href="https://youtu.be/TzUoAPeOZQs" target="_blank">Watch our product</a>
    </section>

  </div>
  <!-- Section 2: Key features -->
  <?php
  $reasons = [
    [
      'image' => './styles/images/shakehand.jpg',
      'title' => 'Extensive network',
      'pictureName' => 'partnered',
      'description' => 'Partnered with over 2000 tech companies worldwide'
    ],
    [
      'image' => './styles/images/specialized.jpg',
      'title' => 'Professional Team',
      'pictureName' => 'specialized',
      'description' => 'Specialized in IT recruitment (Frontend, Backend, UI/UX, QA, etc.)'
    ],
    [
      'image' => './styles/images/support.jpg',
      'title' => 'Conscientious',
      'pictureName' => 'support',
      'description' => 'Supports on-site, remote, or hybrid work'
    ],
    [
      'image' => './styles/images/coaching.jpg',
      'title' => 'Methodical Training',
      'pictureName' => 'coaching',
      'description' => 'Free career coaching and skill development services'
    ]
  ];
  $reasonCount = count($reasons);
  $i = 0;
  ?>

  <div class="lower-content">
    <section id="index-reason">
      <h2 class="narow-head">Why Choose LuckyJob?</h2>
      <div id="reason-box">
        <?php while ($i < $reasonCount) : ?>
          <?php
          $image = $reasons[$i]['image'];
          ?>
          <div class="Img-cover">
            <section id="<?= $reasons[$i]['pictureName'] ?>-picture" style="background-image: url('<?= $image ?>');">
              <section class="index-Img"></section>
            </section>
            <section class="under-title">
              <p><?= $reasons[$i]['title'] ?></p>
            </section>
            <section class="reason-hr">
              <hr>
            </section>
            <p><?= $reasons[$i]['description'] ?></p>
          </div>
          <?php $i++; ?>
        <?php endwhile; ?>
      </div>
    </section>
  </div>

  <!--Section 3-->

  <?php
  $jobs = [
    [
      'jobNumber' => 'fourth',
      'date' => '20 May, 2023',
      'company' => 'Amazon',
      'title' => 'Senior UI/UX Designer',
      'tags' => ['Part time', 'Senior level', 'Distant', 'Project work'],
      'salary' => '$250/hr',
      'location' => 'San Francisco, CA'
    ],
    [
      'jobNumber' => 'second',
      'date' => '4 Feb, 2023',
      'company' => 'Google',
      'title' => 'Junior UI/UX Designer',
      'images' => './styles/images/figma.png',
      'tags' => ['Full time', 'Junior level', 'Distant', 'Project work', 'Flexible Schedule'],
      'salary' => '$150/hr',
      'location' => 'California, CA'
    ],
    [
      'jobNumber' => 'first',
      'date' => '29 Jan, 2023',
      'company' => 'Dribbble',
      'title' => 'Senior Motion Designer',
      'images' => './styles/images/dribble.png',
      'tags' => ['Part time', 'Senior level', 'Full Day', 'Shift work'],
      'salary' => '$260/hr',
      'location' => 'New York, NY'
    ],
    [
      'jobNumber' => 'third',
      'date' => '11 Apr, 2023',
      'company' => 'Twitter',
      'title' => 'UX Designer',
      'tags' => ['Full time', 'Middle level', 'Distant', 'Project work'],
      'salary' => '$120/hr',
      'location' => 'California, CA'
    ],
    [
      'jobNumber' => 'last',
      'date' => '2 Apr, 2023',
      'company' => 'Airbnb',
      'title' => 'Graphic Designer',
      'tags' => ['Part time', 'Senior level'],
      'salary' => '$300/hr',
      'location' => 'New York, NY'
    ],
    [
      'jobNumber' => 'fifth',
      'date' => '18 Jan, 2023',
      'company' => 'Apple',
      'title' => 'Graphic Designer',
      'tags' => ['Part time', 'Distant'],
      'salary' => '$140/hr',
      'location' => 'San Francisco, CA'
    ]
  ];
  ?>

  <div class="main-content">
    <section class="content-area">
      <h2>Recommended jobs</h2>
      <div class="job-cards">
        <?php
        $i = 0;
        while ($i < count($jobs)) : ?>
          <div class="job-card">
            <div id="<?= $jobs[$i]['jobNumber'] ?>-job-card">
              <div class="job-card-header">
                <span class="job-card-date"> <?= $jobs[$i]['date'] ?> </span>
              </div>
              <p class="company-name"> <?= $jobs[$i]['company'] ?> </p>
              <h3 class="job-card-title"> <?= $jobs[$i]['title'] ?> </h3>
              <div class="job-card-tags">
                <?php
                $j = 0;
                while ($j < count($jobs[$i]['tags'])) : ?>
                  <section><?= $jobs[$i]['tags'][$j] ?></section> 
                <?php
                  $j++;
                endwhile; ?>
              </div>
            </div>
            <div class="job-card-footer">
              <div>
                <div class="job-salary"> <?= $jobs[$i]['salary'] ?> </div>
                <div class="job-location"> <?= $jobs[$i]['location'] ?> </div>
              </div>
              <a href="/jobs.html" class="job-detail-button">Details</a>
            </div>
          </div>
        <?php
          $i++;
        endwhile; ?>
      </div>
    </section>
  </div>
  <!--Section 4: scrolling-->
  <a href="#" class="scroll-to-top">↑</a>

  <footer>
    <div class="footer-container">
      <!-- Cột 1: Navigation/Links -->
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

      <!-- Cột 2: Contact Info -->
      <div class="footer-contact">
        <h3>Contact</h3>
        <p>Phone: 0962863399</p>
        <p>Email: 105313596@student.swin.edu.au</p>
        <p>Add: 221 Burwood Highway Burwood Victoria 3125 Australia</p>
      </div>

      <!-- Cột 3: Opening Hours -->
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