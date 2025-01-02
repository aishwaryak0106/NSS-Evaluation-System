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

  <link href="../css/style_login.css" rel="stylesheet" type="text/css" media="screen" />
 </head>
 
 <body>
  <form method='post' id="form16" action="" name="form16">
   <input type='hidden' id='ed' name='ed' value='0' />
  <div id="wrapper">
   <div id="header">
	<div id="logo"> <h1><a href="#">NSS Evaluation System</a></h1> </div>
   </div>
   <div id="splash"><img src="img/demoadm.jpg" alt="" title="" style="width:980px; height:340px;" /></div>
   <!-- end #header -->
   
   <div id="page">
	<div id="page-bgtop">
	 <div id="page-bgbtm">
	  <div id="content">
	   <div class="post"> <h2 class="title"><a href="#"> Common Feedback List </a></h2>
        <div class="entry" style="line-height:25px;">
	<?php
	 include '../connection.php';

	 $sql = "select fullname, place, mobile, addeddate, feedback from commonfeedback order by fullname desc ;";
	 $result = mysqli_query($link, $sql);

	 echo "<table style='width:100%;'>";
	 echo "<tr>";
	 echo "<td style='background-color:#1d0058;color:white; padding-left:5px;'>FullName</td>";
	 echo "<td style='background-color:#1d0058;color:white; padding-left:5px;'>Place</td>";
	 echo "<td style='background-color:#1d0058;color:white; padding-left:5px;'>Mobile</td>";
	 echo "<td style='background-color:#1d0058;color:white; padding-left:5px;'>Added Date</td>";
	 echo "<td style='background-color:#1d0058;color:white; padding-left:5px;'>Feedback</td>";
	 echo "</tr>";
		
	 if(!$result)
	 {
	  echo "<td colspan='4' style='color:red; padding-left:5px;border-bottom:solid 1px #1d0058;text-align:center;'>No Records Found</td>";
	 }
	 else
	 {
	  while($row = mysqli_fetch_array($result))
	  {
	   echo "<tr>";
	   echo "<td style='color:#1d0058; padding-left:5px;border-bottom:solid 1px #1d0058; text-align:left;'>$row[0]</td>";
	   echo "<td style='color:#1d0058; padding-left:5px;border-bottom:solid 1px #1d0058; text-align:left;'>$row[1]</td>";
	   echo "<td style='color:#1d0058; padding-left:5px;border-bottom:solid 1px #1d0058; text-align:left;'>$row[2]</td>";
	   echo "<td style='color:#1d0058; padding-left:5px;border-bottom:solid 1px #1d0058; text-align:left;'>$row[3]</td>";
	   echo "<td style='color:#1d0058; padding-left:5px;border-bottom:solid 1px #1d0058; text-align:left;'>$row[4]</td>";
	   echo "</tr>";
	  }
	 }
	 echo "</table>";
	?>
        </div>
	   </div>
	   <div style="clear: both;">&nbsp;</div>
	  </div>
	  <!-- end #content -->
	  
	  <div id="sidebar">
	   <ul><li> <h2> Admin Home</h2> <div ></div><br /> </li>
		   <li><ul><li><a href="admin_home.php">Home</a></li>
				   <li><a href="add_program_officer.php">Add Program Officer</a></li>
				   <li><a href="manage_program_officer.php"  style="text-decoration:none;">Manage Program Officer</a></li>
                   <li><a href="add_meeting.php">Add Meeting</a></li>
				   <li><a href="manage_meeting.php">Manage Meetings</a></li>
				   <li><a href="allot_mark.php">Allot Mark</a></li>
				   <li><a href="manage_event.php">Manage Event</a></li>
				   <li><a href="view_common_feedback.php" style="text-decoration:none;">View Common Feedback</a></li>
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