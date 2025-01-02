<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>National Service Scheme</title>

  <link href="../css/style_login.css" rel="stylesheet" type="text/css" media="screen" />
	
  <script src = "../js/jquery-1.10.2.js"> </script>  
  <script type="text/javascript">
   function doClear() 
   {
	document.getElementById('datepicker').value = "";
	document.getElementById('datepicker1').value = "";
   }
   function doSubmit() 
   {
	if (document.getElementById('datepicker').value == "") 
	{
	 alert("Please Enter From Date of the Charity");
	 document.getElementById("form33").datepicker.focus();
	}
	else if (document.getElementById('datepicker1').value == "") 
	{
	 alert("Please Enter To Date of Charity");
	 document.getElementById("form33").datepicker1.focus();
	}
	else 
	{
	 document.getElementById('form33').action = 'manage_charity.php';
	 document.getElementById('form33').submit();
	}
   }
  </script>
 </head>
 
 <body>
  <form method='post' id="form33" action="allot_charity.php" name="form33">
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
	   <div class="post"> <h2 class="title"><a href="#">Charity List</a></h2>
	    <div class="entry" style="line-height:25px;">
		 
		 <link href = "../css/jquery-ui.css" rel = "stylesheet">
		 <script src = "../js/jquery-ui.js"> </script>
	     <label>From Date</label><br />
		  <input type='text' id='datepicker' name='datepicker' autocomplete='off' class='txt' maxlength='50' style="width:350px;"/> <br />
		 <script>
		  var d = new Date(90,0,1);
		  $(function() 
		  {
			$( "#datepicker" ).datepicker({
			defaultDate:d, //set the default date to Jan 1st 1990
			changeMonth: true,
			changeYear: true,
			yearRange: '2000:2020', //set the range of years
			dateFormat: 'yy-mm-dd' //set the format of the date
			});
		  });
		 </script>
		 
		 <link href = "../css/jquery-uii.css" rel = "stylesheet">
         <script src = "../js/jquery-uii.js"> </script>
	     <label>To Date</label><br />
		  <input type='text' id='datepicker1' name='datepicker1' autocomplete='off' class='txt' maxlength='50' style="width:350px;"/> <br />
		 <script>
		  var d = new Date(90,0,1);
		  $(function() 
		  {
			$( "#datepicker1" ).datepicker1({
			defaultDate:d, //set the default date to Jan 1st 1990
			changeMonth: true,
			changeYear: true,
			yearRange: '2000:2020', //set the range of years
			dateFormat: 'yy-mm-dd' //set the format of the date
			});
		  });
		 </script>
		 <div style="padding-top:15px;">&nbsp;&nbsp;&nbsp;&nbsp;
		  <input type="button" value='Show' class='btn' onclick='doSubmit();'  style="width:150px;"  />&nbsp;
		  <input type="button" value='Clear' class='btn' onclick='doClear();'  style="width:150px;"  />
		 </div> <br /> <br />
		</div>
	   </div> <div style="clear: both;">&nbsp;</div>
	  </div>
	  <!-- end #content -->
	  
	  <div id="sidebar">
	   <ul><li> <h2> Teacher Home</h2> <div ></div><br /> </li>
		   <li><ul><li><a href="teacher_home.php">Home</a></li>
				   <li><a href="view_meetings.php">View Meetings</a></li>
				   <li><a href="manage_volunteer.php">Manage Volunteer</a></li>
                   <li><a href="allot_duty.php">Allot duty</a></li>
				   <li><a href="allot_charity.php">Allot Charity</a></li>
				   <li><a href="charity_list.php" style="text-decoration:none;">Charity List</a></li>
				   <li><a href="teacher_change_password.php">Change Password</a></li>
				   <li><a href="teacher_update_profile.php">Update Profile</a></li>
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