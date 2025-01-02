<?php
 session_start();

 if(! (isset($_SESSION['loginid']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'officer') )
 {
  header("location: ../login.php");
 }
 include '../connection.php';
            
 $sql = "select username from login where loginid ='$_SESSION[loginid]'and status=1;";
 $result = mysqli_query($link, $sql);
 $row = mysqli_fetch_array($result);

 if(isset($_POST['tun']) && $_POST['tun'] != "")
 {
  $con = mysqli_connect($servername, $username, $password);
  mysqli_select_db($con , $db);

  $query ="update login set password = '$_POST[tpw]' where loginid = '$_SESSION[loginid]' ;";
  mysqli_query($con, $query);
		
  if(mysqli_affected_rows($con) >= 0)
  {
   echo "<script>alert('Password Updated'); document.location.href='program_officer_home.php';</script>";
  }
  else
  {
   echo "<script>alert('Error. Please Retry'); document.location.href = 'program_officer_change_password.php';</script>";
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
	document.getElementById('tpw').value = "";
	document.getElementById('cpw').value = "";
   }
   function doLogin() 
   {
	if (document.getElementById('tpw').value == "") 
	{
	 alert("Please Enter Password");
	 document.getElementById("form28").tpw.focus();
	}
	else if (document.getElementById('tpw').value.length <4) 
	{
	 alert("Password is too short");
	 document.getElementById("form28").tpw.focus();
	}
	else if (document.getElementById('tpw').value.length >=15) 
	{
	 alert("Password is long");
	 document.getElementById("form28").tpw.focus();
	}
	else if (document.getElementById('cpw').value == "") 
	{
	 alert("Please Confirm Your Password");
	 document.getElementById("form28").cpw.focus();
	}
	else if (document.getElementById('tpw').value != document.getElementById('cpw').value) 
	{
	 alert("Passwords Should Match");
	 document.getElementById("form28").cpw.focus();
	}
	else 
	{
	 document.getElementById('form28').action = 'program_officer_change_password.php';
	 document.getElementById('form28').submit();
	}
   }
  </script>
 </head>
 
 <body>
  <form method='post' id="form28" action="" name="form28">
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
	   <div class="post"> <h2 class="title"><a href="#"> Change Officer Password </a></h2>
		<div class="entry" style="line-height:25px;">
		 <label>UserName</label><br />
		  <input type='text' id='tun' name='tun' autocomplete='off' class='txt' style="width:350px;"
		    	 value="<?php if(isset($row[0])) echo $row[0]; else echo '';  ?>"  readonly /> <br />
		 <label>New Password</label><br />
		  <input type='password' id='tpw' name='tpw'  class='txt' style="width:350px;" /> <br />
		 <label>Confirm Password</label><br />
		  <input type='password' id='cpw' name='cpw'  class='txt' style="width:350px;" /> <br />
		 <div style="padding-top:15px;"><br />&nbsp;&nbsp;&nbsp;&nbsp;
		  <input type="button" value='Change' class='btn' onclick='doLogin();'  style="width:150px;"  />&nbsp;
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
				   <li><a href="add_teacher.php">Add Teacher</a></li>
				   <li><a href="manage_teacher.php">Manage Teacher</a></li>
				   <li><a href="allot_volunteer_b.php">Allot Volunteer(BOYS)</a></li>								
				   <li><a href="allot_volunteer_g.php">Allot Volunteer(GIRLS)</a></li>								
                   <li><a href="add_camp.php">Add Camp</a></li>
				   <li><a href="manage_camp.php">Manage Camp</a></li>
				   <li><a href="allot_camp_duty.php">Allot Camp Duty</a></li>
				   <li><a href="add_event.php">Add Event</a></li>
				   <li><a href="program_officer_change_password.php" style="text-decoration:none;">Change Password</a></li>
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