<?php
 session_start();
 if(! (isset($_SESSION['loginid']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'admin') )
 {
  header("location: ../login.php");
 }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>National Service Scheme</title>
  <title>Marquee Tag</title> 
   <style> 
    .main 
	{ 
     text-align:center; 
     font-family:"Georgia"; 
    } 
    .marq 
	{ 
     padding-top:10px; 
     padding-bottom:10px; 
    } 
    .geek1 
	{ 
     font-size:40px; 
     font-weight:bold; 
     color:darkblue; 
     text-align:center; 
    } 
    .geek2 
	{ 
     text-align:center; 
    } 
   </style>

  <link href="../css/style_login.css" rel="stylesheet" type="text/css" media="screen" />
 </head>
 
 <body>
  <form method='post' id="form4" action="" name="form4">
   <div id="wrapper">
	<div id="header">
	 <div id="logo"> <h1><a href="#">NSS Evaluation System</a></h1> </div>
    </div>
	<div id="splash"><img src="img/demoadm.jpg" alt="" title="" style="width:980px; height:340px;" />
	</div>
	<!-- end #header -->
	
	<div id="page">
	 <div id="page-bgtop">
	  <div id="page-bgbtm">
	   <div id="content">
		<div class="post"> <h2 class="title"><a href="#"> Welcome To</a></h2>
	     <div class="entry" style="line-height:25px;">
          <div class = "main"> 
           <marquee class="marq" bgcolor = "white" direction = "down" loop="" > 
            <img src="../img/admin_marquee.jpg" width="500" height="250" align="center" /><br /><br />
			<img src="../img/yoga.jpg" width="500" height="250" align="center" /><br /><br />
			<div class="geek1">ADMIN PAGE</div> <br />
            <div class="geek2"></div> 
		   </marquee> 
          </div><br /> <br />
         </div>
		</div>
		<div style="clear: both;">&nbsp;</div>
	   </div>
	   <!-- end #content -->
	   
	   <div id="sidebar">
   		<ul><li> <h2> Admin Home</h2> <div ></div><br /> </li>
			<li><ul><li><a href="admin_home.php" style="text-decoration:none;">Home</a></li>
					<li><a href="add_program_officer.php">Add Program Officer</a></li>
					<li><a href="manage_program_officer.php">Manage Program Officer</a></li>
                    <li><a href="add_meeting.php">Add Meeting</a></li>
					<li><a href="manage_meeting.php">Manage Meetings</a></li>
					<li><a href="allot_mark.php">Allot Mark</a></li>
					<li><a href="manage_event.php">Manage Event</a></li>
					<li><a href="view_common_feedback.php">View Common Feedback</a></li>
					<li><a href="admin_change_password.php">Change Password</a></li>
					<li><a href="admin_update_profile.php">Update Profile</a></li>
					<li><a href="../logout.php">LogOut</a></li>
				</ul>
			</li>
		</ul>
	   </div>
	   <!-- end #sidebar -->
	   
	   <div style="clear: both;">&nbsp;</div>
	  </div>
	 </div>
	</div>
	<!-- end #page -->
   
   </div>
   <div id="footer">
    <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> 
       All rights reserved | NSS Project <i class="fa fa-heart-o" aria-hidden="true"></i> 
	   Designed by Aishwarya.K Chandana.P Nivya.R Swaralaya.M</a>
    </p>
   </div>
  </form>
 </body>
</html>