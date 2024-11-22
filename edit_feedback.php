<?php
include('db_connection.php');

// Check if the 'name' parameter is provided in the URL
if (isset($_GET['name'])) {
    $name = $_GET['name'];
    
    // Fetch the feedback based on the name
    $sql = "SELECT * FROM data WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $feedback = $result->fetch_assoc();
    } else {
        echo "Feedback not found.";
        exit;
    }
}

// Update feedback when the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Update the feedback in the database
    $sql = "UPDATE data SET email = ?, subject = ?, message = ? WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $email, $subject, $message, $name);

    if ($stmt->execute()) {
        echo "Feedback updated successfully.";
        header('Location: feedback_list.php'); // Redirect to the feedback list
        exit;
    } else {
        echo "Error updating feedback.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Feedback</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- External CSS files (same as your main website) -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet">
  
  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/ionicons.min.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">
  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/icomoon.css">
  <link rel="stylesheet" href="css/style.css">

  <style>
    /* Custom styles for the Edit Feedback form */
    body {
      font-family: 'Poppins', sans-serif;
    }
    .navbar {
      background-color: #333;
    }
    .navbar a {
      color: #fff;
    }
    .footer {
      text-align: center;
      padding: 20px;
      background-color: #333;
      color: #fff;
    }
    ..contact-section {
  background-color: #f7f7f7; /* Light background */
  padding: 40px 0;
}
    .contact-info p {
      margin-bottom: 15px;
    }
    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 5px;
    }
    .btn-primary {
      background-color: #f96d00;
      border: none;
      color: white;
      padding: 12px 24px;
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
      background-color: #e67e22;
    }
  </style>
</head>
<body>

<!-- Navbar -->
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

<!-- Hero Section -->
<section class="home-slider owl-carousel img" style="background-image: url(images/bg_1.jpg);">
  <div class="slider-item" style="background-image: url(images/bg_3.jpg);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text justify-content-center align-items-center">
        <div class="col-md-7 col-sm-12 text-center ftco-animate">
          <h1 class="mb-3 mt-5 bread">Edit Customer Feedback</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Edit Feedback</span></p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Feedback Form Section -->
<section class="ftco-section contact-section">
  <div class="container mt-5">
    <div class="row block-9">
      <div class="col-md-1"></div>
      <div class="col-md-6 ftco-animate">
        <!-- Feedback Form -->
        <form id="edit-feedback-form" action="edit_feedback.php?name=<?php echo $feedback['name']; ?>" method="POST">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="name" class="form-control" value="<?php echo $feedback['name']; ?>" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="email" name="email" class="form-control" value="<?php echo $feedback['email']; ?>" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <input type="text" name="subject" class="form-control" value="<?php echo $feedback['subject']; ?>" required>
          </div>
          <div class="form-group">
            <textarea name="message" cols="30" rows="7" class="form-control" required><?php echo $feedback['message']; ?></textarea>
          </div>
          <div class="form-group">
            <input type="submit" value="Save Changes" class="btn btn-primary py-3 px-5">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="footer">
  <p>&copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" style="color: #f96d00;">Colorlib</a></p>
</footer>

<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/jquery.timepicker.min.js"></script>
<script src="js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="js/google-map.js"></script>
<script src="js/main.js"></script>

</body>
</html>
