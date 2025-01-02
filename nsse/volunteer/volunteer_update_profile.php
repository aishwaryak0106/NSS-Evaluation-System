<?php
 session_start();

 if(! (isset($_SESSION['loginid']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'volunteer') )
 {
  header("location: ../login.php");
 }

 include '../connection.php';
            
 $sql = "select username, emailid, mobile, fullname, dob, height, weight, bloodgroup, place, address, department from login 
                join volunteerdetails on login.loginid = volunteerdetails.volunteerid where loginid ='$_SESSION[loginid]'and status=1;";
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

  $query ="update volunteerdetails set fullname = '$_POST[fn]', dob='$_POST[dob]', height='$_POST[ht]', weight='$_POST[w]', bloodgroup='$_POST[b]', address='$_POST[a]' where volunteerid = '$_SESSION[loginid]' ;";
  mysqli_query($con, $query);

  $ar += mysqli_affected_rows($con);
  if($ar >= 0)
  {
   echo "<script>alert('Volunteer Profile Updated'); document.location.href='volunteer_home.php';</script>";
  }
  else
  {
   echo "<script>alert('Error. Please Retry'); document.location.href = 'volunteer_home.php';</script>";
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
  <link href = "css/jquery-ui.css" rel = "stylesheet">
	
  <script src = "js/jquery-1.10.2.js"> </script>  
  <script src = "js/jquery-ui.js"> </script>
  <script type="text/javascript">
   function doClear() 
   {
	document.getElementById('fn').value = "";
	document.getElementById('datepicker').value = "";
	document.getElementById('ht').value = "";
	document.getElementById('w').value = "";
	document.getElementById('b').value = "";
	document.getElementById('p').value = "";
	document.getElementById('a').value = "";
	document.getElementById('d').value = "Select";
	document.getElementById('loid').value = "";
	document.getElementById('mob').value = "";
   }
	  
   var emailreg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   var illegalChars = /\W/;//allow letters, numbers, and underscores
	  
   function doLogin() 
   {
	if (document.getElementById('tun').value == "") 
	{
	 alert("Please Enter UserName");
	 document.getElementById("form46").tun.focus();
	}
	else if (illegalChars.test(tun.value))
	{
	 alert("Username can accept Alphabets, Numbers, and Underscores only");
	 document.getElementById("form46").tun.focus();
	}
	else if (document.getElementById('tun').value.length <4) 
	{
	 alert("Username is too short");
	 document.getElementById("form46").tun.focus();
	}
	else if (document.getElementById('tun').value.length >=15) 
	{
	 alert("Username is long");
	 document.getElementById("form46").tun.focus();
	}
	else if (document.getElementById('fn').value == "") 
	{
	 alert("Please Enter FullName");
	 document.getElementById("form46").fn.focus();
	}
	else if( /[^a-zA-Z]/.test(document.getElementById('fn').value))
	{
	 alert("Fulname is not alphanumeric");
	 document.getElementById("form46").fn.focus();
	}
	else if (document.getElementById('datepicker').value == "") 
	{
	 alert("Please Enter DOB");
	 document.getElementById("form46").datepicker.focus();
	}
	else if (document.getElementById('ht').value == "") 
	{
	 alert("Please Enter Height");
	 document.getElementById("form46").ht.focus();
	}
	else if (isNaN(document.getElementById('ht').value)) 
	{
	 alert("Height Measurement Should be a Number");
	 document.getElementById("form46").ht.focus();
	}
	else if (document.getElementById('w').value == "") 
	{
	 alert("Please Enter Weight");
	 document.getElementById("form46").w.focus();
	}
	else if (isNaN(document.getElementById('w').value)) 
	{
	 alert("Weight Measurement Should be a Number");
	 document.getElementById("form46").w.focus();
	}
	else if (document.getElementById('b').value == "") 
	{
	 alert("Please Enter Blood Group");
	 document.getElementById("form46").b.focus();
	}
	else if (document.getElementById('p').value == "") 
	{
	 alert("Please Enter Place");
	 document.getElementById("form46").p.focus();
	}
	else if( /[^a-zA-Z]/.test(document.getElementById('p').value))
	{
	 alert("Place is not alphanumeric");
	 document.getElementById("form46").p.focus();
	}
	else if (document.getElementById('a').value == "") 
	{
	 alert("Please Enter Address");
	 document.getElementById("form46").a.focus();
	}
	else if (document.getElementById('d').value == "Select") 
	{
	 alert("Please Select Department");
	 document.getElementById("form46").d.focus();
	}
	else if (document.getElementById('loid').value == "") 
	{
	 alert("Please Enter Emailid");
	 document.getElementById("form46").loid.focus();
	}
	else if(emailreg.test(document.getElementById('loid').value) == false)
	{
	 alert("Invalid Email ID");
	 document.getElementById("form46").loid.focus();
	}
	else if (document.getElementById('mob').value == "") 
	{
	 alert("Please Enter Mobile Number");
	 document.getElementById("form46").mob.focus();
	}
	else if (isNaN(document.getElementById('mob').value)) 
	{
	 alert("Mobile Number Should be a Number");
	 document.getElementById("form46").mob.focus();
	}
	else if (document.getElementById('mob').value.length != 10) 
	{
	 alert("Invalid Mobile Number");
	 document.getElementById("form46").mob.focus();
	}
	else 
	{
	 document.getElementById('form46').action = 'volunteer_update_profile.php';
	 document.getElementById('form46').submit();
	}
   }
  </script>
 </head>

 <body>
  <form method='post' id="form46" action="" name="form46">
   <div id="wrapper">
	<div id="header">
	 <div id="logo"> <h1><a href="#">NSS Evaluation System</a></h1> </div>
	</div>
	<div id="splash"><img src="img/volunteerbg.jpg" alt="" title="" style="width:980px; height:340px;" /></div>
	<!-- end #header -->
	
	<div id="page">
	 <div id="page-bgtop">
	  <div id="page-bgbtm">
	   <div id="content">
	    <div class="post"> <h2 class="title"><a href="#"> Update Volunteer Profile</a></h2>
	     <div class="entry" style="line-height:25px;">
		  <label>User Name</label><br />
		   <input type='text' id='tun' name='tun' autocomplete='off' class='txt' maxlength=' ' style="width:350px;" 
		  	      value = '<?php  if(isset($row)) echo $row[0]; else echo ""; ?>' readonly /> <br />
		  <label>Full Name</label><br />
		   <input type='text' id='fn' name='fn' autocomplete='off' class='txt' maxlength=' ' style="width:350px;" 
			      value = '<?php  if(isset($row)) echo $row[3]; else echo ""; ?>' /> <br />
		  <label>Date Of Birth</label><br />
		   <input type='text' id="datepicker" name='dob' autocomplete='off' class='txt' maxlength=' ' style="width:350px;" 
			      value = '<?php  if(isset($row)) echo $row[4]; else echo ""; ?>' /> <br />
		  <label>Height</label><br />
		   <input type='text' id='ht' name='ht' autocomplete='off' class='txt' maxlength=' ' style="width:350px;"
			      value = '<?php  if(isset($row)) echo $row['height']; else echo ""; ?>' /> <br /> 
          <label>Weight</label><br />  
           <input type='text' id='w' name='w' autocomplete='off' class='txt' maxlength=' ' style="width:350px;"
			      value = '<?php  if(isset($row)) echo $row['weight']; else echo ""; ?>' /> <br />
 		  <label>Blood Group</label><br />
		   <input type='text' id='b' name='b' autocomplete='off' class='txt' maxlength=' ' style="width:350px;"
			      value = '<?php  if(isset($row)) echo $row['bloodgroup']; else echo ""; ?>' /> <br /> 
		  <label>Place</label><br />
		   <input type='text' id='p' name='p' autocomplete='off' class='txt' maxlength=' ' style="width:350px;" 
			      value = '<?php  if(isset($row)) echo $row['place']; else echo ""; ?>' /> <br />
		  <label>Address</label><br />
		   <textarea id='a' name='a' autocomplete='off' class='txt' maxlength='175' style="width:350px;">
		   <?php  if(isset($row)) echo $row['address']; else echo ""; ?></textarea> <br />
		  <label>Department</label><br />
		   <select class='txt' style="width:350px;" name='d' id='d'>
			<option value="Select">Select</option>
			<option value="Computer-Commerce" <?php if(isset($row) && $row[7] == 'Computer-Commerce') echo 'selected'; ?> >Computer-Commerce</option>
			<option value="Maths-Commerce" <?php if(isset($row) && $row[7] == 'Maths-Commerce') echo 'selected'; ?> >Maths-Commerce</option>
			<option value="Science" <?php if(isset($row) && $row[7] == 'Science') echo 'selected'; ?> >Science</option>
			<option value="Computer-Science" <?php if(isset($row) && $row[7] == 'Computer-Science') echo 'selected'; ?> >Computer-Science</option>
			<option value="Humanities" <?php if(isset($row) && $row[7] == 'Humanities') echo 'selected'; ?> >Humanities</option>
		   </select><br />
		  <label>Email ID</label><br />
		   <input type='text' id='loid' name='loid' autocomplete='off' class='txt' maxlength=' ' style="width:350px;" 
  			      value = '<?php  if(isset($row)) echo $row[1]; else echo ""; ?>' /> <br />
		  <label>Mobile</label><br />
		   <input type='text' id='mob' name='mob' autocomplete='off' class='txt' maxlength=' ' style="width:350px;" 
			      value = '<?php  if(isset($row)) echo $row[2]; else echo ""; ?>' /> <br />
		  <div style="padding-top:15px;">
		   <input type="button" value='Update' class='btn' onclick='doLogin();'  style="width:150px;"  />&nbsp;
		   <input type="button" value='Clear' class='btn' onclick='doClear();'  style="width:150px;"  />
		  </div>
		 </div>
		</div>
		<div style="clear: both;">&nbsp;</div>
	   </div>
	   <!-- end #content -->
	   
	   <div id="sidebar">
		<ul><li> <h2> Volunteer Home</h2> <div ></div><br /> </li>
			<li><ul><li><a href="volunteer_home.php">Home</a></li>
					<li><a href="view_mark.php">View Mark</a></li>
					<li><a href="volunteer_change_password.php">Change Password</a></li>
					<li><a href="volunteer_update_profile.php" style="text-decoration:none;">Update Profile</a></li>
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
      
   <div id="footer">
     <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script>
	    All rights reserved | NSS Project <i class="fa fa-heart-o" aria-hidden="true"></i>
	    Designed by Aishwarya.K Chandana.P Nivya.R Swaralaya.M
	 </p>
   </div>
   <script type="text/javascript">
    $('#datepicker').datepicker(
    {
      dateFormat: 'yy/mm/dd',
      // altField: '#thealtdate',
      //altFormat: 'yy-mm-dd'
    });
   </script>
  </form>
 </body>
</html>