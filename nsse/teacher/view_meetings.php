<?php
 session_start();

 if(! (isset($_SESSION['loginid']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'teacher') )
 {
  header("location: ../login.php");
 }

 if(isset($_POST['ed']) && $_POST['ed'] != 0)
 {
  include '../connection.php';

  $sql = "select CONVERT(STATUS, int) from meetings where meetingidid = '$_POST[ed]';";
		
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_array($result);
		
  $r=0;
  if($row[0] == 0) $r =1; else $r = 0;
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
  <form method='post' id="form14" action="" name="form14">
   <input type='hidden' id='ed' name='ed' value='0' />
   <div id="wrapper">
    <div id="header">
	 <div id="logo"> <h1><a href="#">NSS Evaluation System</a></h1> </div>
	</div>
	<div id="splash"><img src="img/bgteacher.jpg" alt="" title="" style="width:980px; height:340px;" /></div>
	<!-- end #header -->

	<div id="page">
	 <div id="page-bgtop">
	  <div id="page-bgbtm">
	   <div id="content">
		<div class="post"> <h2 class="title"><a href="#"> View Meetings</a></h2>
		 <div class="entry" style="line-height:25px;">
	<?php
	 include '../connection.php';

	 $sql = "select meetingid, meetingdate, matter, volunteers, teachers		
	 	            from meetings where status='1' order by meetingdate desc;";
	 $result = mysqli_query($link, $sql);

	 echo "<table style='width:100%;'>";
	 echo "<tr>";
	 echo "<td style='background-color:#1d0058;color:white; padding-left:5px;'>Meeting Date</td>";
	 echo "<td style='background-color:#1d0058;color:white; padding-left:5px;'>Matter</td>";
	 echo "<td style='background-color:#1d0058;color:white; padding-left:5px;'>Volunteers</td>";
	 echo "<td style='background-color:#1d0058;color:white; padding-left:5px;'>Teachers</td>";
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
	   echo "<td style='color:#1d0058; padding-left:5px;border-bottom:solid 1px #1d0058;'>$row[1]</td>";
	   echo "<td style='color:#1d0058; padding-left:5px;border-bottom:solid 1px #1d0058;'>$row[2]</td>";
	   echo "<td style='color:#1d0058; padding-left:5px;border-bottom:solid 1px #1d0058;'>$row[3]</td>";
	   echo "<td style='color:#1d0058; padding-left:5px;border-bottom:solid 1px #1d0058;'>$row[4]</td>";
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
		<ul><li> <h2> Teacher Home</h2> <div></div><br /> </li>
			<li><ul><li><a href="teacher_home.php">Home</a></li>
					<li><a href="view_meetings.php" style="text-decoration:none;">View Meetings</a></li>
					<li><a href="manage_volunteer.php">Manage Volunteer</a></li>
                    <li><a href="allot_duty.php">Allot duty</a></li>
					<li><a href="allot_charity.php">Allot Charity</a></li>
					<li><a href="charity_list.php">Charity List</a></li>
					<li><a href="teacher_change_password.php">Change Password</a></li>
					<li><a href="teacher_update_profile.php">Update Profile</a></li>
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