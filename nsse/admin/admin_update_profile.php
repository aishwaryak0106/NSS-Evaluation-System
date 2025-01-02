<?php

 session_start();

 if(! (isset($_SESSION['loginid']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'admin') )
 {
  header("location: ../login.php");
 }

 include '../connection.php';
 $sql = "select username, emailid, mobile, fullname, address from login join admindetails
                on login.loginid = admindetails.adminid where loginid ='$_SESSION[loginid]' and status=1;";
 $result = mysqli_query($link, $sql);
 $row = mysqli_fetch_array($result);

 if(isset($_POST['tun']) && $_POST['tun'] != "")
 {
  $con = mysqli_connect($servername, $username, $password);
  mysqli_select_db($con , $db);

  $query ="update login set emailid = '$_POST[loid]', mobile='$_POST[mob]' where loginid = '$_SESSION[loginid]' ;";
  mysqli_query($con, $query);
	
  $ar = 0;
  $ar += mysqli_affected_rows($con);

  $query ="update admindetails set fullname = '$_POST[fn]',  address='$_POST[a]' where adminid = '$_SESSION[loginid]' ;";
  mysqli_query($con, $query);
	
  $ar += mysqli_affected_rows($con);
  if($ar >= 0)
  {
   echo "<script>alert('Admin Profile Updated'); document.location.href='admin_home.php';</script>";
  }
  else
  {
   echo "<script>alert('Error. Please Retry'); document.location.href = 'admin_update_profile.php';</script>";
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
	document.getElementById('loid').value = "";
	document.getElementById('mob').value = "";
	document.getElementById('fn').value = "";
	document.getElementById('a').value = "";
   }
	
   var emailreg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

   function doLogin() 
   {
	if (document.getElementById('loid').value == "") 
	{
	 alert("Please Enter Email ID");
	 document.getElementById("form8").loid.focus();
	}
	else if(emailreg.test(document.getElementById('loid').value) == false)
	{
	 alert("Invalid Email ID");
	 document.getElementById("form8").loid.focus();
	}
	else if (document.getElementById('mob').value == "") 
	{
	 alert("Please Enter Mobile Number");
	 document.getElementById("form8").mob.focus();
	}
	else if (isNaN(document.getElementById('mob').value)) 
	{
	 alert("Mobile Number Should be a Number");
	 document.getElementById("form8").mob.focus();
	}
	else if (document.getElementById('mob').value.length != 10) 
	{
	 alert("Invalid Mobile Number");
	 document.getElementById("form8").mob.focus();
	}
	else if (document.getElementById('fn').value == "") 
	{
	 alert("Please Enter Your Fullname");
	 document.getElementById("form8").fn.focus();
	}
	else if( /[^a-zA-Z]/.test(document.getElementById('fn').value))
	{
	 alert("Fullname is not alphanumeric");
	 document.getElementById("form8").n.focus();
	}
	else if (document.getElementById('a').value == "") 
	{
	 alert("Please Enter Address");
	 document.getElementById("form8").a.focus();
	}
	else 
	{
	 document.getElementById('form8').action = 'admin_update_profile.php';
	 document.getElementById('form8').submit();
	}
   }
  </script>
 </head>
 
 <body>
  <form method='post' id="form8" action="" name="form8">
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
		<div class="post"> <h2 class="title"><a href="#"> Change Admin Profile</a></h2>
		 <div class="entry" style="line-height:25px;">
		  <label>UserName</label><br />
		   <input type='text' id='tun' name='tun' autocomplete='off' class='txt' style="width:350px;"
			      value = '<?php  if(isset($row)) echo $row[0]; else echo ""; ?>' readonly /> <br />
		  <label>Email ID</label><br />
		   <input type='text' id='loid' name='loid' autocomplete='off' class='txt' style="width:350px;" 
			      value = '<?php  if(isset($row)) echo $row[1]; else echo ""; ?>' /> <br />
		  <label>Mobile</label><br />
		   <input type='text' id='mob' name='mob' autocomplete='off' class='txt' style="width:350px;" 
			      value = '<?php  if(isset($row)) echo $row[2]; else echo ""; ?>' /> <br />
		  <label>Full Name</label><br /> 
		   <input type='text' id='fn' name='fn' autocomplete='off' class='txt' style="width:350px;"
			      value = '<?php  if(isset($row)) echo $row[3]; else echo ""; ?>' /> <br />
		  <label>Address</label><br />
		   <textarea id='a' name='a' autocomplete='off' class='txt' style="width:350px;">
			<?php  if(isset($row)) echo $row[4]; else echo ""; ?>
		   </textarea> <br />
		  <div style="padding-top:15px;">&nbsp;&nbsp;&nbsp;&nbsp;
		   <input type="button" value='Change' class='btn' onclick='doLogin();'  style="width:150px;"  />&nbsp;
		   <input type="button" value='Clear' class='btn' onclick='doClear();'  style="width:150px;"  />
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
				    <li><a href="allot_mark.php">Allot Mark</a></li>
				    <li><a href="manage_event.php">Manage Event</a></li>
				    <li><a href="view_common_feedback.php">View Common Feedback</a></li>
				    <li><a href="admin_change_password.php">Change Password</a></li>
				    <li><a href="admin_update_profile.php" style="text-decoration:none;">Update Profile</a></li>
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