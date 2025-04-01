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
          <li><a href="<?= $_SERVER['PHP_SELF']; ?>?error=apply-disabled" style="opacity: 0.5;">Apply</a></li>
          <li><a href="about.php" class="<?= basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : '' ?>">About</a></li>
          <li><a href="enhancements.php" class="<?= basename($_SERVER['PHP_SELF']) == 'enhancements.php' ? 'active' : '' ?>">Enhancements</a></li>
          <li><a href="mailto:105313596@student.swin.edu.au">Email</a></li>

          <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'Admin'): ?>
            <li><a href="manage.php" class="<?= basename($_SERVER['PHP_SELF']) == 'manage.php' ? 'active' : '' ?>">Manage</a></li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>

    <div class="navbar-right">
      <div class="location">Hanoi, VN</div>

      <?php if (isset($_SESSION['user'])): ?>
        <?php
        $avatar = !empty($_SESSION['user']['avatar']) ? $_SESSION['user']['avatar'] : './styles/images/avatar.png';
        ?>
        <img src="<?= htmlspecialchars($avatar) ?>" class="user-avatar" alt="avatar">
        <label for="menu-toggle" class="menu-btn">&#9776; Menu</label>
        <div class="logout-btn"><a href="logout.php">Logout</a></div>
      <?php else: ?>
        <label for="menu-toggle" class="menu-btn">&#9776; Menu</label>
        <div class="logout-btn"><a href="signin.php">Sign In</a></div>
      <?php endif; ?>
    </div>
  </div>
</header>

<?php
$error = $_GET['error'] ?? null;
if ($error === 'apply-disabled') {
    $snackbarMessage = "Please select a job to access the apply form";
    $snackbarType = "error";
    echo "<div class='snackbar {$snackbarType}'>" . htmlspecialchars($snackbarMessage) . "</div>";
}
?>
