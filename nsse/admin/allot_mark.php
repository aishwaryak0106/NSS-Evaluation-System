<?php 

 session_start();
 if(! (isset($_SESSION['loginid']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'admin') )
 {
  header("location: ../login.php");
 }
 require_once("../connection.php");

 $con = mysqli_connect($servername, $username, $password);
 mysqli_select_db($con , $db);
	
 if(isset($_POST['h']) && $_POST['h'] == '1')
 {
  $query ="insert into campmarks (volunteer, marks, markdate, groupid) 
                  values ( (select fullname from volunteerdetails where 
				                   volunteerid = '$_POST[sv]'), '$_POST[mk]', now(),
				           (select groupid from groups where volunteerid = '$_POST[sv]')); ";
  mysqli_query($con, $query);
		
  $rows = 0;
  $rows += mysqli_affected_rows($con);

  if($rows == 1)
  {
   echo "<script>alert('Mark Given to Volunteer '); document.location.href = 'admin_home.php';</script>";
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
   function doClear() 
   {
	document.getElementById('sv').value = "Select One Volunteer";
	document.getElementById('mk').value = "";
   }
   function doSubmit() 
   {
	if (document.getElementById('sv').value == "Select One Volunteer") 
	{
	 alert("Please Select Volunteer");
	 document.getElementById("form9").sv.focus();
	}
	else if (document.getElementById('mk').value == "") 
	{
	 alert("Please Enter Mark");
	 document.getElementById("form9").mk.focus();
	}
	else if (!(document.getElementById('mk').value >=1) ) 
	{
	 alert("Invalid Mark Range");
	 document.getElementById("form9").mk.focus();
	}
	else if (!(document.getElementById('mk').value <=25) ) 
	{
	 alert("Invalid Mark Range");
	 document.getElementById("form9").mk.focus();
	}
	else if (isNaN(document.getElementById('mk').value)) 
	{
	 alert("Mark Should be a Number");
	 document.getElementById("form9").mk.focus();
	}
	else
	{
	 document.getElementById('h').value = '1';
	 document.getElementById('form9').action = 'allot_mark.php';
	 document.getElementById('form9').submit();
	}
   }
  </script>
 </head>
 
 <body>
  <form method='post' id="form9" action="" name="form9">
   <input type='hidden' name='h' id='h' value='0' />
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
		<div class="post"> <h2 class="title"><a href="#"> Allot Mark</a></h2> 
		 <div class="entry" style="line-height:25px;"><br/><br />
		  <label>Volunteers</label><br/>
		   <select class='txt' style="width:350px;" id="sv" name="sv">
		    <option value="Select One Volunteer">Select One Volunteer</option>
	<?php
	 require_once("../connection.php");

	 $con = mysqli_connect($servername, $username, $password);
	 mysqli_select_db($con , $db);

	 $query ="select volunteerdetails.volunteerid, concat( fullname, ' [', groupid, ' ]') from volunteerdetails 
		             join groups on volunteerdetails.volunteerid = groups.volunteerid 
		               where fullname not in (select volunteer from campmarks) "; 

	 $result= mysqli_query($con, $query);
	 while($row=mysqli_fetch_array($result))
	 {
	  echo "<option value='$row[0]'>$row[1]</option>";
 	 }
	?>
	       </select><br /><br />
          <label>Marks</label><br />
		   <input type='text' id='mk' name='mk' autocomplete='off' class='txt' style="width:350px;" /> <br /><br />
		  <div style="padding-top:15px;"><br />
		   <input type="button" value='Allot' class='btn' onclick='doSubmit();'  style="width:150px;"  />&nbsp;
		   <input type="button" value='Clear' class='btn' onclick='doClear();'  style="width:150px;"  />&nbsp;
		  </div><br /> <br />
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
					<li><a href="manage_meeting.php">Manage Meetings</a></li>
					<li><a href="allot_mark.php" style="text-decoration:none;">Allot Mark</a></li>
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