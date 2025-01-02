<?php

 session_start();

 if(! (isset($_SESSION['loginid']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'admin') )
 {
  header("location: ../login.php");
 }
 if(isset($_POST['mat']) && $_POST['mat'] != "")
 {
  require_once("../connection.php");

  $con = mysqli_connect($servername, $username, $password);
  mysqli_select_db($con , $db);


  //2019-12-01 13:28:00.000
  $md = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'] . ' ' . 
	    $_POST['hr'] . ':' . $_POST['min'] . ":00.000";
	
  $query ="insert into meetings (meetingdate, matter, description, volunteers, teachers, status) 
                  values ('$md', '$_POST[mat]', '$_POST[desc]', '$_POST[nv]', '$_POST[nt]', 1); ";
  mysqli_query($con, $query);

  $rows = 0;
  $rows += mysqli_affected_rows($con);
	
  if($rows == 1)
  {
   echo "<script>alert('Meeting Fixed'); document.location.href = 'manage_meeting.php';</script>";
  }
  else
  {		
   echo "<script>alert('Error. Please Retry '); document.location.href='add_meeting.php';</script>";
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
	document.getElementById('mat').value = "";
	document.getElementById('desc').value = "";
	document.getElementById('day').value = "Day";
	document.getElementById('month').value = "Month";
	document.getElementById('year').value = "Year";
	document.getElementById('hr').value = "Hour";
	document.getElementById('min').value = "Minute";
	document.getElementById('nv').value = "";
	document.getElementById('nt').value = "";
   }
   function doSubmit() 
   {
	if (document.getElementById('mat').value == "") 
	{
	 alert("Please Enter Matter");
	 document.getElementById("form5").mat.focus();
	}
	else if (document.getElementById('desc').value == "") 
	{
	 alert("Please Enter Description");
	 document.getElementById("form5").desc.focus();
	}
	else if (document.getElementById('day').value == "Day") 
	{
	 alert("Please Enter Day");
	 document.getElementById("form5").day.focus();
	}
	else if (document.getElementById('month').value == "Month") 
	{
	 alert("Please Enter Month");
	 document.getElementById("form5").month.focus();
	}
	else if (document.getElementById('year').value == "Year") 
	{
	 alert("Please Enter Year");
	 document.getElementById("form5").year.focus();
	}
	else if (document.getElementById('hr').value == "Hour") 
	{
	 alert("Please Enter Valid Time");
	 document.getElementById("form5").hr.focus();
	}
	else if (document.getElementById('min').value == "Minute") 
	{
	 alert("Please Enter Valid Time");
	 document.getElementById("form5").min.focus();
	}
	else if (document.getElementById('nv').value == "") 
	{
	 alert("Please Enter Number of Volunteers");
	 document.getElementById("form5").nv.focus();
	}
	else if (isNaN(document.getElementById('nv').value)) 
	{
	 alert("Volunteer should be a Number");
	 document.getElementById("form5").nv.focus();
	}
	else if (!(document.getElementById('nv').value >=1) ) 
	{
	 alert("Invalid Volunteer Number");
	 document.getElementById("form5").nv.focus();
	}
	else if (!(document.getElementById('nv').value <=50) ) 
	{
	 alert("Invalid Volunteer Number");
	 document.getElementById("form5").nv.focus();
	}
	else if (document.getElementById('nt').value == "") 
	{
	 alert("Please Enter Number of Teachers");
	 document.getElementById("form5").nt.focus();
	}
	else if (isNaN(document.getElementById('nt').value)) 
	{
	 alert("Teacher Should be a Number");
	 document.getElementById("form5").nt.focus();
	}
	else if (!(document.getElementById('nt').value <= 2)   ) 
	{
	 alert("Invalid Teacher Number");
	 document.getElementById("form5").nt.focus();
	}
	else 
	{
	 document.getElementById('form5').action = 'add_meeting.php';
	 document.getElementById('form5').submit();
	}
   }
  </script>
 </head>

 <body>
  <form method='post' id="form5" action="#" name="form5">
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
		<div class="post"> <h2 class="title"><a href="#"> Add Meeting  </a></h2>
		 <div class="entry" style="line-height:25px;">
		  <label>Matter</label><br />
		   <input type='text' id="mat" name="mat" autocomplete='off' class='txt' style="width:350px;" /> <br />
		  <label>Description</label><br />
		   <textarea id='desc' name='desc' autocomplete='off' class='txt' style="width:350px;"></textarea> <br />
		  <label>Date</label><br />
		   <select class='txt' name="day" id="day" style="width:116px;">
			<option value='Day'>Day</option>
	<?php
	 for($i=1;$i<=31;$i++)
     {
	  echo "<option value='$i'>$i</value>";
	 }
	?>
	       </select>
		   <select class='txt' name="month" id="month" style="width:116px;">
			<option value='Month'>Month</option>
			<option value='1'>January</option>
			<option value='2'>February</option>
			<option value='3'>March</option>
			<option value='4'>April</option>
			<option value='5'>May</option>
			<option value='6'>June</option>
			<option value='7'>July</option>
			<option value='8'>August</option>
			<option value='9'>September</option>
			<option value='10'>October</option>
			<option value='11'>November</option>
			<option value='12'>December</option>
		   </select>
		   <select class='txt' name="year" id="year" style="width:116px;">
			<option value='Year'>Year</option>
	<?php
     for($i=2019;$i<=2021;$i++)
	 {
	  echo "<option value='$i'>$i</value>";
	 }
    ?>
	       </select><br />
		  <label>Time</label><br />
		   <select class='txt' name="hr" id="hr" style="width:175px;">
			<option value='Hour'>Hour</option>
	<?php
	 for($i=00;$i<=23;$i++)
	 {
	  echo "<option value='$i'>$i</value>";
	 }
	?>
	       </select>
		   <select class='txt' name="min" id="min" style="width:175px;">
			<option value='Minute'>Minute</option>
			<option value='0'>00</option>
			<option value='15'>15</option>
			<option value='30'>30</option>
			<option value='45'>45</option>
		   </select><br />
		  <label>No.of Volunteers</label><br />
		   <input type='text' id="nv" name="nv" autocomplete='off' class='txt' style="width:350px;" /> <br />
		  <label>No.of Teachers</label><br />
		   <input type='text' id="nt" name="nt" autocomplete='off' class='txt' style="width:350px;" /> <br />
		  <div style="padding-top:15px;">&nbsp;&nbsp;&nbsp;&nbsp;
		   <input type="button" value='Add' class='btn' onclick='doSubmit();'  style="width:150px;"  />&nbsp;
		   <input type="button" value='Clear' class='btn' onclick='doClear();'  style="width:150px;"  />
		  </div> <br /> <br />
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
                    <li><a href="add_meeting.php" style="text-decoration:none;">Add Meeting</a></li>
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