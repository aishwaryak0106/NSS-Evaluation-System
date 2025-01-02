<?php
 session_start();

 if(! (isset($_SESSION['loginid']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'teacher') )
 {
  header("location: ../login.php");
 }
 if(isset($_POST['n']) && $_POST['n'] != "")
 {
  require_once("../connection.php");

  $con = mysqli_connect($servername, $username, $password);
  mysqli_select_db($con , $db);

  //2019-12-01 13:28:00.000
  $cd = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'] ;
		    
  $tn="select fullname from teacherdetails where teacherid = '$_SESSION[loginid]';";
  $re= mysqli_query($con, $tn);
  $row1=mysqli_fetch_array($re);
  $s= $row1['fullname'];
  echo $s;
  //exit();
  $query ="insert into charity (title, description, recipientname, mobile, items,
                           	    charitydate, teachername, place, address) 
		          values ('$_POST[tit]', '$_POST[des]', '$_POST[n]', '$_POST[mob]', '$_POST[it]', 
		                  '$cd', '$s', '$_POST[p]', '$_POST[a]' ); ";
  mysqli_query($con, $query);
  //echo $query;
	
  $rows = 0;
  $rows += mysqli_affected_rows($con);
	
  if($rows == 1)
  {
   echo "<script>alert('Charity Fixed'); document.location.href = 'teacher_home.php';</script>";
  }
  else
  {		
   echo "<script>alert('Error. Please Retry '); document.location.href='teacher_home.php';</script>";
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
	document.getElementById('tit').value = "";
	document.getElementById('des').value = "";
	document.getElementById('n').value = "";
	document.getElementById('mob').value = "";
	document.getElementById('p').value = "";
	document.getElementById('a').value = "";
	document.getElementById('day').value = "Day";
	document.getElementById('month').value = "Month";
	document.getElementById('year').value = "Year";
	document.getElementById('it').value = "";
   }
   function doSubmit() 
   {
	if (document.getElementById('tit').value == "") 
	{
	 alert("Please Enter Title of the Charity");
	 document.getElementById("form31").tit.focus();
	}
	else if (document.getElementById('des').value == "") 
	{
	 alert("Please Enter Details of Charity");
	 document.getElementById("form31").des.focus();
	}
	else if (document.getElementById('n').value == "") 
	{
	 alert("Please Enter Recipient Name");
	 document.getElementById("form31").n.focus();
	}
	else if (document.getElementById('mob').value == "") 
	{
	 alert("Please Enter Mobile Number");
	 document.getElementById("form31").mob.focus();
	}
	else if (isNaN(document.getElementById('mob').value)) 
	{
	 alert("Mobile Number Should be a Number");
	 document.getElementById("form31").mob.focus();
	}
	else if (document.getElementById('mob').value.length != 10) 
	{
	 alert("Invalid Mobile Number");
	 document.getElementById("form31").mob.focus();
	}
	else if (document.getElementById('p').value == "") 
	{
	 alert("Please Enter Place");
	 document.getElementById("form31").p.focus();
	}
	else if( /[^a-zA-Z]/.test(document.getElementById('p').value))
	{
	 alert("Place is not alphanumeric");
	 document.getElementById("form31").p.focus();
	}
	else if (document.getElementById('a').value == "") 
	{
	 alert("Please Enter Address");
	 document.getElementById("form31").a.focus();
	}
	else if (document.getElementById('day').value == "Day") 
	{
	 alert("Please Enter Day");
	 document.getElementById("form31").day.focus();
	}
	else if (document.getElementById('month').value == "Month") 
	{
	 alert("Please Enter Month");
	 document.getElementById("form31").month.focus();
	}
	else if (document.getElementById('year').value == "Year") 
	{
	 alert("Please Enter Year");
	 document.getElementById("form31").year.focus();
	}
	else if (document.getElementById('it').value == "") 
	{
	 alert("Please Enter Items");
	 document.getElementById("form31").it.focus();
	}
	else 
	{
	 document.getElementById('form31').action = 'allot_charity.php';
	 document.getElementById('form31').submit();
	}
   }
  </script>
 </head>
 
 <body>
  <form method='post' id="form31" action="allot_charity.php" name="form31">
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
	    <div class="post"><h2 class="title"><a href="#">Allot Charity</a></h2>
		 <div class="entry" style="line-height:25px;">
		  <label>Charity Title</label><br />
		   <input type='text' id='tit' name='tit' autocomplete='off' class='txt' maxlength='50' style="width:350px;"/> <br />
		  <label>Description</label><br />
		   <textarea type='text' id='des' name='des' autocomplete='off' class='txt' style="width:350px;"> </textarea><br />
		  <label>Recipient Name</label><br />
		   <input type='text' id='n' name='n' autocomplete='off' class='txt' maxlength='50' style="width:350px;"/> <br />
		  <label>Mobile</label><br />
		   <input type='text' id='mob' name='mob' autocomplete='off' class='txt' maxlength='50' style="width:350px;"/> <br />
		  <label>Place</label><br />
		   <input type='text' id='p' name='p' autocomplete='off' class='txt' maxlength='50' style="width:350px;"/> <br />
		  <label>Address</label><br />
		   <textarea id='a' name='a' autocomplete='off' class='txt' maxlength='250' style="width:350px;"><?php if(isset($row)) echo $row[3]; else echo ""; ?></textarea> <br />
		  <label>Date</label><br />
		   <select name="day" id="day" style="width:116px;">
		    <option value='Day'>Day</option>
	<?php
	 for($i=1;$i<=31;$i++)
	 {
	  echo "<option value='$i'>$i</value>";
	 }
	?>
	       </select>
	       <select name="month" id="month" style="width:116px;">
		    <option value='Month'>Month</option>
		    <option value='1'>January</option>
		    <option value='2'>February</option>
		    <option value='3'>March</option>
		    <option value='4'>April</option>
		    <option value='5'>May</option>
		    <option value='6'>June</option>
		    <option value='7'>July</option>
		    <option value='8'>August</option>
		    <option value='9'>September</option>
		    <option value='10'>October</option>
		    <option value='11'>November</option>
		    <option value='12'>December</option>
		   </select>
	       <select name="year" id="year" style="width:116px;">
		    <option value='Year'>Year</option>
	<?php
     for($i=2019;$i<=2021;$i++)
	 {
	  echo "<option value='$i'>$i</value>";
	 }
    ?>
	       </select><br />
		   <label>Items</label><br />
		    <input type='text' id='it' name='it' autocomplete='off' class='txt' maxlength='50' style="width:350px;"/> <br />
		   <div style="padding-top:15px;">&nbsp;&nbsp;&nbsp;&nbsp;
		    <input type="button" value='Add' class='btn' onclick='doSubmit();'  style="width:150px;"  />&nbsp;
		    <input type="button" value='Clear' class='btn' onclick='doClear();'  style="width:150px;"  />
		   </div> <br /> <br />
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
				     <li><a href="allot_charity.php" style="text-decoration:none;">Allot Charity</a></li>
				     <li><a href="charity_list.php">Charity List</a></li>
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
  </form>
 </body>
</html>