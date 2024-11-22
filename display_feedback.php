<?php
require_once "conn.php"; // Database connection

$sql = "SELECT * FROM data"; // Assuming the feedback table is called 'feedback'
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Output data for each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['subject']) . "</td>
                <td>" . htmlspecialchars($row['message']) . "</td>
                <td><a href='update_feedback.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a></td>
                <td><a href='delete_feedback.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No feedback available</td></tr>";
}
?>
