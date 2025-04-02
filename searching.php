<?php
// Kết nối database
require_once "./db/settings.php";
$dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);

if ($dbconn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $make = mysqli_real_escape_string($dbconn, $_POST["title"]);
        $query = "SELECT * FROM jobs WHERE title LIKE '%$title%'";
        $result = mysqli_query($dbconn, $query);

        if ($result) {
            echo "<table border='1'>";
                echo "<tr>
                         <td>ID</td>
                         <td>Make</td>
                         <td>Model</td>
                         <td>Price</td>
                         <td>Yom</td>
                      </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['car_id']}</td>";
            echo "<td>{$row['make']}</td>";
            echo "<td>{$row['model']}</td>";
            echo "<td>{$row['price']}</td>";
            echo "<td>{$row['yom']}</td>";
            echo "</tr>";
            }
            echo "</table>";
        }
    }
    mysqli_close($dbconn);
} else {
    echo "<p>Unable to connect to the database!</p>";
}
?>
