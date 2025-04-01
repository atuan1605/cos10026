<?php if (isset($_SESSION['snackbarMessage'])): ?>
  <div class="snackbar <?= $_SESSION['snackbarType'] ?? 'error' ?>">
    <?= htmlspecialchars($_SESSION['snackbarMessage']) ?>
  </div>
  <?php
    unset($_SESSION['snackbarMessage']);
    unset($_SESSION['snackbarType']);
  ?>
<?php endif; ?>
