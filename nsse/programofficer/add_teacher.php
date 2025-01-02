<?php

 if(isset($_POST['fn']) && $_POST['fn'] != "")
 {
  require_once("../connection.php");

  $con = mysqli_connect($servername, $username, $password);
  mysqli_select_db($con , $db);

  $query ="insert into login (username, password, usertype, doj, emailid, mobile, status) 
                  values ('$_POST[tun]', '$_POST[tpw]', 'teacher', now(), '$_POST[em]', '$_POST[mob]', 1); ";
  mysqli_query($con, $query);
		
  $rows = 0;
  $rows += mysqli_affected_rows($con);

  $query1 ="insert into teacherdetails (teacherid, fullname, designation , address ) 
	   		       values ( (select max(loginid) from login),  '$_POST[fn]', '$_POST[desi]',  '$_POST[a]' );";
        
  mysqli_query($con, $query1);
  $rows += mysqli_affected_rows($con);

  if($rows == 2)
  {
   echo "<script>alert('Teacher Added '); document.location.href = 'manage_teacher.php';</script>";
  }
  else
  {
   echo "<script>alert('Error. Please Retry '); document.location.href='add_teacher.php';</script>";
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
	document.getElementById('fn').value = "";
	document.getElementById('desi').value = "";
	document.getElementById('a').value = "";
	document.getElementById('tun').value = "";
	document.getElementById('tpw').value = "";
	document.getElementById('cpw').value = "";
	document.getElementById('em').value = "";
	document.getElementById('mob').value = "";
   }

   var emailreg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   var illegalChars = /\W/;//allow letters, numbers, and underscores      

   function doSubmit() 
   {
	if (document.getElementById('fn').value == "") 
	{
	 alert("Please Enter Your Fullname");
	 document.getElementById("form20").fn.focus();
	}
	else if( /[^a-zA-Z]/.test(document.getElementById('fn').value))
	{
	 alert("Fullname is not alphanumeric");
	 document.getElementById("form20").fn.focus();
	}
	else if (document.getElementById('desi').value == "") 
	{
	 alert("Please Enter Designation");
	 document.getElementById("form20").desi.focus();
	}
	else if (document.getElementById('a').value == "") 
	{
	 alert("Please Enter Address");
	 document.getElementById("form20").a.focus();
	}
	else if (document.getElementById('tun').value == "") 
	{
	 alert("Please Enter Username");
	 document.getElementById("form20").tun.focus();
	}
	else if (illegalChars.test(tun.value))
	{
	 alert("Username can accept Alphabets, Numbers, and Underscores only");
	 document.getElementById("form20").tun.focus();
	}
	else if (document.getElementById('tun').value.length <4) 
	{
	 alert("Username is too short");
	 document.getElementById("form20").tun.focus();
	}
	else if (document.getElementById('tun').value.length >=15) 
	{
	 alert("Username is long");
	 document.getElementById("form20").tun.focus();
	}
	else if (document.getElementById('tpw').value == "") 
	{
	 alert("Please Enter Password");
	 document.getElementById("form20").tpw.focus();
	}
	else if (document.getElementById('tpw').value.length <4) 
	{
	 alert("Password is too short");
	 document.getElementById("form20").tpw.focus();
	}
	else if (document.getElementById('tpw').value.length >=15) 
	{
	 alert("Password is long");
	 document.getElementById("form20").tpw.focus();
	}
	else if (document.getElementById('cpw').value == "") 
	{
	 alert("Please Confirm Your Password");
	 document.getElementById("form20").cpw.focus();
	}
	else if (document.getElementById('tpw').value != document.getElementById('cpw').value) 
	{
     alert("Passwords Should Match");
	 document.getElementById("form20").cpw.focus();
	}
	else if (document.getElementById('em').value == "") 
	{
	 alert("Please Enter Email ID");
	 document.getElementById("form20").em.focus();
	}
	else if(emailreg.test(document.getElementById('em').value) == false)
	{
	 alert("Invalid Email ID");
	 document.getElementById("form20").em.focus();
	}
	else if (document.getElementById('mob').value == "") 
	{
	 alert("Please Enter Mobile Number");
	 document.getElementById("form20").em.focus();
	}
	else if (isNaN(document.getElementById('mob').value)) 
	{
	 alert("Mobile Number Should be a Number");
	 document.getElementById("form20").mob.focus();
	}
	else if (document.getElementById('mob').value.length != 10) 
	{
	 alert("Invalid Mobile Number");
	 document.getElementById("form20").mob.focus();
	}
	else 
	{
	 document.getElementById('form20').action = 'add_teacher.php';
	 document.getElementById('form20').submit();
	}
   }
  </script>
 </head>
 
 <body>
  <form method='post' id="form20" action="" name="form20">
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
	   <div class="post"> <h2 class="title"><a href="#"> Add Teacher</a></h2>
		<div class="entry" style="line-height:25px;">
		 <label>Full Name</label><br />
		  <input type='text' id='fn' name='fn' autocomplete='off' class='txt' maxlength='50' style="width:350px;" /> <br />
		 <label>Designation</label><br />
		  <input type='text' id='desi' name='desi' autocomplete='off' class='txt' maxlength='50' style="width:350px;" /> <br />
		 <label>Address</label><br />
		  <textarea id='a' name='a' autocomplete='off' class='txt' maxlength='250' style="width:350px;"></textarea> <br />
		 <label>UserName</label><br />
		  <input type='text' id='tun' name='tun' autocomplete='off' class='txt' maxlength='20' style="width:350px;" /> <br />
		 <label>Password</label><br />
		  <input type='password' id='tpw' name='tpw'  class='txt'  maxlength='14'  style="width:350px;" /> <br />
		 <label>Confirm Password</label><br />
		  <input type='password' id='cpw' name='cpw'  class='txt'  maxlength='14'  style="width:350px;" /> <br />
		 <label>Email ID</label><br />
		  <input type='text' id='em' name='em' autocomplete='off' class='txt' maxlength='30' style="width:350px;" /> <br />
		 <label>Mobile</label><br />
		  <input type='text' id='mob' name='mob' autocomplete='off' class='txt' maxlength='14' style="width:350px;" /> <br />
		 <div style="padding-top:15px;">
		  <input type="button" value='Add' class='btn' onclick='doSubmit();'  style="width:150px;"  />&nbsp;
		  <input type="button" value='Clear' class='btn' onclick='doClear();'  style="width:150px;"  />
		 </div><br /> <br />
		</div>
  	   </div>
	   <div style="clear: both;">&nbsp;</div>
	  </div>
	  <!-- end #content -->
	  
	  <div id="sidebar">
	   <ul><li> <h2> Program Officer Home</h2> <div ></div><br /> </li>
		   <li><ul><li><a href="program_officer_home.php">Home</a></li>
				   <li><a href="add_teacher.php" style="text-decoration:none;">Add Teacher</a></li>
				   <li><a href="manage_teacher.php">Manage Teacher</a></li>
				   <li><a href="allot_volunteer_b.php">Allot Volunteer(BOYS)</a></li>								
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