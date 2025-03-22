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
  <?php include 'header.php';?>
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
            <img src="./styles/images/logo_minh.avif" alt="Our team photo" style="max-width: 200px; border: 1px solid #7a7979;" />
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
              <dl class="member-list" >
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

    <div id="member_details_container">
    <div class="info_member">
      <div class="info_member_picture">
        <img class="member-photo" src="./styles/images/anhtuan.jpg" alt="member 1">
      </div>
      <div class="info_member_desc">
        <ul class="desc_details">
          <li>&#128075; <span>Name:</span> Anh Tuan Le </li>
          <li>&#127881; <span>Age:</span> 18 + 10 </li>
          <li>&#128188; <span>Work exlierience:</span> +5 year of experience in App Development and Web Development</li>
          <li>&#128187; <span>Key skills: </span> Java, Vuejs, Swift, PostgresSQL </li>
          <li>&#x1F60D; <span>Hobbies:</span> Pickeball </li>
          <li>&#127969; <span>About my Hometown:</span> HN</li>
        </ul>
        <a href="105313596@student.swin.edu.au" class="contact-btn">Contact Me</a>
      </div>
    </div>


    <div class="info_member">
      <div class="info_member_picture">
        <img src="./styles/images/Trung.png" alt="" style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">
      </div>
      <div class="info_member_desc">
        <ul class="desc_details">
          <li>&#128075; Name: Nguyen Quoc Trung</li>
          <li>&#127881; Age: 18 </li>
          <li>&#128188; Work exlierience: Certificate in Mindx Web-Advanced Course</li>
          <li>&#128187; Key skills: Ruby, HTML, CSS </li>
          <li>&#x1F60D; Hobbies: Sleep</li>
          <li>&#127969; About my Hometown: HN</li>
        </ul>
        <a href="105313596@student.swin.edu.au" class="contact-btn">Contact Me</a>
      </div>
    </div>


    <div class="info_member">
      <div class="info_member_picture">
        <img src="./styles/images/dminh.jpg" alt="" style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">
      </div>
      <div class="info_member_desc">
        <ul class="desc_details">
          <li>&#128075; Name: Nguyen Duc Minh</li>
          <li>&#127881; Age: 19</li>
          <li>&#128188; Work exlierience: 0 years of experience and I have just been learning to code for 3 months.</li>
          <li>&#128187; Key skills: HTML and CSS</li>
          <li>&#x1F60D; Hobbies: Playing sports</li>
          <li>&#127969; About my Hometown: HN</li>
        </ul>
        <a href="105313596@student.swin.edu.au" class="contact-btn">Contact Me</a>
      </div>
    </div>


    <div class="info_member">
      <div class="info_member_picture">
        <img src="./styles/images/haininh.jpg" alt="" style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">
      </div>
      <div class="info_member_desc">
        <ul class="desc_details">
          <li>&#128075; Name: Nguyen Van Hai Ninh</li>
          <li>&#127881; Age: 18</li>
          <li>&#128188; Work exlierience: +17 years of experience in bumming around.</li>
          <li>&#128187; Key skills: Making band-aid fixes.</li>
          <li>&#x1F60D; Hobbies: Playing video games.</li>
          <li>&#127969; About my Hometown: Hai Duong</li>
        </ul>
        <a href="105545056@student.swin.edu.au" class="contact-btn">Contact Me</a>
      </div>
    </div>
  </div>



    <!-- Timetable -->
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
          <tr>
            <td>10/2/2025</td>
            <td>8:00 - 11:00</td>
            <td>Summarize the assignment requirements and grading criteria</td>
            <td class="table-status-success">&#10004;</td>
          </tr>
          <tr>
            <td>15/2/2025</td>
            <td>13:00 - 16:00</td>
            <td>Assign tasks and finalize code submission approach</td>
            <td class="table-status-success">&#10004;</td>
          </tr>
          <tr>
            <td>16/2/2025</td>
            <td>9:00 - 12:00</td>
            <td>Work on individually assigned tasks</td>
            <td class="table-status-success">&#10004;</td>
          </tr>
          <tr>
            <td>17/2/2025</td>
            <td>9:00 - 12:00</td>
            <td>Meeting</td>
            <td class="table-status-fail">&#10008;</td>
          </tr>
          <tr>
            <td>18/02/2025</td>
            <td>13:00 - 17:00</td>
            <td>Team meeting to solve technical issues while coding</td>
            <td class="table-status-success">&#10004;</td>
          </tr>
          <tr>
            <td>20/02/2025</td>
            <td>19:00 - 23:00</td>
            <td>Resolve Responsive design problems</td>
            <td class="table-status-success">&#10004;</td>
          </tr>
          <tr>
            <td>22/02/2025</td>
            <td>23:00 - 00:00</td>
            <td>Final check before submission</td>
            <td class="table-status-success">&#10004;</td>
          </tr>
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
