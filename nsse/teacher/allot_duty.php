<?php
 session_start();

 if(! (isset($_SESSION['loginid']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'teacher') )
 {
  header("location: ../login.php");
 }
  
 if(isset($_POST['datepicker']) && $_POST['datepicker'] != "")
 {
  require_once("../connection.php");
  $con = mysqli_connect($servername, $username, $password);
  mysqli_select_db($con , $db);
    
  //2019-12-01 13:28:00.000
  $dtm = $_POST['hr'] . ':' . $_POST['min'];
	
  $query ="insert into dutyallotment (dutydate, dutytime, dutytype, groupid) 
                  values ('$_POST[datepicker]', '$dtm', '$_POST[dt]', '$_POST[g]'); ";
  mysqli_query($con, $query);
	
  $rows = 0;
  $rows += mysqli_affected_rows($con);
	
  if($rows == 1)
  {
   echo "<script>alert('Duty Fixed'); document.location.href = 'teacher_home.php';</script>";
  }
  else
  {		
   echo "<script>alert('Error. Please Retry '); document.location.href='teacher_home.php';</script>";
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
	document.getElementById('datepicker').value = "";
	document.getElementById('hr').value = "Hour";
    document.getElementById('min').value = "Minute";
    document.getElementById('dt').value = "";
   }
   function doSubmit() 
   {
	if (document.getElementById('datepicker').value == "") 
	{
	 alert("Please Enter Duty Date");
	 document.getElementById("form32").datepicker.focus();
	}
	else if (document.getElementById('hr').value == "Hour") 
	{
	 alert("Please Select Time");
	 document.getElementById("form32").hr.focus();
	}
	else if (document.getElementById('min').value == "Minute") 
	{
	 alert("Invalid Time");
	 document.getElementById("form32").min.focus();
	}
    else if (document.getElementById('dt').value == "") 
	{
	 alert("Please Enter Duty Type");
	 document.getElementById("form32").dt.focus();
	}
	else 
	{
	 document.getElementById('form32').action = 'allot_duty.php';
	 document.getElementById('form32').submit();
	}
   }
  </script>
 </head>
 
 <body>
  <form method='post' id="form32" action="" name="form32">
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
		<div class="post"> <h2 class="title"><a href="#"> Allot Duty</a></h2>
		 <div class="entry" style="line-height:25px;"></div>
         <label>Duty Date</label><br />
		  <input type='text' id="datepicker" name="datepicker" autocomplete='off' class='txt' style="width:350px;" /> <br /><br />
		 <label>Duty Time</label><br />   
          <select name="hr" id="hr" style="width:175px;" class='txt'>
		   <option value='Hour'>Hour</option>
	<?php
	 for($i=00;$i<=23;$i++)
	 {
	  echo "<option value='$i'>$i</value>";
	 }
	?>
	      </select>
		  <select name="min" id="min" style="width:175px;" class='txt'>
		   <option value='Minute'>Minute</option>
		   <option value='00'>00</option>
		   <option value='15'>15</option>
		   <option value='30'>30</option>
		   <option value='45'>45</option>
		  </select><br /><br />
		  <label>Duty Type</label><br />
		   <input type='text' id="dt" name="dt" autocomplete='off' class='txt' style="width:350px;" /> <br /><br />
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
		  </div><div style="clear: both;">&nbsp;</div>
		 </div>
		 <!-- end #content -->
		 
		 <div id="sidebar">
		  <ul><li> <h2> Teacher Home</h2> <div ></div><br /> </li>
		      <li><ul><li><a href="teacher_home.php">Home</a></li>
					  <li><a href="view_meetings.php">View Meetings</a></li>
					  <li><a href="manage_volunteer.php">Manage Volunteer</a></li>
                      <li><a href="allot_duty.php" style="text-decoration:none;">Allot duty</a></li>
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
		 Designed by Aishwarya.K Chandana.P Nivya.R Swaralaya.M
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