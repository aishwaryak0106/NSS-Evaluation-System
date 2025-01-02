<?php
 session_start();

 if(! (isset($_SESSION['loginid']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'officer') )
 {
  header("location: ../login.php");
 }
 require_once("../connection.php");

 $con = mysqli_connect($servername, $username, $password);
 mysqli_select_db($con , $db);

 if(isset($_POST['g']) && $_POST['g'] != "")
 {
  $g="select count(groupid) from groups where groupid = '$_POST[g]';";
  $v="select (volunteerid) from groups where groupid = '$_POST[g]' and volunteerid = '$_POST[sv]';";
  $rpt="select count(volunteerid) from groups where volunteerid = '$_POST[sv]';";
	 
  $rs1 = mysqli_query($con, $g); $rw1 = mysqli_fetch_array($rs1); 
  $rs2 = mysqli_query($con, $v); $rw2 = mysqli_fetch_array($rs2); 
  $rs3 = mysqli_query($con, $rpt); $rw3 = mysqli_fetch_array($rs3);
	 
  if($rw1[0]>10)
  {
   echo "<script>alert('Invalid Volunteer Group'); </script>" ;
  }
  else if($rw2[0]!= "")
  {
   echo "<script>alert('Invalid Volunteer'); </script>" ;
  }
  else if($rw3[0]>0)
  {
   echo "<script>alert('No Volunteer should report to more than one Group'); </script>";
  }
  else
  {
   $query ="insert into groups (groupid, volunteerid ) values ('$_POST[g]', '$_POST[sv]' ); ";
   mysqli_query($con, $query);
		
   $r=$_POST['g'];
   echo $r;
   echo $query;
		
   $rows = 0;
   $rows += mysqli_affected_rows($con);
   if($rows == 1)
   {
	echo "<script>alert('One Boy Added to Group'); document.location.href = 'program_officer_home.php';</script>";
   }
   else
   {
	echo "<script>alert('Error. Please Retry '); document.location.href='program_officer_home.php';</script>";
   }
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
	document.getElementById('g').value = "Select One Group";
	document.getElementById('sv').value = "Select One Volunteer"; 
   }
   function doSubmit() 
   {
	if (document.getElementById('g').value == "Select One Group") 
	{
	 alert("Please Select One Group");
	 document.getElementById("form22").g.focus();
	}
	else if (document.getElementById('sv').value == "Select One Volunteer") 
	{
	 alert("Please Select One Volunteer");
	 document.getElementById("form22").g.focus();
	}
	else 
	{
	 document.getElementById('form22').action = 'allot_volunteer_b.php';
	 document.getElementById('form22').submit();
	}
   }
  </script>
 </head>
 
 <body>
  <form method='post' id="form22" action="" name="form22">
   <div id="wrapper">
	<div id="header">
	 <div id="logo"> <h1><a href="#">NSS Evaluation System</a></h1> </div>
	</div>
	<div id="splash"><img src="img/officerbg.jpg" alt="" title="" style="width:980px; height:340px;" /></div>
	<!-- end #header -->
	
	<div id="page">
	 <div id="page-bgtop">
	  <div id="page-bgbtm">
	   <div id="content">
		<div class="post"> <h2 class="title"><a href="#"> Allot Volunteer(BOYS)</a></h2>
		 <div class="entry" style="line-height:25px;"><br /><br />
		  <label>Group Number</label><br/>
		   <select class='txt' style="width:350px;" id="g" name="g">
			<option value="Select One Group">Select One Group</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			</select><br /><br />
          <label>Volunteers</label><br/>
		   <select class='txt' style="width:350px;" id="sv" name="sv">
		    <option value="Select One Volunteer">Select One Volunteer</option>
	<?php
	 require_once("../connection.php");

     $con = mysqli_connect($servername, $username, $password);
	 mysqli_select_db($con , $db);

     $query ="select volunteerid,concat(fullname, ' [',volunteerid , ']') from volunteerdetails where gender='Male' ;"; 
	 $result= mysqli_query($con, $query);
	 while($row=mysqli_fetch_array($result))
	 {
	  echo "<option value='$row[0]'>$row[1]</option>";
	 }
	?>
	       </select><br /><br />
          <div style="padding-top:15px;">
		   <input type="button" value='Allot' class='btn' onclick='doSubmit();'  style="width:150px;"  />&nbsp;
		   <input type="button" value='Clear' class='btn' onclick='doClear();'  style="width:150px;"  />
		  </div>
  		 </div>
		</div>
		<div style="clear: both;">&nbsp;</div>
	   </div>
	   <!-- end #content -->
	   
	   <div id="sidebar">
		<ul><li> <h2> Program Officer Home</h2> <div ></div><br /> </li>
			<li><ul><li><a href="program_officer_home.php">Home</a></li>
					<li><a href="add_teacher.php">Add Teacher</a></li>
					<li><a href="manage_teacher.php">Manage Teacher</a></li>
					<li><a href="allot_volunteer_b.php" style="text-decoration:none;">Allot Volunteer(BOYS)</a></li>								
					<li><a href="allot_volunteer_g.php">Allot Volunteer(GIRLS)</a></li>								
                    <li><a href="add_camp.php">Add Camp</a></li>
					<li><a href="manage_camp.php">Manage Camp</a></li>
					<li><a href="allot_camp_duty.php">Allot Camp Duty</a></li>
					<li><a href="add_event.php">Add Event</a></li>
					<li><a href="program_officer_change_password.php">Change Password</a></li>
					<li><a href="program_officer_update_profile.php">Update Profile</a></li>
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