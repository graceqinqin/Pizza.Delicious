<?php
require_once "conn.php"; // Database connection

// Check if the 'email' parameter is passed in the URL
if (isset($_GET['email'])) {
    $email = $_GET['email']; // Get the email of the feedback to edit

    // Fetch the feedback from the database using the email
    $sql = "SELECT * FROM data WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // If the feedback does not exist, show an error message and stop script
    if (!$row) {
        echo "Feedback not found.";
        exit;
    }
} else {
    echo "Email parameter missing.";
    exit;
}

// Handle the form submission to update the feedback
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the updated values from the form
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Update the feedback record in the database
    $update_sql = "UPDATE data SET name = ?, subject = ?, message = ? WHERE email = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssss", $name, $subject, $message, $email);

    if ($stmt->execute()) {
        // If the update is successful, redirect back to the feedback list
        header("Location: contact.php");  // Redirect to the contact page or feedback list
        exit;
    } else {
        echo "Error updating feedback: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Feedback</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Google Fonts and CSS -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Custom CSS for styling -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- Navbar (Same as in contact.html) -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.html"><span class="flaticon-pizza-1 mr-1"></span>Pizza<br><small>Delicious</small></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="menu.html" class="nav-link">Menu</a></li>
                    <li class="nav-item"><a href="services.html" class="nav-link">Services</a></li>
                    <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
                    <li class="nav-item active"><a href="contact.html" class="nav-link">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <section class="ftco-section contact-section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center mb-4">Edit Feedback</h2>

                    <?php if (isset($row)): ?>
                    <!-- Feedback Edit Form -->
                    <form action="update_feedback.php?email=<?php echo urlencode($email); ?>" method="POST">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject:</label>
                            <input type="text" class="form-control" id="subject" name="subject" value="<?php echo htmlspecialchars($row['subject']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required><?php echo htmlspecialchars($row['message']); ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary py-3 px-5">Update Feedback</button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>&copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap and Custom JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
