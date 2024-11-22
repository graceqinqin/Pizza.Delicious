<?php
include('db_connection.php');  // Include database connection

// Fetch feedback from the database
$sql = "SELECT * FROM data";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Feedback List</title>
  
  <!-- External Stylesheets -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #000; /* Black background for the page */
      color: white; /* White text for the entire page */
    }

    /* Navbar Styling (Match edit_feedback.php) */
    .navbar {
      background-color: #333; /* Dark navbar background */
    }
    .navbar a {
      color: #fff; /* White text color for navbar links */
    }
    .navbar a:hover {
      color: #f96d00; /* Highlight color for navbar links on hover */
    }

    .feedback-table {
      margin-top: 20px;
      background-color: #222; /* Dark background for table */
      color: white; /* Set text color inside table to white */
    }

    .feedback-table th, .feedback-table td {
      padding: 15px;
      text-align: center;
      color: white; /* Ensure table content text is white */
    }

    /* Table Header Styling */
    .feedback-table th {
      background-color: #444; /* Dark grey background for the header */
    }

    .table {
      margin-top: 30px;
      width: 100%;
    }

    .delete-btn {
      background-color: #f44336;
      color: white;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .delete-btn:hover {
      background-color: #d32f2f; /* Darker red when hovered */
    }

    .edit-btn {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .edit-btn:hover {
      background-color: #388e3c; /* Darker green when hovered */
    }

    .footer {
      text-align: center;
      margin-top: 50px;
      padding: 20px;
      background-color: #333;
      color: #fff;
    }

    /* Adjust padding for content and text */
    .ftco-section {
      padding: 50px 0;
      background-color: #000;
    }

    .container {
      color: #fff; /* White text inside the container */
    }

    h1 {
      color: #fff; /* White color for headings */
      text-align: center;
      margin-bottom: 30px;
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
        <li class="nav-item"><a href="index.html" class="nav-link">𝗛𝗼𝗺𝗲</a></li>
        <li class="nav-item"><a href="menu.html" class="nav-link">𝗠𝗲𝗻𝘂</a></li>
        <li class="nav-item"><a href="services.html" class="nav-link">𝗦𝗲𝗿𝘃𝗶𝗰𝗲𝘀</a></li>
        <li class="nav-item"><a href="blog.html" class="nav-link">𝗕𝗹𝗼𝗴</a></li>
        <li class="nav-item"><a href="about.html" class="nav-link">𝗔𝗯𝗼𝘂𝘁</a></li>
        <li class="nav-item active"><a href="contact.html" class="nav-link">𝗙𝗲𝗲𝗱𝗯𝗮𝗰𝗸</a></li>
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
        <div class="col-md-7 col-sm-12 text-center">
          <h1 class="mb-3 mt-5 bread">𝗖𝗨𝗦𝗧𝗢𝗠𝗘𝗥 𝗙𝗘𝗘𝗗𝗕𝗔𝗖𝗞</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="index.html">𝗛𝗼𝗺𝗲</a></span> <span>𝗙𝗲𝗲𝗱𝗯𝗮𝗰𝗸</span></p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Feedback Section -->
<section class="ftco-section">
  <div class="container">
    <h1>𝗖𝘂𝘀𝘁𝗼𝗺𝗲𝗿 𝗙𝗲𝗲𝗱𝗯𝗮𝗰𝗸</h1>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered feedback-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Subject</th>
              <th>Message</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- Feedback rows -->
            <?php
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td>".$row['name']."</td>
                          <td>".$row['email']."</td>
                          <td>".$row['subject']."</td>
                          <td>".$row['message']."</td>
                          <td>
                            <a href='edit_feedback.php?name=".$row['name']."' class='btn edit-btn'>Edit</a>
                            <a href='delete_feedback.php?name=".$row['name']."' class='btn delete-btn'>Delete</a>
                          </td>
                        </tr>";
                }
              } else {
                echo "<tr><td colspan='5'>No feedback available.</td></tr>";
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<footer class="ftco-footer ftco-section img">
    	<div class="overlay"></div>
      <div class="container">
        <div class="row mb-5">
          <div class="col-lg-3 col-md-6 mb-5 mb-md-5">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">𝗔𝗕𝗢𝗨𝗧 𝗨𝗦</h2>
			  <p>Tiap Potongan Pizza Kami Penuh dengan Kejutan Rasa yang Siap Memanjakan Lidah!</p>
			  <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
				<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
				<li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
				<li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
			  </ul>
			</div>
		  </div>
		  <div class="col-lg-4 col-md-6 mb-5 mb-md-5">
			<div class="ftco-footer-widget mb-4">
			  <h2 class="ftco-heading-2">𝗥𝗘𝗖𝗘𝗡𝗧 𝗕𝗟𝗢𝗚</h2>
			  <div class="block-21 mb-4 d-flex">
				<a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
				<div class="text">
				  <h3 class="heading"><a href="#">𝗧𝗵𝗲 𝗗𝗲𝗹𝗶𝗰𝗶𝗼𝘂𝘀 𝗣𝗮𝘀𝘁𝗮</a></h3>
				  <div class="meta">
					<div><a href="#"><span class="icon-calendar"></span> Nov 20, 2024</a></div>
					<div><a href="#"><span class="icon-person"></span> Admin</a></div>
					<div><a href="#"><span class="icon-chat"></span> 19</a></div>
				  </div>
				</div>
			  </div>
			  <div class="block-21 mb-4 d-flex">
				<a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
				<div class="text">
				  <h3 class="heading"><a href="#">𝗧𝗵𝗲 𝗗𝗲𝗹𝗶𝗰𝗶𝗼𝘂𝘀 𝗣𝗮𝘀𝘁𝗮</a></h3>
				  <div class="meta">
					<div><a href="#"><span class="icon-calendar"></span> Nov 20, 2024</a></div>
					<div><a href="#"><span class="icon-person"></span> Admin</a></div>
					<div><a href="#"><span class="icon-chat"></span> 19</a></div>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		  <div class="col-lg-2 col-md-6 mb-5 mb-md-5">
			 <div class="ftco-footer-widget mb-4 ml-md-4">
			  <h2 class="ftco-heading-2">𝗦𝗘𝗥𝗩𝗜𝗖𝗘𝗦</h2>
			  <ul class="list-unstyled">
				<li><a href="#" class="py-2 d-block">Cooked</a></li>
				<li><a href="#" class="py-2 d-block">Deliver</a></li>
				<li><a href="#" class="py-2 d-block">Quality Foods</a></li>
				<li><a href="#" class="py-2 d-block">Mixed</a></li>
			  </ul>
			</div>
		  </div>
		  <div class="col-lg-3 col-md-6 mb-5 mb-md-5">
			<div class="ftco-footer-widget mb-4">
				<h2 class="ftco-heading-2">𝗛𝗔𝗩𝗘 𝗔 𝗤𝗨𝗘𝗦𝗧𝗜𝗢𝗡𝗦?</h2>
				<div class="block-23 mb-3">
				<ul>
				  <li><span class="icon icon-map-marker"></span><span class="text">Emerald Heights 101, Sapphire Boulevard, Kota Jakarta, Indonesia</span></li>
				  <li><a href="#"><span class="icon icon-phone"></span><span class="text">000 (123) 456 7890</span></a></li>
				  <li><a href="#"><span class="icon icon-envelope"></span><span class="text">pizza.delicious.gmail.com</span></a></li>
				</ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
<!-- Footer -->
<footer class="footer">
  <p>&copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" style="color: #f96d00;">Giseila & Grace</a></p>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
