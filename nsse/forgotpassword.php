<?php

 session_start();
 include 'connection.php';
            
 $sql = "select username, password, emailid from login where username ='$_SESSION[username]' ;";
 $result = mysqli_query($link, $sql);
 $row = mysqli_fetch_array($result);


 if(isset($_POST['tun']) && $_POST['tun'] != "")
 {
	$con = mysqli_connect($servername, $username, $password);
	mysqli_select_db($con , $db);

	$query ="update login set password = '$_POST[tpw]' where username = '$_SESSION[username]' ;";
	mysqli_query($con, $query);
	
    $ar = 0;
	$ar += mysqli_affected_rows($con);

	if($ar >= 0)
	{
		echo "<script>alert('Password Changed'); document.location.href='login.php';</script>";
	}
	else
	{
		echo "<script>alert('Please Enter Valid Username'); document.location.href = 'forgotpassword.php';</script>";
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

    <script type="text/javascript">

	  function doClear()
	  {
	      document.getElementById('tun').value = "";
		  document.getElementById('loid').value = "";
	      document.getElementById('tpw').value = "";
		  document.getElementById('cpw').value = "";
	  }

	  function doLogin() 
	  {
		if (document.getElementById('tun').value == "") 
		{
	      alert("Please Enter Username");
	    }
	    else if (document.getElementById('loid').value == "") 
		{
	      alert("Please Enter Email ID");
	    }
	    else if (document.getElementById('tpw').value == "") 
		{
	      alert("Please Enter New Password");
	    }
		else if (document.getElementById('cpw').value == "") 
		{
	      alert("Please Confirm Password Again...");
	    }
	    else 
		{
	      document.getElementById('form3').action = 'forgotpassword.php';
	      document.getElementById('form3').submit();
	    }
	  }

    </script>

  </head>
  <body>

    <form method='post' id="form3" action="" name="form1">
      <div id="wrapper">
	    <div id="header">
		  <div id="logo">
	        
			<h1><a href="#">NSS Evaluation System</a></h1>
		  
		  </div>
 	    </div>
	    <div id="splash"><img src="img/login/handlogo.jpg" alt="" title="" style="width:980px; height:340px;" /></div>
	    <!-- end #header -->
	    <div id="page">
		  <div id="page-bgtop">
		    <div id="page-bgbtm">
			  <div id="content">
			    <div class="post">
				  <h2 class="title"><a href="#"> Forgot Password</a></h2>
				    
					<div class="entry" style="line-height:25px;">
					  <label>User Name </label><br />
		              <input type='text' id='tun' name='username' autocomplete='off' class='txt' 
				             maxlength='20' style="width:350px;" /> <br />
				   
					  <label>Email ID</label><br />
		              <input type='text' id='loid' name='loid' autocomplete='off' class='txt' 
					         maxlength='30' style="width:350px;" /> <br />
					  <label>New Password</label><br />
		              <input type='password' id='tpw' name='password' class='txt'  maxlength='14'  
				             style="width:350px;" /><br />
					  <label>Confirm Password</label><br />
		              <input type='password' id='cpw' name='password' class='txt'  maxlength='14'  
				          style="width:350px;" /><br />						 
					  
		                <div style="padding-top:15px;">&nbsp;&nbsp;&nbsp;&nbsp;
		                  <input type="button" value='Submit' class='btn' onclick='doLogin();'  style="width:150px;"  />&nbsp;
		                  <input type="button" value='Clear' class='btn' onclick='doClear();'  style="width:150px;"  />
		                </div><br /> <br />
				    </div>
                
				</div>
                <div style="clear: both;">&nbsp;</div>
              </div>
			  <!-- end #content -->
			  <div id="sidebar">
			    <ul>
				  
				  <li>
				    <h2> Welcome</h2>
		            <div ></div><br />
				  </li>
				  
				  <li>
				    <ul>
                      <li><a href="index.php">Home</a></li>
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
		   Designed by Aishwarya.K Chandana.P Nivya.R Swaralaya.M</a>
		</p>
      </div>
    
	</form>
  
  </body>
</html>