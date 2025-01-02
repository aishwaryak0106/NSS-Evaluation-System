<?php
 session_start();

 if(! (isset($_SESSION['loginid']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'teacher') )
 {
  header("location: ../login.php");
 }

 include '../connection.php';
             
 $sql = "select username, emailid, mobile, fullname, designation, address from login join teacherdetails
                on login.loginid = teacherdetails.teacherid where loginid ='$_SESSION[loginid]'and status=1;";
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

  $query ="update teacherdetails set fullname = '$_POST[fn]', designation='$_POST[desi]', address='$_POST[a]' where teacherid = '$_SESSION[loginid]' ;";
  mysqli_query($con, $query);

  $ar += mysqli_affected_rows($con);
  if($ar >= 0)
  {
   echo "<script>alert('Teacher Profile Updated'); document.location.href='teacher_home.php';</script>";
  }
  else
  {
   echo "<script>alert('Error. Please Retry'); document.location.href = 'teacher_update_profile.php';</script>";
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
	document.getElementById('desi').value = "";
	document.getElementById('a').value = "";
   }

   var emailreg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

   function doLogin() 
   {
	if (document.getElementById('loid').value == "") 
	{
	 alert("Please Enter Email ID");
	 document.getElementById("form39").loid.focus();
	}
	else if(emailreg.test(document.getElementById('loid').value) == false)
	{
	 alert("Invalid Email ID");
	 document.getElementById("form39").loid.focus();
	}
	else if (document.getElementById('mob').value == "") 
	{
	 alert("Please Enter Mobile Number");
	 document.getElementById("form39").mob.focus();
	}
	else if (isNaN(document.getElementById('mob').value)) 
	{
	 alert("Mobile Number Should be a Number");
	 document.getElementById("form39").mob.focus();
	}
	else if (document.getElementById('mob').value.length != 10) 
	{
	 alert("Invalid Mobile Number");
	 document.getElementById("form39").mob.focus();
	}
	else if (document.getElementById('fn').value == "") 
	{
	 alert("Please Enter Your Fullname");
	 document.getElementById("form39").fn.focus();
	}
	else if( /[^a-zA-Z]/.test(document.getElementById('fn').value))
	{
	 alert("Fullname is not alphanumeric");
	 document.getElementById("form39").fn.focus();
	}
	else if (document.getElementById('desi').value == "") 
	{
	 alert("Please Enter Designation");
	 document.getElementById("form39").desi.focus();
	}
	else if (document.getElementById('a').value == "") 
	{
	 alert("Please Enter Address");
	 document.getElementById("form39").a.focus();
	}
	else 
	{
	 document.getElementById('form39').action = 'teacher_update_profile.php';
	 document.getElementById('form39').submit();
	}
   }
  </script>
 </head>

 <body>
  <form method='post' id="form39" action="" name="form39">
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
		<div class="post"> <h2 class="title"><a href="#"> Update Teacher Profile</a></h2>
		 <div class="entry" style="line-height:25px;">
		  <label>UserName</label><br />
		   <input type='text' id='tun' name='tun' autocomplete='off' class='txt' maxlength='14' style="width:350px;"
		     	  value = '<?php  if(isset($row)) echo $row[0]; else echo ""; ?>' readonly /> <br />
		  <label>Email ID</label><br />
		   <input type='text' id='loid' name='loid' autocomplete='off' class='txt' maxlength='14' style="width:350px;" 
				  value = '<?php  if(isset($row)) echo $row[1]; else echo ""; ?>' /> <br />
		  <label>Mobile</label><br />
		   <input type='text' id='mob' name='mob' autocomplete='off' class='txt' maxlength='14' style="width:350px;" 
				  value = '<?php  if(isset($row)) echo $row[2]; else echo ""; ?>' /> <br />
		  <label>Full Name</label><br />
		   <input type='text' id='fn' name='fn' autocomplete='off' class='txt' maxlength='50' style="width:350px;"
				  value = '<?php  if(isset($row)) echo $row[3]; else echo ""; ?>' /> <br />
		  <label>Designation</label><br />
		   <input type='text' id='desi' name='desi' autocomplete='off' class='txt' maxlength='14' style="width:350px;"
                  value = '<?php  if(isset($row)) echo $row[4]; else echo ""; ?>'/> <br />
		  <label>Address</label><br />
		   <textarea id='a' name='a' autocomplete='off' class='txt' maxlength='175' style="width:350px;" ><?php  if(isset($row)) echo $row[5]; else echo ""; ?></textarea> <br />
		  <div style="padding-top:15px;">&nbsp;&nbsp;&nbsp;&nbsp;
		   <input type="button" value='Change' class='btn' onclick='doLogin();'  style="width:150px;"  />&nbsp;
		   <input type="button" value='Clear' class='btn' onclick='doClear();'  style="width:150px;"  />
		  </div>
		 </div>
		</div>
		<div style="clear: both;">&nbsp;</div>
	   </div>
	   <!-- end #content -->
	   <div id="sidebar">
		<ul><li> <h2> Teacher Home</h2> <div ></div><br /> </li>
			<li><ul><li><a href="teacher_home.php">Home</a></li>
					<li><a href="view_meetings.php">View Meetings</a></li>
					<li><a href="manage_volunteer.php">Manage Volunteer</a></li>
                    <li><a href="allot_duty.php">Allot duty</a></li>
					<li><a href="allot_charity.php">Allot Charity</a></li>
					<li><a href="charity_list.php">Charity List</a></li>
					<li><a href="teacher_change_password.php">Change Password</a></li>
					<li><a href="teacher_update_profile.php" style="text-decoration:none;">Update Profile</a></li>
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
  </form>
 </body>
</html>