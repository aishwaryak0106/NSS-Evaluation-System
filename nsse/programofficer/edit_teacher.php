<?php
 session_start();

 if(! (isset($_SESSION['loginid']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'officer') )
 {
  header("location: ../login.php");
 }

 if(isset($_GET['id']))
 {
  include '../connection.php';
        
  $sql = "select loginid, fullname, address, username, emailid, mobile from teacherdetails 
	       join login on teacherdetails.teacherid = login.loginid where loginid = '$_GET[id]'; ";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_array($result);
 }

 if(isset($_POST['h']) && $_POST['h'] == '1')
 {
  require_once("../connection.php");

  $con = mysqli_connect($servername, $username, $password);
  mysqli_select_db($con , $db);

  $query ="update login set username='$_POST[tun]', emailid = '$_POST[loid]', mobile='$_POST[mob]' where loginid = '$_POST[po]' ;";
  mysqli_query($con, $query);
		
  $rows = 0;
  $rows += mysqli_affected_rows($con);
	
  $query ="update teacherdetails set fullname = '$_POST[fn]', address='$_POST[a]' where teacherid = '$_POST[po]' ;";
  mysqli_query($con, $query);
	
  $rows += mysqli_affected_rows($con);
	
  if($rows >= 0)
  {
   echo "<script>alert('Teacher Details Updated.'); document.location.href = 'manage_teacher.php';</script>";
  }
  else
  {
   echo "<script>alert('Error. Please Retry '); document.location.href='program_officer_home.php';</script>";
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
	document.getElementById('a').value = "";
	document.getElementById('tun').value = "";
	document.getElementById('loid').value = "";
	document.getElementById('mob').value = "";
   }
   
   var emailreg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   var illegalChars = /\W/;//allow letters, numbers, and underscores      

   function doSubmit() 
   {
	if (document.getElementById('fn').value == "") 
	{
	 alert("Please Enter Your Fullname");
	 document.getElementById("form24").fn.focus();
	}
	else if( /[^a-zA-Z]/.test(document.getElementById('fn').value))
	{
	 alert("Fullname is not alphanumeric");
	 document.getElementById("form24").fn.focus();
	}
	else if (document.getElementById('a').value == "") 
	{
	 alert("Please Enter Address");
	 document.getElementById("form24").a.focus();
	}
	else if (document.getElementById('tun').value == "") 
	{
	 alert("Please Enter Username");
	 document.getElementById("form24").tun.focus();
	}
	else if (illegalChars.test(tun.value))
	{
	 alert("Username can accept Alphabets, Numbers, and Underscores only");
	 document.getElementById("form24").tun.focus();
	}
	else if (document.getElementById('tun').value.length <4) 
	{
	 alert("Username is too short");
	 document.getElementById("form24").tun.focus();
	}
	else if (document.getElementById('tun').value.length >=15) 
	{
	 alert("Username is long");
	 document.getElementById("form24").tun.focus();
	}
	else if (document.getElementById('loid').value == "") 
	{
	 alert("Please Enter Email ID");
	 document.getElementById("form24").loid.focus();
	}
	else if(emailreg.test(document.getElementById('loid').value) == false)
	{
	 alert("Invalid Email ID");
	 document.getElementById("form24").loid.focus();
	}
	else if (document.getElementById('mob').value == "") 
	{
	 alert("Please Enter Mobile Number");
	 document.getElementById("form24").mob.focus();
	}
	else if (isNaN(document.getElementById('mob').value)) 
	{
	 alert("Mobile Number Should be a Number");
	 document.getElementById("form24").mob.focus();
	}
	else if (document.getElementById('mob').value.length != 10) 
	{
	 alert("Invalid Mobile Number");
	 document.getElementById("form24").mob.focus();
	}
	else 
	{
	 document.getElementById('h').value = '1';
	 document.getElementById('form24').action = 'edit_teacher.php';
	 document.getElementById('form24').submit();
	}
   }
  </script>
 </head>

 <body>
  <form method="post" id="form24" action="" name="form24">
   <input type='hidden' id='h' name='h' value='0' />
   <input type='hidden' id='po' name='po' value = '<?php if(isset($row)) echo $row[0]; else echo ""; ?>'/>
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
	   <div class="post"> <h2 class="title"><a href="#"> Edit Teacher</a></h2>
		<div class="entry" style="line-height:25px;">
		 <label>Full Name</label><br />
		  <input type='text' id='fn' name='fn' autocomplete='off' class='txt' style="width:350px;"
		  	     value = '<?php if(isset($row)) echo $row[1]; else echo ""; ?>' /> <br />
		 <label>Address</label><br />
		  <textarea id='a' name='a' autocomplete='off' class='txt' style="width:350px;">
		   <?php if(isset($row)) echo $row[2]; else echo ""; ?>
		  </textarea> <br />
		 <label>UserName</label><br />
		  <input type='text' id='tun' name='tun' autocomplete='off' class='txt' style="width:350px;" 
				 value = '<?php if(isset($row)) echo $row[3]; else echo ""; ?>' /> <br />
		 <label>Email ID</label><br />
		  <input type='text' id='loid' name='loid' autocomplete='off' class='txt' style="width:350px;"
				 value = '<?php if(isset($row)) echo $row[4]; else echo ""; ?>' /> <br />
		 <label>Mobile</label><br />
		  <input type='text' id='mob' name='mob' autocomplete='off' class='txt' style="width:350px;"
				 value = '<?php if(isset($row)) echo $row[5]; else echo ""; ?>' /> <br />
 		 <div style="padding-top:15px;">&nbsp;&nbsp;&nbsp;&nbsp;
		  <input type="button" value='Update' class='btn' onclick='doSubmit();'  style="width:150px;"  />&nbsp;
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
				   <li><a href="manage_teacher.php" style="text-decoration:none;">Manage Teacher</a></li>
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