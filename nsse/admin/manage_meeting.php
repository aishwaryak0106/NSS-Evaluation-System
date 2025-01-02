<?php

 session_start();

 if(! (isset($_SESSION['loginid']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'admin') )
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

  $sql = "update meetings set status = $r where meetingid = '$_POST[ed]';";
  $result = mysqli_query($link, $sql);
		
  if(mysqli_affected_rows($link) >= 0)
  {
   echo "<script>alert('Status Updated.'); document.location.href = 'manage_meeting.php';</script>";
  }
  else
  {
   echo "<script>alert('Error. Please Retry '); document.location.href='admin_home.php';</script>";
  }
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

  <script type="text/javascript">
   function doEnableDisable(row)
   {
	if(confirm("Change Status ?"))
	{
	 document.getElementById('ed').value = row;
	 document.getElementById('form14').action = 'manage_meeting.php';
	 document.getElementById('form14').submit();
	}
   }
  </script>
 </head>
 
 <body>
  <form method='post' id="form14" action="" name="form14">
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
	   <div class="post"> <h2 class="title"><a href="#"> Manage Meetings</a></h2>
        <div class="entry" style="line-height:25px;">
	<?php
	 include '../connection.php';

	 $sql = "select meetingid, meetingdate, matter, case status when 1 then 'Enabled' else 'Disabled' end 
					from meetings order by status, meetingdate asc ;";

	 $result = mysqli_query($link, $sql);

	 echo "<table style='width:100%;'>";
	 echo "<tr>";
	 echo "<td style='background-color:#1d0058;color:white; padding-left:5px;'>Meeting Date</td>";
	 echo "<td style='background-color:#1d0058;color:white; padding-left:5px;'>Matter</td>";
	 echo "<td style='background-color:#1d0058;color:white; padding-left:5px;'>Status</td>";
	 echo "<td style='background-color:#1d0058;color:white; padding-left:5px;'>Edit</td>";
	 echo "</tr>";
		
	 if(!$result)
	 {
	  echo "<td colspan='4' style='color:red; padding-left:5px;border-bottom:solid 1px #1d0058;
			    text-align:center;'>No Records Found</td>";
	 }
	 else
     {
	  while($row = mysqli_fetch_array($result))
	  {
	   if($row[3] == 'Disabled')
	   {
		echo "<tr>";
		echo "<td style='color:red; padding-left:10px;border-bottom:solid 1px #1d0058;'>$row[1]</td>";
		echo "<td style='color:red; padding-left:10px;border-bottom:solid 1px #1d0058;'>$row[2]</td>";
		echo "<td style='color:red; padding-left:10px;border-bottom:solid 1px #1d0058;'><a href='#' style='color:red;' 
		          onclick='doEnableDisable(" . $row[0] . ");'>$row[3]</a></td>";
		echo "<td style='color:red; padding-left:10px;border-bottom:solid 1px #1d0058;'><a  style='color:red;'  
		          href='edit_meeting.php?id=$row[0]'>Edit</a></td>";
		echo "</tr>";
	   }
	   else
	   {
		echo "<tr>";
		echo "<td style='color:#1d0058; padding-left:5px;border-bottom:solid 1px #1d0058;'>$row[1]</td>";
		echo "<td style='color:#1d0058; padding-left:5px;border-bottom:solid 1px #1d0058;'>$row[2]</td>";
		echo "<td style='color:#1d0058; padding-left:5px;border-bottom:solid 1px #1d0058;'>$row[3]</td>";
		echo "<td style='color:#1d0058; padding-left:5px;border-bottom:solid 1px #1d0058;'><a href='edit_meeting.php?id=$row[0]'>Edit</a></td>";
		echo "</tr>";
	   }
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
				   <li><a href="manage_program_officer.php">Manage Program Officer</a></li>
                   <li><a href="add_meeting.php">Add Meeting</a></li>
				   <li><a href="manage_meeting.php" style="text-decoration:none;">Manage Meetings</a></li>
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