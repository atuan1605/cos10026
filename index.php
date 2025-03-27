<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>LuckyJob - Home</title>
  <link rel="stylesheet" href="./styles/style.css" />
</head>

<body class="homepage">

  <!-- HEADER & NAV -->
  <?php include 'header.php'; ?>
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
  include 'companyTitleInfo.php';
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
  include '../cos10026/db/create_jobs_table.php';;
  ?>

<div class="main-content">
  <section class="content-area">
    <h2>Recommended jobs</h2>
    <div class="job-cards">
      <?php
      $i = 0;
      while ($i < count($jobs)):
        $job = $jobs[$i];
      ?>
        <div class="job-card">
          <div id="<?= $job['jobNumber'] ?>-job-card">
            <div class="job-card-header">
              <span class="job-card-date"> <?= $job['date'] ?> </span>
            </div>
            <p class="company-name"> <?= $job['company_name'] ?> </p>
            <div class="job-card-title">
              <h3> <?= $job['title'] ?> </h3>
              <img class="figma-image" src="<?= $job['logo_image'] ?>" alt="imgs">
            </div>
            <div class="job-card-tags">
              <?php
              $j = 0;
              while ($j < count($job['tags'])):
              ?>
                <section><?= $job['tags'][$j] ?></section>
              <?php
                $j++;
              endwhile;
              ?>
            </div>
          </div>
          <div class="job-card-footer">
            <div>
              <div class="job-salary"> $<?= $job['salary_range'] ?>/<?= $job['per'] ?> </div>
              <div class="job-location"> <?= $job['address'] ?> </div>
            </div>
            <a href="/jobs.html" class="job-detail-button">Details</a>
          </div>
        </div>
      <?php
        $i++;
      endwhile;
      ?>
    </div>
  </section>
</div>
  <!--Section 4: scrolling-->
  <a href="#" class="scroll-to-top">↑</a>
  <?php include 'footer.php';?>
</body>

</html>