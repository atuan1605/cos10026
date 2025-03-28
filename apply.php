<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>LuckyJob - Apply</title>
  <link rel="stylesheet" href="./styles/style.css" />
</head>
<body>

  <!-- HEADER & NAV -->
  <?php include 'header.php';?>
  <!-- MAIN CONTENT -->
  <div class="main-content" style="flex-direction: column;">
    <h1 id="applyHeader">Job Application Form</h1>
    <section class="applyForm">
      <form
        action="https://mercury.swin.edu.au/it000000/formtest.php"
        method="post"
      >
        <label for="refNo">Job Reference Number:</label><br>
        <input
          type="text"
          id="refNo"
          name="jobRef"
          pattern="[A-Za-z0-9]{5}"
          maxlength="5"
          placeholder="e.g. DEV01"
          required
        >
        <br><br>

        <label for="fname">First Name:</label><br>
        <input
          type="text"
          id="fname"
          name="firstName"
          maxlength="20"
          pattern="^[A-Za-z ]{1,20}$"
          placeholder="e.g. A"
          required
        >
        <br><br>

        <label for="lname">Last Name:</label><br>
        <input
          type="text"
          id="lname"
          name="lastName"
          maxlength="20"
          pattern="[A-Za-z\s]{1,20}"
          placeholder="e.g. Nguyen Van"
          required
        >
        <br><br>

        <label for="dob">Date of Birth:</label><br>
        <input
          type="date"
          id="dob"
          name="dob"
          placeholder="e.g. 15/08/2000"
          pattern="\\d{1,2}/\\d{1,2}/\\d{4}"
          required
        >
        <br><br>

        <fieldset>
          <legend>Gender</legend>
          <label><input type="radio" name="gender" value="Male" required> Male</label>
          <label><input type="radio" name="gender" value="Female" required> Female</label>
        </fieldset>
        <br>

        <label for="address">Street Address:</label><br>
        <input
          type="text"
          id="address"
          name="address"
          maxlength="40"
          placeholder="e.g. Room 706, Building Keangnam, Nam Trung Yen Ur"
          required
        >
        <br><br>

        <label for="suburb">Suburb/Town:</label><br>
        <input
          type="text"
          id="suburb"
          name="suburb"
          maxlength="40"
          placeholder="e.g. Hanoi"
          required
        >
        <br><br>

        <label for="state">State:</label><br>
        <select id="state" name="state" required>
          <option value="">--Select--</option>
          <option value="VIC">VIC</option>
          <option value="NSW">NSW</option>
          <option value="QLD">QLD</option>
          <option value="NT">NT</option>
          <option value="WA">WA</option>
          <option value="SA">SA</option>
          <option value="TAS">TAS</option>
          <option value="ACT">ACT</option>
        </select>
        <br><br>

        <label for="postcode">Postcode:</label><br>
        <input
          type="text"
          id="postcode"
          name="postcode"
          pattern="^[0-9]{4}$"
          placeholder="e.g. 1000"
          required
        >
        <br><br>

        <label for="email">Email:</label><br>
        <input
          type="email"
          id="email"
          name="email"
          pattern="/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/"
          placeholder="e.g. nguyenvana@gmail.com"
          required
        >
        <br><br>

        <label for="phone">Phone:</label><br>
        <input
          type="text"
          id="phone"
          name="phone"
          pattern="[0-9 ]{8,12}"
          placeholder="e.g. 09xxxxxxxx"
          required
        >
        <br><br>

        <fieldset>
          <legend>Skills</legend>
          <label><input type="checkbox" name="skills" value="HTML" checked> HTML</label>
          <label><input type="checkbox" name="skills" value="CSS" checked> CSS</label>
          <label><input type="checkbox" name="skills" value="JS" checked> JavaScript</label>
          <label><input type="checkbox" name="skills" value="Other"> Other skills...</label>
        </fieldset>
        <br>

        <label for="otherSkills">Describe other skills:</label><br>
        <textarea id="otherSkills" name="otherSkills" rows="4" cols="40"></textarea>
        <br><br>

        <button type="submit">Apply</button>
        <button type="reset" class="reset-btn">Reset</button>

      </form>
    </section>
  </div>
  <?php include 'footer.php';?>
</body>
</html>
