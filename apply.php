<?php
session_start();

$jobRef = $_GET['job_reference_number'] ?? '';

if (empty($jobRef)) {
    $_SESSION['snackbarMessage'] = 'Please select a job to access the apply form';
    header('Location: jobs.php');
    exit();
}

$errors = [];
$values = [];

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function isValidDOB($dob) {
    $birthDate = DateTime::createFromFormat('Y-m-d', $dob);
    if (!$birthDate) return false;
    $today = new DateTime();
    $age = $today->diff($birthDate)->y;
    return $age >= 15 && $age <= 80;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $values['job_reference'] = sanitize_input($_POST["jobRef"] ?? '');
    $values['firstName'] = sanitize_input($_POST["firstName"] ?? '');
    $values['lastName'] = sanitize_input($_POST["lastName"] ?? '');
    $values['dob'] = sanitize_input($_POST["dob"] ?? '');
    $values['gender'] = $_POST["gender"] ?? '';
    $values['address'] = sanitize_input($_POST["address"] ?? '');
    $values['suburb'] = sanitize_input($_POST["suburb"] ?? '');
    $values['state'] = $_POST["state"] ?? '';
    $values['postcode'] = sanitize_input($_POST["postcode"] ?? '');
    $values['email'] = sanitize_input($_POST["email"] ?? '');
    $values['phone'] = sanitize_input($_POST["phone"] ?? '');
    $values['skills'] = $_POST["skills"] ?? [];
    $values['otherSkills'] = sanitize_input($_POST["otherSkills"] ?? '');

    // Job Reference
    if (empty($values['job_reference']) || !preg_match("/^[A-Za-z0-9]{5}$/", $values['job_reference'])) {
        $errors['job_reference'] = "Job reference must be exactly 5 alphanumeric characters.";
    }

    // First Name
    $firstName = trim($values['firstName'] ?? '');
    if (empty($firstName) || !preg_match("/^[A-Za-z ]{1,20}$/", $firstName)) {
        $errors['firstName'] = "First name must be 1–20 letters, spaces allowed.";
    }

    // Last Name
    $lastName = trim($values['lastName'] ?? '');
    if (empty($lastName) || !preg_match("/^[A-Za-z ]{1,20}$/", $lastName)) {
        $errors['lastName'] = "First name must be 1–20 letters, spaces allowed.";
    }

    // DOB
    if (empty($values['dob'])) {
    $errors['dob'] = "Date of birth is required.";
    } elseif (!isValidDOB($values['dob'])) {
        $errors['dob'] = "Date of birth must result in an age between 15 and 80.";
    }

    // Gender
    if (empty($values['gender'])) {
        $errors['gender'] = "Please select a gender.";
    }

    // address
    if (empty($values['address'])) {
    $errors['address'] = "Street address is required.";
    } elseif (strlen($values['address']) > 40) {
        $errors['address'] = "Street address must be max 40 characters.";
    }

    // Suburb
    if (empty($values['suburb'])) {
        $errors['suburb'] = "Suburb/town is required.";
    }

    // State
    if (empty($values['state'])) {
        $errors['state'] = "Please select a state.";
    }

    // Postcode
    if (empty($values['postcode']) || !preg_match("/^\d{4}$/", $values['postcode'])) {
        $errors['postcode'] = "Postcode must be a 4-digit number.";
    }

    // Email
    if (empty($values['email']) || !filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    }

    // Phone
    if (empty($values['phone']) || !preg_match("/^\d{8,12}$/", $values['phone'])) {
        $errors['phone'] = "Phone number must be 8–12 digits.";
    }

    // Skills
    if (empty($values['skills'])) {
        $errors['skills'] = "Please select at least one skill.";
    }
    if (in_array('Other', $values['skills']) && empty($values['otherSkills'])) {
    $errors['otherSkills'] = "Please describe your other skills.";
    }

    if (empty($errors)) {
        require 'process_eoi.php';
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Application</title>
    <link rel="stylesheet" href="./styles/style.css" />
</head>
<body>
  <div class="main-content" style="flex-direction: column;">
    <h1 id="applyHeader">Job Application Form</h1>
    <section class="applyForm">
      <form action="" method="post" novalidate>

        <label for="jobRef">Job Reference Number:</label>
            <input type="text" name="jobRef" value="<?php echo htmlspecialchars($jobRef); ?>">
        <p id="error-message"></p>
        <label for="firstName">First Name:</label>
            <input type="text" name="firstName" value="<?= $values['firstName'] ?? '' ?>">
            <span id="error-message" class="error-text"><?= $errors['firstName'] ?? '' ?></span>


        <label for="lastName">Last Name: </label>
            <input type="text" name="lastName" value="<?= $values['lastName'] ?? '' ?>">
            <span id="error-message" class="error-text"><?= $errors['lastName'] ?? '' ?></span>

        <label for="dob">Date of Birth: </label>
            <input type="date" name="dob" value="<?= $values['dob'] ?? '' ?>">
            <span id="error-message" class="error-text"><?= $errors['dob'] ?? '' ?></span>


        <fieldset>
          <legend>Gender</legend>
            <input type="radio" name="gender" value="Male" <?= ($values['gender'] ?? '') == 'Male' ? 'checked' : '' ?>> Male
            <input type="radio" name="gender" value="Female" <?= ($values['gender'] ?? '') == 'Female' ? 'checked' : '' ?>> Female

        </fieldset>
        <span id="error-message" class="error-text"><?= $errors['gender'] ?? '' ?></span>

        <label for="address">Street Address: </label>
            <input type="text" name="address" value="<?= $values['address'] ?? '' ?>">
            <p id="error-message" class="error-text"><?= $errors['address'] ?? '' ?></p>


        <label for="suburb">Suburb/Town:</label>
            <input type="text" name="suburb" value="<?= $values['suburb'] ?? '' ?>">
            <span id="error-message" class="error-text"><?= $errors['suburb'] ?? '' ?></span>


        <label for="state">State: </label><br>
            <select id="state" name="state">
                <option value="">--Select--</option>
                <?php
                $states = ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'];
                foreach ($states as $state) {
                    $selected = ($values['state'] ?? '') === $state ? 'selected' : '';
                    echo "<option value=\"$state\" $selected>$state</option>";
                }
                ?>
            </select>
            <p id="error-message" class="error-text"><?= $errors['state'] ?? '' ?></p>


        <label for="postcode">Postcode:</label>
            <input type="text" name="postcode" value="<?= $values['postcode'] ?? '' ?>">
            <span id="error-message" class="error-text"><?= $errors['postcode'] ?? '' ?></span>


        <label for="email">Email:</label>
            <input type="email" name="email" value="<?= $values['email'] ?? '' ?>">
            <span id="error-message" class="error-text"><?= $errors['email'] ?? '' ?></span>


        <label for="phone">Phone Number: </label>
            <input type="text" name="phone" value="<?= $values['phone'] ?? '' ?>">
            <span id="error-message" class="error-text"><?= $errors['phone'] ?? '' ?></span>

        <fieldset>
          <legend>Skills</legend>
            <input type="checkbox" name="skills[]" value="HTML" <?= in_array("HTML", $values['skills'] ?? []) ? 'checked' : '' ?>> HTML
            <input type="checkbox" name="skills[]" value="CSS" <?= in_array("CSS", $values['skills'] ?? []) ? 'checked' : '' ?>> CSS
            <input type="checkbox" name="skills[]" value="JS" <?= in_array("JS", $values['skills'] ?? []) ? 'checked' : '' ?>> JS
            <input type="checkbox" name="skills[]" value="Other" <?= in_array("Other", $values['skills'] ?? []) ? 'checked' : '' ?>> Other
        </fieldset>
        <span id="error-message" class="error-text"><?= $errors['skills'] ?? '' ?></span>

        <label for="otherSkills">Other skills</label>
        <textarea name="otherSkills"><?= $values['otherSkills'] ?? '' ?></textarea>
         <span id="error-message" class="error-text"><?= $errors['otherSkills'] ?? '' ?></span>
        <br>
        <br>
        <button type="submit">Apply</button>
       <button type="reset" onclick="window.location.href='apply.php?job_reference_number=<?= urlencode($jobRef) ?>'">
  Reset
</button>
      </form>
    </section>
  </div>


     <?php include 'footer.php';?>
</body>
</html>
