<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>LuckyJob - Jobs</title>
  <link rel="stylesheet" href="./styles/style.css" />
</head>

<body>

  <!-- HEADER & NAV -->
  <?php include 'header.php';?>
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

      <article>
        <div class="job-title">
          <h2 id="job-name">Frontend Developer</h2>
          <div class="short-description">
            <p id="work-type">Remote</p>
            <p id="experience">Expert</p>
          </div>
        </div>
        <div class="job-description-content">
          <div class="job-left-content">
            <div class="description">
              <h3>Short Description:</h3>
              <p>
                Responsible for creating engaging,
                user-friendly web interfaces and ensuring cross-browser compatibility.
              </p>
            </div>

            <div class="responsibilities">
              <h3>Key Responsibilities:</h3>
              <ul>
                <li>Implement new frontend features and functionality</li>
                <li>Optimize code for maximum performance</li>
                <li>Collaborate with UX designers and backend developers</li>
              </ul>
            </div>

            <div class="requirement">
              <h3>Requirements:</h3>
              <ol>
                <li>Essential:
                  <ul>
                    <li id="essential">Proficient in HTML5, CSS3, JS (2+ years)</li>
                    <li id="essential">Experience with React or Vue</li>
                  </ul>
                </li>
                <li>Preferable:
                  <ul>
                    <li id="essential">Familiarity with Docker and CI/CD</li>
                    <li id="essential">Good communication in English</li>
                  </ul>
                </li>
              </ol>
            </div>


          </div>
          <div class="job-right-content">
            <div class="info">
              <h3>Infomation:</h3>
              <p></p><strong>Reference No.:</strong> FE123</p>
              <p><strong>Title:</strong> Frontend Developer</p>
              <p><strong>Salary Range:</strong> $1200 - $2000 per week</p>
              <p><strong>Reports to:</strong> Head of Engineering</p>
            </div>
            <div class="other-info">
              <h3>Other Information:</h3>
              <p><strong>20+</strong> hiring people, <strong>5</strong> is active</p>
            </div>
            <a href="apply.html"> <button>Apply</button> </a>
          </div>
        </div>
      </article>
      <!---->

      <article>
        <div class="job-title">
          <h2 id="job-name">UI/UX Designer</h2>
          <div class="short-description">
            <p id="work-type">On-site</p>
            <p id="experience">Intern</p>
          </div>
        </div>
        <div class="job-description-content">
          <div class="job-left-content">
            <div class="description">
              <h3>Short Description:</h3>
              <p>
                Plan and create visually appealing,
                user-centered interfaces for both web and mobile platforms.
              </p>
            </div>

            <div class="responsibilities">
              <h3>Key Responsibilities:</h3>
              <ul>
                <li>Develop wireframes and prototypes.</li>
                <li>Design UI based on core UX principles.</li>
                <li>Conduct user research and A/B testing.</li>
              </ul>
            </div>

            <div class="requirement">
              <h3>Requirements:</h3>
              <ol>
                <li>Essential:
                  <ul>
                    <li id="essential">Figma or Sketch proficiency</li>
                    <li id="essential">Solid grasp of UX best practices</li>
                  </ul>
                </li>
                <li>Preferable:
                  <ul>
                    <li id="essential">Illustration skills</li>
                    <li id="essential">Familiar with Agile/Scrum</li>
                  </ul>
                </li>
              </ol>
            </div>


          </div>
          <div class="job-right-content">
            <div class="info">
              <h3>Infomation:</h3>
              <p></p><strong>Reference No.:</strong> UX789</p>
              <p><strong>Title:</strong> UI/UX Designer</p>
              <p><strong>Salary Range:</strong> $100 - $800 per week</p>
              <p><strong>Reports to:</strong> Product Manager</p>
            </div>
            <div class="other-info">
              <h3>Other Information:</h3>
              <p><strong>30+</strong> hiring people, <strong>1</strong> is active</p>
            </div>
            <a href="apply.html"> <button>Apply</button> </a>

          </div>
        </div>
      </article>
    </section>
  </div>
  <?php include 'footer.php';?>
</body>

</html>
