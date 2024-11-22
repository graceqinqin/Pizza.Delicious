<?php
$servername = "localhost";
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "pizza"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM data";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table'>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['name']."</td>
                <td>".$row['email']."</td>
                <td>".$row['subject']."</td>
                <td>".$row['message']."</td>
                <td>
                    <button class='edit-btn' data-id='".$row['name']."'>Edit</button>
                    <button class='delete-btn' data-id='".$row['name']."'>Delete</button>
                </td>
            </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "0 results";
}

$conn->close();
?>
