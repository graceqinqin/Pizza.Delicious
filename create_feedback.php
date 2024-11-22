<?php
include('db_connection.php'); // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Prepare SQL query to insert feedback into the database
    $sql = "INSERT INTO data (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    // Execute the query and check if it was successful
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the feedback list page after successful insert
        header("Location: feedback_list.php");
        exit();
    } else {
        // Handle error if the query fails
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
