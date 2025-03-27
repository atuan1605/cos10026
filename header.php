<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
 
<header>
  <div class="navbar">
    <div class="navbar-left">
      <div class="logo">LuckyJob</div>
      <input type="checkbox" id="menu-toggle" />
      <nav class="navbar-menu">
        <ul>
          <li><a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">Home</a></li>
          <li><a href="jobs.php" class="<?= basename($_SERVER['PHP_SELF']) == 'jobs.php' ? 'active' : '' ?>">Jobs</a></li>
          <li><a href="apply.php" class="<?= basename($_SERVER['PHP_SELF']) == 'apply.php' ? 'active' : '' ?>">Apply</a></li>
          <li><a href="about.php" class="<?= basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : '' ?>">About</a></li>
          <li><a href="enhancements.php" class="<?= basename($_SERVER['PHP_SELF']) == 'enhancements.php' ? 'active' : '' ?>">Enhancements</a></li>
          <li><a href="mailto:105313596@student.swin.edu.au">Email</a></li> <!-- Fixed email link -->
        </ul>
      </nav>
    </div>

    <div class="navbar-right">
      <div class="location">Hanoi, VN</div>

      <?php if (isset($_SESSION['user'])): ?>
        <img src="<?php echo $_SESSION['user']['avatar'] ?? './styles/images/avatar.png'; ?>" class="user-avatar" alt="avatar">
        <label for="menu-toggle" class="menu-btn">&#9776; Menu</label>
        <div class="logout-btn"><a href="logout.php">Logout</a></div>
      <?php else: ?>
        <label for="menu-toggle" class="menu-btn">&#9776; Menu</label>
        <div class="logout-btn"><a href="signin.php">Sign In</a></div>
      <?php endif; ?>
    </div>
  </div>
</header>
