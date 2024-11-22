<?php
include('db_connection.php');

// Check if the 'name' parameter is provided in the URL
if (isset($_GET['name'])) {
    $name = $_GET['name'];

    // Delete the feedback from the database
    $sql = "DELETE FROM data WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);

    if ($stmt->execute()) {
        echo "Feedback deleted successfully.";
        header('Location: feedback_list.php'); // Redirect to the feedback list page
        exit;
    } else {
        echo "Error deleting feedback.";
    }
} else {
    echo "No feedback name provided.";
}
?>
