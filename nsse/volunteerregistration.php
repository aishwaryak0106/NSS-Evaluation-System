<?php

 if(isset($_POST['h']) && $_POST['h'] == '1')
 {
   require_once("connection.php");

   $con = mysqli_connect($servername, $username, $password,$db);
   mysqli_select_db($con , $db);

   $query ="insert into login (username, password, usertype, doj, emailid, mobile, status) 
                   values ('$_POST[tun]', '$_POST[tpw]', 'volunteer', now(), '$_POST[loid]', '$_POST[mob]', 0); ";
   mysqli_query($con, $query);
			
   $rows = 0;
   $rows += mysqli_affected_rows($con);
     
   $query1 ="insert into volunteerdetails (volunteerid, fullname, dob, gender, height, weight, bloodgroup, place, 
	                                       address, department ) 
					values ( (select max(loginid) from login), '$_POST[n]', '$_POST[dob]', 
					        '$_POST[gender]', '$_POST[ht]', '$_POST[w]', '$_POST[b]','$_POST[p]', 
					        '$_POST[a]', '$_POST[d]'); ";
    		
   mysqli_query($con, $query1);
   $rows += mysqli_affected_rows($con);

   if($rows == 2)
   {
    echo "<script>alert('Volunteer Registered Successfully. Please Login After Approval'); document.location.href = 'login.php';</script>";
   }
   else
   {
    echo "<script>alert('Error. Please Retry '); document.location.href='volunteerregistration.php';</script>";
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

  <link href="css/style_login.css" rel="stylesheet" type="text/css" media="screen" />
  <link href = "css/jquery-ui.css" rel = "stylesheet">

  <script src = "js/jquery-1.10.2.js"> </script>  
  <script src = "js/jquery-ui.js"> </script>
  <script type="text/javascript">
      
   function doClear()
   {
	document.getElementById('n').value = "";
	document.getElementById('datepicker').value = "";
	document.getElementById('Male').checked = true;
	document.getElementById('Female').checked = false;
	document.getElementById('ht').value = "";
	document.getElementById('w').value = "";
	document.getElementById('b').value = "";
	document.getElementById('p').value = "";
	document.getElementById('d').value = "Select";
	document.getElementById('a').value = "";
	document.getElementById('tun').value = "";
	document.getElementById('tpw').value = "";
	document.getElementById('cpw').value = "";
	document.getElementById('loid').value = "";
	document.getElementById('mob').value = "";
   }
	  
   var emailreg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   var illegalChars = /\W/;//allow letters, numbers, and underscores      
	  
   function doLogin()
   {
	if (document.getElementById('n').value == "") 
	{
	 alert("Please Enter Volunteer Name");
	 document.getElementById("form2").n.focus();
	}
	else if( /[^a-zA-Z]/.test(document.getElementById('n').value))
	{
	 alert("Name is not alphanumeric");
	 document.getElementById("form2").n.focus();
	}
	else if (document.getElementById('datepicker').value == "") 
	{
	 alert("Please Select DOB");
	 document.getElementById("form2").datepicker.focus();
	}
	else if(document.getElementById('ht').value == "")
	{
	 alert("Please Enter Height");
     document.getElementById("form2").ht.focus();
	}
	else if (isNaN(document.getElementById('ht').value)) 
	{
	 alert("Height Measurement Should be a Number");
	 document.getElementById("form2").ht.focus();
	}
	else if(document.getElementById('w').value == "")
	{
	 alert("Please Enter Weight");
     document.getElementById("form2").w.focus();
	}
	else if (isNaN(document.getElementById('w').value)) 
	{
	 alert("Weight Measurement Should be a Number");
	 document.getElementById("form2").w.focus();
	}
	else if(document.getElementById('b').value == "")
	{
	 alert("Please Enter Blood Group");
     document.getElementById("form2").b.focus();
	}
	else if (document.getElementById('p').value == "")
	{
	 alert("Please Enter Place");
	 document.getElementById("form2").p.focus();
	}
	else if( /[^a-zA-Z]/.test(document.getElementById('p').value))
	{
	 alert("Place is not alphanumeric");
	 document.getElementById("form2").p.focus();
	}
	else if (document.getElementById('d').value == "Select") 
	{
	 alert("Please Select Department");
	 document.getElementById("form2").d.focus();
	}
	else if (document.getElementById('a').value == "") 
	{
	 alert("Please Enter Address");
     document.getElementById("form2").a.focus();
    }
	else if (document.getElementById('tun').value == "") 
	{
	 alert("Please Enter Username");
	 document.getElementById("form2").tun.focus();
	}
	else if (illegalChars.test(tun.value))
	{
	 alert("Username can accept Alphabets, Numbers, and Underscores only");
	 document.getElementById("form2").tun.focus();
	}
	else if (document.getElementById('tun').value.length <4) 
	{
	 alert("Username is too short");
	 document.getElementById("form2").tun.focus();
	}
	else if (document.getElementById('tun').value.length >=15) 
	{
	 alert("Username is long");
	 document.getElementById("form2").tun.focus();
	}
	else if (document.getElementById('tpw').value == "") 
	{
	 alert("Please Enter Password");
	 document.getElementById("form2").tpw.focus();
	}
	else if (document.getElementById('tpw').value.length <4) 
	{
	 alert("Password is too short");
	 document.getElementById("form2").tpw.focus();
	}
	else if (document.getElementById('tpw').value.length >=15) 
	{
	 alert("Password is long");
	 document.getElementById("form2").tpw.focus();
	}
	else if (document.getElementById('cpw').value == "") 
	{
	 alert("Please Confirm Your Password");
     document.getElementById("form2").cpw.focus();
	}
	else if (document.getElementById('tpw').value != document.getElementById('cpw').value) 
	{
	 alert("Passwords Should Match");
	 document.getElementById("form2").cpw.focus();
	}
	else if (document.getElementById('loid').value == "") 
	{
	 alert("Please Enter Email ID");
	 document.getElementById("form2").loid.focus();
	}
	else if(emailreg.test(document.getElementById('loid').value) == false)
	{
	 alert("Invalid Email ID");
	 document.getElementById("form2").loid.focus();
	}
	else if (document.getElementById('mob').value == "") 
	{
	 alert("Please Enter Mobile Number");
	 document.getElementById("form2").mob.focus();
	}
	else if (isNaN(document.getElementById('mob').value)) 
	{
	 alert("Mobile Number Should be a Number");
	 document.getElementById("form2").mob.focus();
	}
	else if (document.getElementById('mob').value.length != 10) 
	{
	 alert("Invalid Mobile Number");
	 document.getElementById("form2").mob.focus();
	}
	else 
	{
	 document.getElementById('h').value = '1';
	 document.getElementById('form2').action = 'volunteerregistration.php';
	 document.getElementById('form2').submit();
	}
   } 
  
  </script>
 </head>
 
 <body>
  <form method='post' id="form2" name="form2" action=""  name="form2">
   <input type='hidden' name='h' id='h' value='1' />   
	<div id="wrapper">
     <div id="header">
      <div id="logo">
	   <h1><a href="#">NSS Evaluation System</a></h1>
   	  </div>
     </div>
	 <div id="splash"><img src="img/login/handlogo.jpg" alt="" title="" style="width:980px; height:340px;" />
	 </div>
	 <!-- end #header -->
	    
     <div id="page">
      <div id="page-bgtop">
       <div id="page-bgbtm">
        <div id="content">
         <div class="post">
		  <h2 class="title"><a href="#"> Volunteer Registration </a></h2>
		  <div class="entry" style="line-height:25px;">
           <label>Name</label><br />
		    <input type='text' id='n' name='n' autocomplete='off' class='txt' style="width:350px;"/> <br />
		   <label>DOB</label><br />
		    <input type='text' id="datepicker" name='dob' autocomplete='off' class='txt' style="width:350px;" /> <br />
		   <label>Gender: </label><br />
		    <input type="radio" name="gender" id="Male" value="Male" checked>
            <label for="Male">Male</label>
             <input type="radio" name="gender" id="Female" value="Female" />
            <label for="female">Female</label><br />
           <label>Height</label><br />
		    <input type='text' id='ht' name='ht' autocomplete='off' class='txt' style="width:350px;" /> <br />
		   <label>Weight</label><br />
			<input type='text' id='w' name='w' autocomplete='off' class='txt' style="width:350px;" /> <br />
		   <label>Blood Group</label><br />
			<input type='text' id='b' name='b' autocomplete='off' class='txt' style="width:350px;" /> <br />
		   <label>Place</label><br />
		    <input type='text' id='p' name='p' autocomplete='off' class='txt' style="width:350px;" /> <br />
		   <label>Department</label><br />
		    <select class='txt' style="width:350px;" name='d' id='d'>
			 <option value="Select">Select</option>
			 <option value="Computer-Commerce">Computer-Commerce</option>
			 <option value="Maths-Commerce">Maths-Commerce</option>
			 <option value="Science">Science</option>
			 <option value="Computer-Science">Computer-Science</option>
			 <option value="Humanities">Humanities</option>
			</select><br />
		   <label>Address</label><br />
			<textarea id='a' name='a' autocomplete='off' class='txt' style="width:350px;"></textarea> <br />
		   <label>User Name </label><br />
			<input type='text' id='tun' name='tun' autocomplete='off' class='txt' style="width:350px;"/> <br />
		   <label>Password</label><br />
			<input type='password' id='tpw' name='tpw' class='txt' style="width:350px;"/> <br />
		   <label>Confirm Password</label><br />
			<input type='password' id='cpw' name='cpw' class='txt' style="width:350px;"/> <br />
		   <label>Email ID</label><br />
			<input type='text' id='loid' name='loid' autocomplete='off' class='txt' style="width:350px;" /> <br />
		   <label>Mobile</label><br />
			<input type='text' id='mob' name='mob' autocomplete='off' class='txt' style="width:350px;" /> <br />
		   <div style="padding-top:15px;">
			<input type="button" value='Register' class='btn' onclick='doLogin();'  style="width:150px;"  />&nbsp;
			<input type="button" value='Clear' class='btn' onclick='doClear();'  style="width:150px;"  />
		   </div><br /> <br />
		  </div>
		 </div>
		 <div style="clear: both;">&nbsp;</div>
		</div>
		<!-- end #content -->
		    
		<div id="sidebar">
		 <ul><li><h2> Welcome</h2></li>
			 <li><ul><li><a href="index.php">Home</a></li>
				     <li><a href="login.php">Login</a></li>
				     <li><a href="volunteerregistration.php"  style="text-decoration:none;">Volunteer Registration</a></li>
				     <li><a href="forgotpassword.php">Forgot Password</a></li>
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