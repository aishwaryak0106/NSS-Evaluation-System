<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>National Service Scheme</title>

  <link href="css/style_login.css" rel="stylesheet" type="text/css" media="screen" />
   
  <script type="text/javascript">
     
   function doClear()
   {
    document.getElementById('tun').value = "";
 	document.getElementById('tpw').value = "";
   }
   function doSubmit() 
   {
	var illegalChars = /\W/;//allow letters, numbers, and underscores      
	if (document.getElementById('tun').value == "") 
	{
	 alert("Please Enter Username");
	 document.getElementById("form1").tun.focus();
	}
	else if (illegalChars.test(tun.value))
	{
	 alert("Username can accept Alphabets, Numbers, and Underscores only");
	 document.getElementById("form1").tun.focus();
	}
	else if (document.getElementById('tun').value.length <4) 
	{
	 alert("Username is too short");
	 document.getElementById("form1").tun.focus();
	}
	else if (document.getElementById('tun').value.length >=15) 
	{
	 alert("Username is long");
	 document.getElementById("form1").tun.focus();
	}
	else if (document.getElementById('tpw').value == "") 
	{
	 alert("Please Enter Password");
	 document.getElementById("form1").tpw.focus();
	}
	else if (document.getElementById('tpw').value.length <4) 
	{
	 alert("Password is too short");
	 document.getElementById("form1").tpw.focus();
	}
	else if (document.getElementById('tpw').value.length >=15) 
	{
	 alert("Password is long");
	 document.getElementById("form1").tpw.focus();
	}
	else 
	{
	 document.getElementById('form1').action = 'validation.php';
	 document.getElementById('form1').submit();
	}
   }

  </script>
 </head>

 <body>
  <form method="post" id="form1" action="#" name="form1">
   <div id="wrapper">
    <div id="header">
     <div id="logo">
	  <h1><a href="#">NSS Evaluation System</a></h1>
	 </div>
	</div>
	<div id="splash">
	 <img src="img/login/handlogo.jpg" alt="" title="" style="width:980px; height:340px;" />
	</div>
	<!-- end #header -->
	<div id="page">
	 <div id="page-bgtop">
	  <div id="page-bgbtm">
	   <div id="content">
	    <div class="post">
		 <h2 class="title"><a href="#"> Please Login</a></h2>
		 <div class="entry" style="line-height:25px;"><br/>
		  <label>User Name </label><br />
		   <input type='text' id='tun' name='username' autocomplete='off' class='txt' 
			      maxlength='20' style="width:350px;" /> <br />
		  <label>Password</label><br />
		   <input type='password' id='tpw' name='password' class='txt'  maxlength='14'  
			      style="width:350px;" /><br />
		  <div style="padding-top:15px;">
		   <input type="button" value="Submit" class='btn' onclick='doSubmit();'  />
			  &nbsp;&nbsp;&nbsp;&nbsp; 
		   <input type="button" value='Clear' class='btn' onclick='doClear();'  />
		  </div><br /> <br />
    	 </div>
     	</div>
 		<div style="clear: both;">&nbsp;</div>
	   </div>
	   <!-- end #content -->
			 
	   <div id="sidebar">
		<ul><li><h2> Welcome</h2><br/></li>
		  	<li><ul><li><a href="index.php">Home</a></li>
					<li><a href="login.php" style="text-decoration:none;">Login</a></li>
					<li><a href="volunteerregistration.php">Volunteer Registration</a></li>
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
   
   </form>
  </body>
</html>