<?php
session_start();
require_once __DIR__ . '/db/settings.php';

$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'avatar' => !empty($user['image']) ? $user['image'] : './styles/images/avatar.png'
            ];
            header("Location: index.php");
            exit();
        }
    }

    $_SESSION['snackbarMessage'] = 'Incorrect username or password!';
    $_SESSION['snackbarType'] = 'error';
    header("Location: signin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign In</title>
  <link rel="stylesheet" href="./styles/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="signin-page">

<div class="login-box">
  <h2>Sign In</h2>
  <form method="post" action="signin.php">
    <div class="input-group">
      <i class="fa fa-user"></i>
      <input type="text" name="username" placeholder="Username" required>
    </div>
    <div class="input-group">
      <i class="fa fa-lock"></i>
      <input type="password" name="password" placeholder="Password" required>
    </div>
    <div class="forgot">
      <a href="register.php">Don't have an account? Register here</a>
    </div>
    <button type="submit" class="btn-login">Sign In</button>
  </form>

  <div class="back-home">
    <a href="index.php">&larr; Back to homepage</a>
  </div>
</div>

<?php
if (isset($_SESSION['snackbarMessage'])) {
    $snackbarMessage = $_SESSION['snackbarMessage'];
    $snackbarType = $_SESSION['snackbarType'] ?? 'error';
    unset($_SESSION['snackbarMessage'], $_SESSION['snackbarType']);
    echo "<div class='snackbar {$snackbarType}'>" . htmlspecialchars($snackbarMessage) . "</div>";
}
?>
</body>
</html>
