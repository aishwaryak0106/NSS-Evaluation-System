<?php

 session_start();
 ob_clean();

 if(! (isset($_SESSION['loginid']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'admin') )
 {
  header("location: ../login.php");
 }
  
 include '../connection.php';
            
 $sql = "select meetingid, matter, description, 
                day(meetingdate), month(meetingdate), year(meetingdate),
	            hour(meetingdate), minute(meetingdate),
	            volunteers, teachers, status
	            from meetings  where meetingid = '$_GET[id]' ";
 $result = mysqli_query($link, $sql);
 $row = mysqli_fetch_array($result);

 if(isset($_POST['ed']) && $_POST['ed'] != 0)
 {
  include '../connection.php';

  $sql = "select CONVERT(STATUS, int) from meetings where meetingid = '$_POST[po]';";
	
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_array($result);
		
  $r=0;
  if($row[0] == 0) $r =1; else $r = 0;
		
  $sql = "update meetings set status = $r where meetingid = '$_POST[po]';";
  $result = mysqli_query($link, $sql);
		
  if(mysqli_affected_rows($link) >= 0)
  {
   echo "<script>alert('Meeting Status Updated.'); document.location.href = 'manage_meeting.php';</script>";
  }
  else
  {
   echo "<script>alert('Error. Please Retry '); document.location.href='edit_meeting.php';</script>";
  }
 }
	
 if(isset($_POST['h']) && $_POST['h'] != 0) 
 {
  require_once("../connection.php");

  $con = mysqli_connect($servername, $username, $password);
  mysqli_select_db($con , $db);

  $md = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'] . ' ' . 
	    $_POST['hr'] . ':' . $_POST['min'] . ":00.000";
	
  $query ="update  meetings set meetingdate='$md', matter='$_POST[mat]', 
	                            description='$_POST[desc]', volunteers='$_POST[nv]', 
	                            teachers='$_POST[nt]' where meetingid = '$_POST[po]'; ";
  mysqli_query($con, $query);
	
  if(mysqli_affected_rows($con) >= 0)
  {
   echo "<script>alert('Meeting Details Updated'); document.location.href = 'manage_meeting.php';</script>";
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
   function changeStatus(row)
   {
	if(confirm("Change Status ?"))
	{
	 document.getElementById('ed').value = 1;
	 document.getElementById('form11').action = 'edit_meeting.php';
	 document.getElementById('form11').submit();
	}
   }
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
	 document.getElementById("form11").mat.focus();
	}
	else if (document.getElementById('desc').value == "") 
	{
	 alert("Please Enter Description");
	 document.getElementById("form11").desc.focus();
	}
	else if (document.getElementById('day').value == "Day") 
	{
	 alert("Please Enter Day");
	 document.getElementById("form11").day.focus();
	}
	else if (document.getElementById('month').value == "Month") 
	{
	 alert("Please Enter Month");
	 document.getElementById("form11").month.focus();
	}
	else if (document.getElementById('year').value == "Year") 
	{
	 alert("Please Enter Year");
	 document.getElementById("form11").year.focus();
	}
	else if (document.getElementById('hr').value == "Hour") 
	{
	 alert("Please Enter Valid Time");
	 document.getElementById("form11").hr.focus();
	}
	else if (document.getElementById('min').value == "Minute") 
	{
	 alert("Please Enter Valid Time");
	 document.getElementById("form11").min.focus();
	}
	else if (document.getElementById('nv').value == "") 
	{
	 alert("Please Enter Number of Volunteers");
	 document.getElementById("form11").nv.focus();
	}
	else if (isNaN(document.getElementById('nv').value)) 
	{
	 alert("Volunteer should be a Number");
	 document.getElementById("form11").nv.focus();
	}
	else if (!(document.getElementById('nv').value >=1) && (document.getElementById('nv').value <=50) ) 
	{
	 alert("Invalid Volunteer Number");
	 document.getElementById("form11").nv.focus();
	}
	else if (document.getElementById('nt').value == "") 
	{
	 alert("Please Enter Number of Teachers");
	 document.getElementById("form11").nt.focus();
	}
	else if (isNaN(document.getElementById('nt').value)) 
	{
	 alert("Teacher Should be a Number");
	 document.getElementById("form11").nt.focus();
	}
	else if (!(document.getElementById('nt').value <= 2)   ) 
	{
	 alert("Invalid Teacher Number");
	 document.getElementById("form11").nt.focus();
	}
	else 
	{
	 document.getElementById('h').value = '1';
	 document.getElementById('form11').action = 'edit_meeting.php';
	 document.getElementById('form11').submit();
	}
   }
  </script>
 </head>

 <body>
  <form method='post' id="form11" action="#" name="form11">
   <input type='hidden' id='ed' name='ed' value='0' />
   <input type='hidden' id='h' name='h' value='0' />
   <input type='hidden' id='po' name='po' value = '<?php if(isset($row)) echo $row[0]; else echo ""; ?>'/>
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
		<div class="post"> <h2 class="title"><a href="#"> Edit Meeting  </a></h2>
		 <div class="entry" style="line-height:25px;">
		  <label>Matter</label><br />
		   <input type='text' id="mat" name="mat" autocomplete='off' class='txt' style="width:350px;"  
			      value='<?php if(isset($row)) echo $row[1]; else echo ""; ?>' /> <br />
		  <label>Description</label><br />
		   <textarea id='desc' name='desc' autocomplete='off' class='txt' style="width:350px;">
			<?php if(isset($row)) echo $row[2]; else echo ""; ?>
		   </textarea> <br />
		  <label>Date</label><br />
		   <select name="day" id="day" style="width:116px;">
			<option value='Day'>Day</option>
	<?php
	 for($i=1;$i<=31;$i++)
	 {
	  if(isset($row) && $row[3] == $i)
	    echo "<option value='$i' selected>$i</value>";
	  else
		echo "<option value='$i'>$i</value>";
	 }
	?>
	       </select>
		   <select name="month" id="month" style="width:116px;">
			<option value='Month'>Month</option>
			<option value='1' <?php if(isset($row) && $row[4] == '1') echo 'selected'; else echo ""; ?> >January</option>
			<option value='2' <?php if(isset($row) && $row[4] == '2') echo 'selected'; else echo ""; ?> >February</option>
			<option value='3' <?php if(isset($row) && $row[4] == '3') echo 'selected'; else echo ""; ?> >March</option>
			<option value='4' <?php if(isset($row) && $row[4] == '4') echo 'selected'; else echo ""; ?> >April</option>
			<option value='5' <?php if(isset($row) && $row[4] == '5') echo 'selected'; else echo ""; ?> >May</option>
			<option value='6' <?php if(isset($row) && $row[4] == '6') echo 'selected'; else echo ""; ?> >June</option>
			<option value='7' <?php if(isset($row) && $row[4] == '7') echo 'selected'; else echo ""; ?> >July</option>
			<option value='8' <?php if(isset($row) && $row[4] == '8') echo 'selected'; else echo ""; ?> >August</option>
			<option value='9' <?php if(isset($row) && $row[4] == '9') echo 'selected'; else echo ""; ?> >September</option>
			<option value='10' <?php if(isset($row) && $row[4] == '10') echo 'selected'; else echo ""; ?> >October</option>
			<option value='11' <?php if(isset($row) && $row[4] == '11') echo 'selected'; else echo ""; ?> >November</option>
			<option value='12' <?php if(isset($row) && $row[4] == '12') echo 'selected'; else echo ""; ?> >December</option>
		   </select>
		   <select name="year" id="year" style="width:116px;">
			<option value='Year'>Year</option>
	<?php
     for($i=2019;$i<=2021;$i++)
	 {
	  if(isset($row) && $row[5] == $i)
		echo "<option value='$i' selected>$i</value>";
	  else
		echo "<option value='$i'>$i</value>";
	 }
    ?>
	       </select><br />
		  <label>Time</label><br />
		   <select name="hr" id="hr" style="width:175px;">
			<option value='Hour'>Hour</option>
	<?php
	 for($i=00;$i<=23;$i++)
	 {
	  if(isset($row) && $row[6] == $i)
		echo "<option value='$i' selected>$i</value>";
	  else
		echo "<option value='$i'>$i</value>";
	 }
	?>
	       </select>
		   <select name="min" id="min" style="width:175px;">
			<option value='Minute'>Minute</option>
			<option value='0' <?php if(isset($row) && $row[7] == 0) echo 'selected'; else echo ""; ?> >00</option>
			<option value='15' <?php if(isset($row) && $row[7] == 15) echo 'selected'; else echo ""; ?> >15</option>
			<option value='30' <?php if(isset($row) && $row[7] == 30) echo 'selected'; else echo ""; ?> >30</option>
			<option value='45' <?php if(isset($row) && $row[7] == 45) echo 'selected'; else echo ""; ?> >45</option>
		   </select><br /> 
		  <label>No.of Volunteers</label><br />
		   <input type='text' id="nv" name="nv" autocomplete='off' class='txt' style="width:350px;"  
			      value='<?php if(isset($row)) echo $row[8]; else echo ""; ?>' /> <br />
		  <label>No.of Teachers</label><br />
		   <input type='text' id="nt" name="nt" autocomplete='off' class='txt' style="width:350px;"  
			      value='<?php if(isset($row)) echo $row[9]; else echo ""; ?>' /> <br />
		  <div style="padding-top:15px;">
		   <input type="button" value='Edit' class='btn' onclick='doSubmit();'  style="width:150px;"  />&nbsp;
		   <input type="button" value='Disable / Enable' class='btn' onclick='changeStatus();'  style="width:150px;"  />
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