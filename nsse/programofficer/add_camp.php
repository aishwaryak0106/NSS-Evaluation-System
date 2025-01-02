<?php

 if(isset($_POST['ctitle']) && $_POST['ctitle'] != "")
 {
  require_once("../connection.php");

  $con = mysqli_connect($servername, $username, $password);
  mysqli_select_db($con , $db);

  $query ="insert into camp (title, description, location, fromcampdate, tocampdate, cost, status) 
		          values ('$_POST[ctitle]', '$_POST[desc]', '$_POST[loc]', '$_POST[datepicker]', '$_POST[datepicker1]', '$_POST[cost]', 0); ";
  mysqli_query($con, $query);
		
  $rows = 0;
  $rows += mysqli_affected_rows($con);

  if($rows == 1)
  {
   echo "<script>alert('Camp Fixed. Please Check After Approval'); document.location.href = 'program_officer_home.php';</script>";
  }
  else
  {
   echo "<script>alert('Error. Please Retry '); document.location.href='add_camp.php';</script>";
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

  <script src = "../js/jquery-1.10.2.js"> </script>
  <script type="text/javascript">
   function doClear() 
   {
	document.getElementById('ctitle').value = "";
	document.getElementById('desc').value = "";
	document.getElementById('loc').value = "";
	document.getElementById('datepicker').value = "";
	document.getElementById('datepicker1').value = "";
	document.getElementById('cost').value = "";
   }
   function doSubmit() 
   {
	if (document.getElementById('ctitle').value == "") 
	{
	 alert("Please Enter Camp Title");
	 document.getElementById("form17").ctitle.focus();
	}
	else if (document.getElementById('desc').value == "") 
	{
	 alert("Please Enter Description");
	 document.getElementById("form17").desc.focus();
	}
	else if (document.getElementById('loc').value == "") 
	{
	 alert("Please Enter Location");
	 document.getElementById("form17").loc.focus();
	}
	else if (document.getElementById('datepicker').value == "") 
	{
	 alert("Please Enter Starting Date of Camp");
	 document.getElementById("form17").datepicker.focus();
	}
	else if (document.getElementById('datepicker1').value == "") 
	{
	 alert("Please Enter Ending Date of Camp");
	 document.getElementById("form17").datepicker1.focus();
	}
	else if (document.getElementById('cost').value == "") 
	{
	 alert("Please Enter Cost of Camp");
	 document.getElementById("form17").cost.focus();
	}
	else 
	{
	 document.getElementById('form17').action = 'add_camp.php';
	 document.getElementById('form17').submit();
	}
   }
  </script>
 </head>
 
 <body>
  <form method='post' id="form17" action="" name="form17">
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
		<div class="post"> <h2 class="title"><a href="#"> Add Camp </a></h2>
		 <div class="entry" style="line-height:25px;">
		  <label>Camp Title</label><br />
		   <input type='text' id="ctitle" name="ctitle" autocomplete='off' class='txt' style="width:350px;" /> <br />
		  <label>Description</label><br />
		   <textarea id='desc' name='desc' autocomplete='off' class='txt' style="width:350px;"></textarea> <br />
		  <label>Location</label><br />    
           <input type='text' id="loc" name="loc" autocomplete='off' class='txt' maxlength='50' style="width:350px;" /> <br />
           
		   <link href = "../css/jquery-ui.css" rel = "stylesheet">
		   <script src = "../js/jquery-ui.js"> </script>
 	      <label>From Camp Date</label><br />
		   <input type='text' id='datepicker' name='datepicker' autocomplete='off' class='txt' maxlength='50' style="width:350px;"/> <br />
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
		   
		   <link href = "../css/jquery-uii.css" rel = "stylesheet">
           <script src = "../js/jquery-uii.js"> </script>
	      <label>To Camp Date</label><br />
		   <input type='text' id='datepicker1' name='datepicker1' autocomplete='off' class='txt' maxlength='50' style="width:350px;"/> <br />
		   <script>
			var d = new Date(90,0,1);
			$(function() 
			{
			  $( "#datepicker1" ).datepicker1({
			  defaultDate:d, //set the default date to Jan 1st 1990
			  changeMonth: true,
			  changeYear: true,
			  yearRange: '2000:2020', //set the range of years
			  dateFormat: 'yy-mm-dd' //set the format of the date
			  });
			});
		   </script>
		  <label>Cost</label><br />    
           <input type='text' id="cost" name="cost" autocomplete='off' class='txt' maxlength='50' style="width:350px;" /> <br />
          <div style="padding-top:15px;">&nbsp;&nbsp;&nbsp;&nbsp;
		   <input type="button" value='Add' class='btn' onclick='doSubmit();'  style="width:100px;"  />&nbsp;
		   <input type="button" value='Clear' class='btn' onclick='doClear();'  style="width:100px;"  />
		  </div> <br /> <br />
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
					<li><a href="allot_volunteer_b.php">Allot Volunteer(BOYS)</a></li>								
					<li><a href="allot_volunteer_g.php">Allot Volunteer(GIRLS)</a></li>								
                    <li><a href="add_camp.php" style="text-decoration:none;">Add Camp</a></li>
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