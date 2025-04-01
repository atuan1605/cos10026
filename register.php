<?php
session_start();
require_once './db/settings.php';

$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = '';
$name = '';
$errors = [];
$fieldErrors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    $name = trim($_POST['name']);

    // Validation
    if (strlen($username) < 4 || strlen($username) > 191) {
        $fieldErrors['username'] = "Username must be between 4 and 191 characters.";
    }

    if (strlen($password) < 6) {
        $fieldErrors['password'] = "Password must be at least 6 characters.";
    }

    if ($password !== $confirm) {
        $fieldErrors['confirm_password'] = "Passwords do not match.";
    }

    if (empty($name)) {
        $fieldErrors['name'] = "Full name is required.";
    }

    // Check if username exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $fieldErrors['username'] = "Username is already taken.";
    }
    $stmt->close();

    if (empty($fieldErrors)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, password, name, role, age, experience, skills, hobbies, hometown, image)
                                VALUES (?, ?, ?, 'User', 0, '', '', '', '', '')");
        $stmt->bind_param("sss", $username, $hashed, $name);

        if ($stmt->execute()) {
           $_SESSION['snackbarMessage'] = 'Account created successfully! You can now sign in.';
            $_SESSION['snackbarType'] = 'success';
            header('Location: signin.php');
            exit();
        } else {
            $errors[] = "Error creating account. Please try again.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="./styles/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="signin-page">
<div class="login-box">
  <h2>Register</h2>

  <?php if (!empty($errors)): ?>
    <div class="response error">
      <ul>
        <?php foreach ($errors as $e) echo "<li>" . htmlspecialchars($e) . "</li>"; ?>
      </ul>
    </div>
  <?php endif; ?>

  <form method="post" action="register.php">
    <div class="input-group">
      <div class="input-wrapper">
        <i class="fa fa-user"></i>
        <input type="text" name="username" placeholder="Username" required value="<?= htmlspecialchars($username) ?>">
      </div>
      <?php if (isset($fieldErrors['username'])): ?>
        <small class="error-text"><?= htmlspecialchars($fieldErrors['username']) ?></small>
      <?php endif; ?>
    </div>

    <div class="input-group">
      <div class="input-wrapper">
        <i class="fa fa-lock"></i>
        <input type="password" name="password" placeholder="Password" required>
      </div>
      <?php if (isset($fieldErrors['password'])): ?>
        <small class="error-text"><?= htmlspecialchars($fieldErrors['password']) ?></small>
      <?php endif; ?>
    </div>

    <div class="input-group">
      <div class="input-wrapper">
        <i class="fa fa-lock"></i>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      </div>
      <?php if (isset($fieldErrors['confirm_password'])): ?>
        <small class="error-text"><?= htmlspecialchars($fieldErrors['confirm_password']) ?></small>
      <?php endif; ?>
    </div>

    <div class="input-group">
      <div class="input-wrapper">
        <i class="fa fa-user-circle"></i>
        <input type="text" name="name" placeholder="Full Name" required value="<?= htmlspecialchars($name) ?>">
      </div>
      <?php if (isset($fieldErrors['name'])): ?>
        <small class="error-text"><?= htmlspecialchars($fieldErrors['name']) ?></small>
      <?php endif; ?>
    </div>

    <button type="submit" class="btn-login">Create Account</button>
  </form>

  <div class="back-home">
    <p>← <a href="signin.php">Already have an account? Sign in</a></p>
    <p>← <a href="index.php">Back to homepage</a></p>
  </div>
</div>
</body>
</html>
