<?php

 session_start();

 if(isset($_POST['h']) && $_POST['h'] == '1')
 {
  require_once("connection.php");

  $con = mysqli_connect($servername, $username, $password);
  mysqli_select_db($con , $db);

  $query ="insert into commonfeedback (fullname, place, address, mobile, addeddate, feedback) 
	              values ('$_POST[fn]', '$_POST[p]', '$_POST[a]', '$_POST[mob]', now(), '$_POST[f]'); ";
  mysqli_query($con, $query);
		
  $rows = 0;
  $rows += mysqli_affected_rows($con);
  //print_r($query1);
	
  mysqli_query($con, $query1);
  $rows += mysqli_affected_rows($con);

  if($rows == 2)
  {
    echo "<script>alert('Your Feedback Added, Thank You...'); document.location.href = 'index.php';</script>";
  }
  else
  {
    echo "<script>alert('Error. Please Retry '); document.location.href='contact.php';</script>";
  }
 }

?>


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
	<link href="https://fonts.googleapis.com/css?family=Sarabun:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" 
	      rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/flaticon.css"/>
	<link rel="stylesheet" href="css/magnific-popup.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="css/style.css"/>


	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script type="text/javascript">

	  function doClear() 
	  {
	    document.getElementById('fn').value = "";
	    document.getElementById('a').value = "";
		document.getElementById('p').value = "";
		document.getElementById('mob').value = "";
		document.getElementById('f').value = "";
	  }

	  
	  function doSubmit() 
	  {
	    if (document.getElementById('fn').value == "") 
		{
	      alert("Please Enter Your FullName");
		  document.getElementById("form1").fn.focus();
	    }
		else if( /[^a-zA-Z]/.test(document.getElementById('fn').value))
	    {
	      alert("Fullname is not alphanumeric");
	      document.getElementById("form1").fn.focus();
	    }
		else if (document.getElementById('p').value == "") 
		{
	      alert("Please Enter Place");
		  document.getElementById("form1").p.focus();
	    }
		else if( /[^a-zA-Z]/.test(document.getElementById('p').value))
	    {
	      alert("Place is not alphanumeric");
	      document.getElementById("form1").p.focus();
	    }
	    else if (document.getElementById('a').value == "") 
		{
	      alert("Please Enter Address");
		  document.getElementById("form1").a.focus();
		}
		else if (document.getElementById('mob').value == "") 
		{
	      alert("Please Enter Mobile Number");
		  document.getElementById("mob").fn.focus();
		}
		else if (isNaN(document.getElementById('mob').value)) 
		{
	      alert("Mobile Number Should be a Number");
		  document.getElementById("form1").mob.focus();
		}
		else if (document.getElementById('mob').value.length != 10) 
		{
	      alert("Invalid Mobile Number");
		  document.getElementById("form1").mob.focus();
		}
		else if(document.getElementById('f').value=="")
		{
	      alert("Please Enter Your Feedback");
		  document.getElementById("form1").f.focus();
		}
	    else 
		{
		  document.getElementById('h').value = '1';
	      document.getElementById('form1').action = 'contact.php';
	      document.getElementById('form1').submit();
	    }
	  }

    </script>


  </head>
   
  
  <body>
	<!-- Page Preloder -->
	<div id="preloder">
	  <div class="loader"></div>
	</div>
	
	<!-- Header section -->
	<header class="header-section">
	  <!-- logo -->
	  <a href="index.php" class="site-logo">
		<img src="img/nsse_white (1).png" alt="">
	  </a>
	  <div class="nav-switch">
		<i class="fa fa-bars"></i>
	  </div>
	  
	  <div class="container">
		<ul class="main-menu">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="about.php">About Us</a></li>
		  <li><a href="events.php">Events</a></li>
		  <li><a href="login.php">Login</a></li>
		  <li><a href="contact.php">Contact</a></li>
		</ul>
	  </div>
	
	</header>
	<!-- Header section end -->
	
	<!-- Page top section -->
	<section class="page-top-section set-bg" data-setbg="img/contacting.jpg">
	  <div class="container">
		<div class="row">
		  <div class="col-lg-5">
			<div class="page-top-text text-white">
			  
			  <h2>Contact Us</h2>
			  <h1>Get In Touch</h1>
			
			</div>
		  </div>
		</div>
	  </div>
	</section>
	<!-- Page top section end -->

	<!-- Contact section-->
	<section class="contact-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 offset-lg-5">
					<div class="contact-info-box">
						<h5 class="contact-title">OFFICE</h5>
						<div class="contact-info">
							<div class="ci-item">
								<i class="fa fa-location-arrow"></i>
								<p>CHRIST COLLEGE, Thalassery</p>
							</div>
							<div class="ci-item">
								<i class="fa fa-phone"></i>
								<p>702-541-9128<br>907-259-0965</p>
							</div>
						</div>
						<h5 class="contact-title">ADD YOUR FEEDBACK</h5>
						<form class="contact-form" method="post" id="form1" action="" name="form1">
						  <input type='hidden' name='h' id='h' value='0' />
							<div class="form-field counter-section">
								<i class="fa fa-user" ></i>
								<input type="text" id="fn" name="fn" autocomplete='off' placeholder="Full Name">
							</div>
							<div class="form-field counter-section">
								<i class="fa fa-map-marker"></i>
								<input type="text" id="p" name="p" autocomplete='off' placeholder=" Place">
							</div>
							<div class="form-field counter-section">
								<i class="fa fa-address-card-o"></i>
								<textarea type="text" id="a" name="a" autocomplete='off' placeholder=" Address"></textarea>
							</div>
							<div class="form-field counter-section">
								<i class="fa fa-mobile"></i>
								<input type="text" id="mob" name="mob" autocomplete='off' placeholder="Mobile">
							</div>
							<div class="form-field counter-section">
								<i class="fa fa-commenting"></i>
								<textarea id="f" name="f" autocomplete='off' placeholder="Feedback ..."></textarea>
							</div>
							<button class="site-btn" onclick="doSubmit()" style="width:250px;" >Send</button>&nbsp;&nbsp;&nbsp;&nbsp;
                            <button class="site-btn" onclick="doClear()" style="width:250px;" >Clear</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Map -->
	  <div class="map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3906.2135789653835!2d75.49733611412421!3d11.749998843682565!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba426493ba37a23%3A0x5fced9be01f300b8!2sChrist%20College%20Thalassery!5e0!3m2!1sen!2sin!4v1580185946343!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
		</div>
	</section>
	<!-- Contact section end-->

	<!-- Footer section -->
	<footer class="footer-section">
	  <div class="container">
		<div class="row">
		  <div class="col-lg-5 col-md-2 col-sm-12">
			<div class="footer-widget">
			
			
			  <img src="img/logo_nsse_(1).png" alt="">
			</div>
		  </div>
        </div>
      </div>
	  
	  <div class="copyright">
        <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script>
		   All rights reserved | NSS Project<i class="fa fa-heart-o" aria-hidden="true"></i>
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
