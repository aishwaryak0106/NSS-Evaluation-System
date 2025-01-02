<?php
 session_start();
 ob_clean();

 if(! (isset($_SESSION['loginid']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'officer') )
 {
  header("location: ../login.php");
 }
  
 if(isset($_GET['id']))
 { 
  include '../connection.php';
        
  $sql = "select campid, title, description, location, fromcampdate, tocampdate, cost, status from camp 
	            where campid = '$_GET[id]' ";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_array($result);
 }
  
 if(isset($_POST['ed']) && $_POST['ed'] != 0)
 {
  include '../connection.php';

  $sql = "select CONVERT(STATUS, int) from camp where campid = '$_POST[po]';";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_array($result);
		
  $r=0;
  if($row[0] == 0) $r =1; else $r = 0;

  $sql = "update camp set status = $r where campid = '$_POST[po]';";
  $result = mysqli_query($link, $sql);
		
  if(mysqli_affected_rows($link) >= 0)
  {
   echo "<script>alert('Camp Status Updated.'); document.location.href = 'manage_camp.php';</script>";
  }
  else
  {
   echo "<script>alert('Error. Please Retry '); document.location.href='manage_camp.php';</script>";
  }
 }
	
 if(isset($_POST['h']) && $_POST['h'] != 0) 
 {
  require_once("../connection.php");

  $con = mysqli_connect($servername, $username, $password);
  mysqli_select_db($con , $db);
	  
  $query ="update  camp set title='$_POST[ctitle]', description='$_POST[desc]', location='$_POST[loc]', 
                            fromcampdate='$_POST[datepicker]', tocampdate='$_POST[datepicker1]', cost='$_POST[cost]' 
			                where campid = '$_POST[po]'; ";
  mysqli_query($con, $query);
  if(mysqli_affected_rows($con) >= 0)
  {
   echo "<script>alert('Camp Details Updated'); document.location.href = 'manage_camp.php';</script>";
  }
  else
  {		
   echo "<script>alert('Error. Please Retry '); document.location.href='edit_camp.php';</script>";
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
	 document.getElementById('form11').action = 'edit_camp.php';
	 document.getElementById('form11').submit();
	}
   }
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
	 alert("Please Enter Title");
	 document.getElementById("form11").ctitle.focus();
	}
	else if (document.getElementById('desc').value == "") 
	{
	 alert("Please Enter Description");
	 document.getElementById("form11").desc.focus();
	}
	else if (document.getElementById('loc').value == "") 
	{
	 alert("Please Enter Location");
	 document.getElementById("form11").loc.focus();
	}
	else if (document.getElementById('datepicker').value == "") 
	{
	 alert("Please Enter From Camp Date");
	 document.getElementById("form11").datepicker.focus();
	}
	else if (document.getElementById('datepicker1').value == "") 
	{
	 alert("Please Enter To Camp Date");
	 document.getElementById("form11").datepicker1.focus();
	}
	else if (document.getElementById('cost').value == "") 
	{
	 alert("Please Enter Cost");
	 document.getElementById("form11").cost.focus();
	}
	else if (isNaN(document.getElementById('cost').value)) 
	{
	 alert("Cost should be a Number");
	 document.getElementById("form11").cost.focus();
	}
	else 
	{
	 document.getElementById('h').value = '1';
	 document.getElementById('form11').action = 'edit_camp.php';
	 document.getElementById('form11').submit();
	}
   }
  </script>
 </head>

 <body>
  <form method='post' id="form11" action="#" name="form11">
   <input type='hidden' id='ed' name='ed' value='0' />
   <input type='hidden' id='h' name='h' value='0' />
   <input type='hidden' id='po' name='po' value ='<?php if(isset($row)) echo $row[0]; else echo ""; ?>'/>
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
	   <div class="post"> <h2 class="title"><a href="#"> Edit Camp  </a></h2>
		<div class="entry" style="line-height:25px;">
		 <label>Title</label><br />
		  <input type='text' id="ctitle" name="ctitle" autocomplete='off' class='txt' style="width:350px;"  
		         value='<?php if(isset($row)) echo $row[1]; else echo ""; ?>' /> <br />
		 <label>Description</label><br />
		  <textarea id='desc' name='desc' autocomplete='off' class='txt' style="width:350px;">
		   <?php if(isset($row)) echo $row[2]; else echo ""; ?>
		  </textarea> <br />
		 <label>Location</label><br />
		  <input type='text' id="loc" name="loc" autocomplete='off' class='txt' style="width:350px;"  
		         value='<?php if(isset($row)) echo $row[3]; else echo ""; ?>' /> <br />
		  <script src = "../js/jquery-ui.js"> </script>
	  	 <label>From Camp Date</label><br />
		  <input type='text' id='datepicker' name='datepicker' autocomplete='off' class='txt' maxlength='50' style="width:350px;"
		         value='<?php if(isset($row)) echo $row[4]; else echo ""; ?>' /> <br />
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
		  <input type='text' id='datepicker1' name='datepicker1' autocomplete='off' class='txt' maxlength='50' style="width:350px;"
		         value='<?php if(isset($row)) echo $row[5]; else echo ""; ?>' /> <br />
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
          <input type='text' id="cost" name="cost" autocomplete='off' class='txt' maxlength='50' style="width:350px;" 
		   	     value='<?php if(isset($row)) echo $row[6]; else echo ""; ?>' /> <br />
		 <div style="padding-top:15px;">
		  <input type="button" value='Edit' class='btn' onclick='doSubmit();'  style="width:150px;"  />
		  <input type="button" value='Disable / Enable' class='btn' onclick='changeStatus();'  style="width:200px;"  />
		  <input type="button" value='Clear' class='btn' onclick='doClear();'  style="width:150px;"  />
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
                   <li><a href="add_camp.php">Add Camp</a></li>
				   <li><a href="manage_camp.php" style="text-decoration:none;">Manage Camp</a></li>
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