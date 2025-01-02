<!DOCTYPE html>
 <html lang="zxx">
  <head>
   <title>National Service Scheme</title>
   <meta charset="UTF-8">
   <meta name="description" content="Real estate html template">
   <meta name="keywords" content="real estate, html">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
   <!-- Favicon -->
   <link href="img/favicon.ico" rel="shortcut icon"/>

   <!-- Google font -->
   <link href="https://fonts.googleapis.com/css?family=Sarabun:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">

   <!-- Stylesheets -->
   <link rel="stylesheet" href="css/bootstrap.min.css"/>
   <link rel="stylesheet" href="css/font-awesome.min.css"/>
   <link rel="stylesheet" href="css/flaticon.css"/>
   <link rel="stylesheet" href="css/magnific-popup.css"/>
   <link rel="stylesheet" href="css/owl.carousel.min.css"/>

   <!-- Main Stylesheets -->
   <link rel="stylesheet" href="css/style.css"/>

  </head>
  
  <body>
   <!-- Page Preloder -->
   <div id="preloder">
    <div class="loader"></div>
   </div>
	
   <!-- Header section -->
   <header class="header-section">
	<!-- logo -->
	<a href="index.php" class="site-logo"> <img src="img/nsse_white (1).png" alt=""> </a>
	<div class="nav-switch"> <i class="fa fa-bars"></i> </div>
	<div class="container">
	 <ul class="main-menu"><li><a href="index.php">Home</a></li>
		                   <li><a href="about.php">About Us</a></li>
		                   <li><a href="events.php">Events</a></li>
		                   <li><a href="login.php">Login</a></li>
		                   <li><a href="contact.php">Contact</a></li>
	 </ul>
	</div>
   </header>
   <!-- Header section end -->
	
   <!-- Page top section -->
   <section class="page-top-section set-bg" data-setbg="img/event/events_bg.jpg">
	<div class="container">
	 <div class="row">
	  <div class="col-lg-6"></div> 
	 </div>
	</div>
   </section>
   <!-- Page top section end -->

   <!-- Developments section-->
   <section class="developments-section spad">
	<div class="container">
	 <div class="row">
	  <?php
	    require_once("connection.php");
		$con = mysqli_connect($servername, $username, $password);
	    mysqli_select_db($con , $db);

		$q="select title,news,addeddate,image from events";
		$p=mysqli_query($con,$q);
		while($r=mysqli_fetch_array($p))
		{
	  ?>
	   <div class="col-lg-4 col-md-6">
		<div class="development-box ">
		 <a href="uploads/<?php echo $r['image'];?>" alt="" class="img-popup-gallery">
		  <img src="uploads/<?php echo $r['image'];?>" alt="">
		 </a>
		 <div class="dev-text">
		  <h4><?php echo $r['title'];?></h4>
		  <p> <?php echo $r['news'];?></p>
		  <p> <?php echo $r['addeddate'];?></p>
		  <div class="dev-price"></div>
		 </div>
		</div>
	   </div>
	   <?php
	    }
	   ?>
	 </div>
	</div>
   </div>
  </section>
  <!-- Developments section end-->

  <!-- Subscribe section -->
  <section class="subscribe-section spad">
   <div class="container">
	<div class="subscribe-text text-center">
	 <h2>Exciting New Events Coming Soon</h2>
	</div>
   </div>
  </section>
  <!-- Subscribe section end-->
	
  <!-- Footer section -->
  <footer class="footer-section">
   <div class="container">
    <div class="row">
	 <div class="col-lg-5 col-md-2 col-sm-12">
	  <div class="footer-widget"> <img src="img/logo_nsse_(1).png" alt=""> </div>
	 </div>
	</div>
	<div class="copyright">
	 <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script>
  	    All rights reserved | NSS Project <i class="fa fa-heart-o" aria-hidden="true"></i>
	    Designed by Aishwarya.K Chandana.P Nivya.R Swaralaya.M
	 </p>
    </div>
   </div>
  </footer>
  <!-- Footer section end-->
	
  <!--====== Javascripts & Jquery ======-->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/main.js"></script>

 </body>
</html>
