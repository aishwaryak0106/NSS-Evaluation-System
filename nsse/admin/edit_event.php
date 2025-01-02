<?php

 session_start();
 ob_clean();

 if(! (isset($_SESSION['loginid']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'admin') )
 {
  header("location: ../login.php");
 }
  
 include '../connection.php';
 $sql = "select eventid,title,news,addeddate, image from events where eventid = '$_GET[id]'; ";
 $result = mysqli_query($link, $sql);
 $row = mysqli_fetch_array($result);
 	
 if(isset($_POST['h']) && $_POST['h'] != '1') 
 {
  require_once("../connection.php");
  $con = mysqli_connect($servername, $username, $password);
  mysqli_select_db($con , $db);

  $query ="update events set title='$_POST[et]', news='$_POST[nw]', addeddate='$_POST[datepicker]', image='$_POST[image]' where eventid = '$_POST[po]'; ";
  mysqli_query($con, $query);
      
  if(mysqli_affected_rows($con) >= 0)
  {
   echo "<script>alert('Event Details Updated'); document.location.href = 'manage_event.php';</script>";
  }
  else
  {		
   echo "<script>alert('Error. Please Retry '); document.location.href='manage_event.php';</script>";
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
  <script src = "../js/jquery-ui.js"> </script>
  <script type="text/javascript">
   function validateImage() 
   {
	var formData = new FormData();
	var file = document.getElementById("image").files[0];
	formData.append("Filedata", file);
	var t = file.type.split('/').pop().toLowerCase();
	if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") 
	{
  	 alert('Please select a valid image file');
	 document.getElementById("form10").image.focus();
	 document.getElementById("image").value = '';
	 return false;
	}
	if (file.size > 1024000 )
	{
	 alert('Maximum Upload size is 1MB only');
	 document.getElementById("form10").image.focus();
	 document.getElementById("image").value = '';
	 return false;
	}
	return true;
   }
  </script>
  
  <script type="text/javascript">
   function doAdd()
   {
    if(document.getElementById('et').value == "")
    {
     alert("Please Enter Event Title");
	 document.getElementById("form10").et.focus();
    }
	else if (document.getElementById('nw').value == "") 
	{
	 alert("Please Enter Event Details");
	 document.getElementById("form10").nw.focus();
	}
    else if (document.getElementById('datepicker').value == "") 
	{
	 alert("Please Select Date");
	 document.getElementById("form10").datepicker.focus();
	}
    else if(document.getElementById('image').value == "")
    {
     alert("Please Upload Event Image");
	 document.getElementById("form10").image.focus();
    }
    else
    {
     document.getElementById('form10').action = 'edit_event.php';
	 document.getElementById('form10').submit();
	}
   }
   function doClear() 
   {
    document.getElementById('et').value = "";
	document.getElementById('nw').value = "";
    document.getElementById('datepicker').value = "";
    document.getElementById('image').value = "";
   }
 </script>
 </head>

 <body>
  <form method='post' id="form10" action="#" name="form10" >
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
		<div class="post"> <h2 class="title"><a href="#"> Edit Event</a></h2>
   	     <div class="entry" style="line-height:25px;">
		  <label>Event Title</label><br />
		   <input type='text' id="et" name="et" autocomplete='off' class='txt'  style="width:350px;"
			      value='<?php if(isset($row)) echo $row[1]; else echo ""; ?>' /> <br />
		  <label>Event News</label><br />
		   <textarea id='nw' name='nw' autocomplete='off' class='txt' style="width:350px;">
			<?php if(isset($row)) echo $row[2]; else echo ""; ?>
		   </textarea> <br />
		  <label>Date</label><br />
		   <input type='text' id="datepicker" name='datepicker' autocomplete='off' class='txt' style="width:350px;"
                  value='<?php if(isset($row)) echo $row[3]; else echo ""; ?>' /> <br />
		  <label>Image</label> <br />
		   <input type="file" value="" name="image" id="image" onchange="validateImage()"
			      value='<?php if(isset($row)) echo $row[4]; else echo ""; ?>' />
		  <div style="padding-top:15px;">
		   <input type="button" value='Edit' class='btn' onclick='doAdd();'  style="width:150px;"  />
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
					<li><a href="manage_meeting.php">Manage Meetings</a></li>
					<li><a href="allot_mark.php">Allot Mark</a></li>
					<li><a href="manage_event.php" style="text-decoration:none;">Manage Event</a></li>
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
   <script>
	var d = new Date(90,0,1);
	$(function() 
	{
	  $( "#datepicker" ).datepicker({
	    defaultDate:d, //set the default date to Jan 1st 1990
	    changeMonth: true,
	    changeYear: true,
	    yearRange: '2000:2020', //set the range of years
	    dateFormat: 'dd-mm-yy' //set the format of the date
	   });
	});
   </script>
  </form>
 </body>
</html>
  