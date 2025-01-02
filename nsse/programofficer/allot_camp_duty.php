<?php
 session_start();

 if(! (isset($_SESSION['loginid']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'officer') )
 {
  header("location: ../login.php");
 }
 if(isset($_POST['duty']) && $_POST['duty'] != "")
 {
  require_once("../connection.php");

  $con = mysqli_connect($servername, $username, $password);
  mysqli_select_db($con , $db);
		
  $query ="insert into campduty (campid, duty, description, dutydate, marks, groupid) 
	              values ('$_POST[c]', '$_POST[duty]', '$_POST[desc]', '$_POST[datepicker]', '$_POST[mk]', '$_POST[g]' ); ";
  mysqli_query($con, $query);
		
  $rows = 0;
  $rows += mysqli_affected_rows($con);

  if($rows == 1)
  {
   echo "<script>alert('Camp Duty Added.'); document.location.href = 'program_officer_home.php';</script>";
  }
  else
  {
   echo "<script>alert('Error. Please Retry '); document.location.href='allot_camp_duty.php';</script>";
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
  <link href = "../css/jquery-ui.css" rel = "stylesheet">

  <script src = "../js/jquery-1.10.2.js"> </script>  
  <script src = "../js/jquery-ui.js"></script>
  <script type="text/javascript">
   function doClear() 
   {
	document.getElementById('c').value = "Select One Camp"; 
	document.getElementById('duty').value = "";
	document.getElementById('desc').value = "";
	document.getElementById('datepicker').value = "";
	document.getElementById('mk').value = "";
   }
   function doSubmit() 
   {
	if (document.getElementById('c').value == "Select One Camp") 
	{
	 alert("Please Select One Camp");
	 document.getElementById("form21").c.focus();
	}
	else if (document.getElementById('duty').value == "")  
	{
	 alert("Please Enter Duty for Volunteers");
	 document.getElementById("form21").duty.focus();
	}
	else if (document.getElementById('desc').value == "") 
	{
	 alert("Please Enter Duty Details");
	 document.getElementById("form21").desc.focus();
	}
	else if (document.getElementById('datepicker').value == "") 
	{
	 alert("Please Enter Duty Date");
	 document.getElementById("form21").datepicker.focus();
	}
	else 
	{
	 document.getElementById('form21').action = 'allot_camp_duty.php';
	 document.getElementById('form21').submit();
	}
   }
  </script>
 </head>
 
 <body>
  <form method='post' id="form21" action="" name="form21">
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
	   <div class="post"> <h2 class="title"><a href="#"> Allot Camp Duty</a></h2>
		<div class="entry" style="line-height:25px;">
		 <label>Camp</label><br />
	      <select class='txt' style="width:350px;" id="c" name="c">
		   <option value="Select One Camp">Select One Camp</option>
	<?php
	 require_once("../connection.php");

     $con = mysqli_connect($servername, $username, $password);
	 mysqli_select_db($con , $db);

     $query ="select campid,concat(title, ' [',campid , ']') from camp ;"; 
	 $result= mysqli_query($con, $query);
	 while($row=mysqli_fetch_array($result))
	 {
	  echo "<option value='$row[0]'>$row[1]</option>";
	 }
	?>
	      </select><br /><br />
         <label>Duty</label><br />
		  <input type='text' id="duty" name="duty" autocomplete='off' class='txt' style="width:350px;" /> <br />
		 <label>Description</label><br />
		  <input type='text' id="desc" name="desc" autocomplete='off' class='txt' style="width:350px;" /> <br />
		 <label>Duty Date</label><br />
		  <input type='text' id="datepicker" name="datepicker" autocomplete='off' class='txt' style="width:350px;" /> <br />
		 <label>Mark</label><br />
		  <input type='text' id="mk" name="mk" autocomplete='off' class='txt' style="width:350px;" /> <br />
		 <label>Group</label><br />
		  <select class='txt' style="width:350px;" id="g" name="g">
		   <option value="Select One Camp">Select One Group</option>
	<?php
	 require_once("../connection.php");

     $con = mysqli_connect($servername, $username, $password);
	 mysqli_select_db($con , $db);

     $query ="select distinct groupid from groups ;"; 
	 $result= mysqli_query($con, $query);
	 while($row=mysqli_fetch_array($result))
	 {
	  echo "<option value='$row[0]'>$row[0]</option>";
	 }
	?>
	      </select><br /><br />
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
	   <ul><li>	<h2> Program Officer Home</h2> <div ></div><br /> </li>
		   <li><ul><li><a href="program_officer_home.php">Home</a></li>
				   <li><a href="add_teacher.php">Add Teacher</a></li>
				   <li><a href="manage_teacher.php">Manage Teacher</a></li>
				   <li><a href="allot_volunteer_b.php">Allot Volunteer(BOYS)</a></li>								
				   <li><a href="allot_volunteer_g.php" >Allot Volunteer(GIRLS)</a></li>								
                   <li><a href="add_camp.php">Add Camp</a></li>
				   <li><a href="manage_camp.php">Manage Camp</a></li>
				   <li><a href="allot_camp_duty.php" style="text-decoration:none;">Allot Camp Duty</a></li>
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
   <script>
	var d = new Date(90,0,1);
	$(function() 
	{
	  $( "#datepicker" ).datepicker({
	  defaultDate:d, //set the default date to Jan 1st 1990
	  changeMonth: true,
	  changeYear: true,
	  yearRange: '2000:2020', //set the range of years
	  dateFormat: 'yy-mm-dd' //set the format of the date
	  });
	});
   </script>
  </form>
 </body>
</html>