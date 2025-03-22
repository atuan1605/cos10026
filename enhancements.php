<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enhancements - LuckyJob</title>
  <link rel="stylesheet" href="./styles/style.css">
</head>

<body  class="homepage">
  <!-- HEADER & NAV -->
  <?php include 'header.php';?>
  <!-- MAIN CONTENT -->
  <div class="main-content">
    <section class="enhancements">
      <h1>Website Enhancements</h1>
      <p>This page describes the advanced features added to enhance the usability, interactivity, and responsiveness of
        the LuckyJob website.</p>

      <!-- Enhancement 1 -->
      <div class="enhancement">
        <h2>1. Hover Effects with Animation</h2>
        <p>To improve user interaction, hover effects have been implemented using CSS transitions and animations. When
          hovering over buttons, the background color changes, and the button slightly enlarges.</p>
        <p><strong>Example:</strong> Buttons in the <a href="apply.html">Apply Page</a> change background color and
          scale up when hovered.</p>
        <pre><code>
button:hover {
  background-color: #0056b3;
  transform: scale(1.1);
  transition: all 0.3s ease-in-out;
}
        </code></pre>
      </div>

      <!-- Enhancement 2 -->
      <div class="enhancement">
        <h2>2. Keyframe Animations</h2>
        <p>Various sections of the website include animated elements using keyframes, such as smooth scrolling effects
          and floating animations.</p>
        <p><strong>Example:</strong> The company logo on the <a href="index.html">Homepage</a> floats up and down.</p>
        <pre><code>
@keyframes floatUpDown {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
}

#intro-logo {
  animation: floatUpDown 3s ease-in-out infinite;
}
        </code></pre>
      </div>

      <!-- Enhancement 3 -->
      <div class="enhancement">
        <h2>3. Active Navbar Indicator</h2>
        <p>The navigation bar dynamically highlights the active page to improve user experience.</p>
        <p><strong>Example:</strong> The currently active page link is highlighted.</p>
        <pre><code>
nav a.active {
  color: rgb(121, 248, 255);
  font-weight: bold;
  text-decoration: underline;
}
        </code></pre>
      </div>

      <!-- Enhancement 4 -->
      <div class="enhancement">
        <h2>4. Form Validation - Border Color Change</h2>
        <p>When users correctly enter values into input fields, the border changes color to provide visual feedback.</p>
        <p><strong>Example:</strong> In the <a href="apply.html">Apply Form</a>, correctly formatted input fields turn
          green.</p>
        <pre><code>
input:valid {
  border: 2px solid green;
}
        </code></pre>
      </div>

      <!-- Enhancement 5 -->
      <div class="enhancement">
        <h2>5. Full Responsive Design</h2>
        <p>All pages are optimized to be fully responsive and adapt to different screen sizes, ensuring a smooth
          experience on desktops, tablets, and mobile devices.</p>
        <p><strong>Example:</strong> The layout adjusts dynamically using media queries.</p>
        <pre><code>
@media (max-width: 768px) {
  .main-content {
    flex-direction: column;
  }

  .navbar-menu ul {
    flex-direction: column;
  }
}
        </code></pre>
      </div>

      <!-- Enhancement 6 -->
      <div class="enhancement">
        <h2>6. Image Scaling Prevention</h2>
        <p>To prevent images from breaking when resizing the screen, `object-fit` and `max-width` are used.</p>
        <p><strong>Example:</strong> Images on the <a href="about.html">About Page</a> scale properly without
          distortion.</p>
        <pre><code>
img {
  max-width: 100%;
  height: auto;
  object-fit: cover;
}
        </code></pre>
      </div>

      <!-- Enhancement 7 -->
      <div class="enhancement">
        <h2>7. Button Content Change on Hover</h2>
        <p>When users hover over a button, the text dynamically changes to indicate an action.</p>
        <p><strong>Example:</strong> On the <a href="jobs.html">Jobs Page</a>, the "Apply" button text changes on hover.
        </p>
        <pre><code>
button::after {
  content: "Apply";
}

button:hover::after {
  content: "Go to Apply form";
}
        </code></pre>
      </div>

      <div class="enhancement">
        <h2>8. Smooth Animated Dropdown Menu</h2>
        <p>When the screen is small, the navigation menu smoothly slides down when toggled, improving user experience.
        </p>
        <p><strong>Example:</strong> Click the **menu button** in the navigation bar.</p>
        <pre><code>
      #menu-toggle:checked ~ .navbar-menu ul {
        max-height: 300px;
        transition: max-height 0.5s ease-in-out;
      }

      .navbar-menu ul {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease-in-out;
      }
              </code></pre>
      </div>
    </section>
  </div>



  <footer>
    <div class="footer-container">
      <div class="footer-column">
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="jobs.html">Jobs</a></li>
          <li><a href="apply.html">Apply</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="enhancements.html" class="active">Enhancements</a></li>
        </ul>
      </div>

      <div class="footer-contact">
        <h3>Contact</h3>
        <p>Phone: 0962863399</p>
        <p>Email: 105313596@student.swin.edu.au</p>
        <p>Address: 221 Burwood Highway, Burwood, Victoria 3125, Australia</p>
      </div>

      <div class="footer-time">
        <h3>Opening Hours</h3>
        <p>Mon - Friday: 9AM - 5PM</p>
        <p>Saturday: 9AM - 2PM</p>
        <p>Sunday: 9AM - 2PM</p>
      </div>
    </div>
  </footer>
</body>

</html>
