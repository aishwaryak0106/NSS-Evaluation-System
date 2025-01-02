<?php
 session_start();

 if(! (isset($_SESSION['loginid']) && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'teacher') )
 {
  header("location: ../login.php");
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
	 <div class="post"> <h2 class="title"><a href="#"> View Charity</a></h2>
    <?php 
	 if(isset($_GET['id']) && $_GET['id'] != 0)
	 {
	  include '../connection.php';

	  $sql = "select title, description, recipientname, mobile, items, charitydate
		             from charity where charityid = '$_GET[id]';";
	  $result = mysqli_query($link, $sql);
		
	  echo "<br><br><br><br>";
	  echo "<table class='mytable' style='width:100%;' >";
	  echo "<tr>";
	  echo "<td style='background-color:#045b5b;color:white; padding-left:5px;'>Title</td>";
	  echo "<td style='background-color:#045b5b;color:white; padding-left:5px;'>Description</td>";
	  echo "<td style='background-color:#045b5b;color:white; padding-left:5px;'>RecipientName</td>";
	  echo "<td style='background-color:#045b5b;color:white; padding-left:5px;'>Mobile</td>";
	  echo "<td style='background-color:#045b5b;color:white; padding-left:5px;'>Items</td>";
	  echo "<td style='background-color:#045b5b;color:white; padding-left:5px;'>CharityDate</td>";
	  echo "</tr>";
		
	  if(!$result)
	  {
	   echo "<td colspan='4' style='color:red; padding-left:5px;border-bottom:solid 1px #1d0058;text-align:center;'>No Records Found</td>";
	  }
	  else
	  {
	   while($row = mysqli_fetch_array($result))
	   {
		echo "<tr>";
		echo "<td style='color:#000000; padding-left:5px;border-bottom:solid 1px #ffff;'>$row[title]</td>";
		echo "<td style='color:#000000; padding-left:5px;border-bottom:solid 1px #ffff; text-align:left;'>$row[description]</td>";
		echo "<td style='color:#000000; padding-left:5px;border-bottom:solid 1px #ffff;'>$row[recipientname]</td>";
		echo "<td style='color:#000000; padding-left:5px;border-bottom:solid 1px #ffff;'>$row[mobile]</td>";
		echo "<td style='color:#000000; padding-left:5px;border-bottom:solid 1px #ffff;'>$row[items]</td>";
		echo "<td style='color:#000000; padding-left:5px;border-bottom:solid 1px #ffff;'>$row[charitydate]</td>";
		echo "</tr>";
	   }
	  }
	  echo "</table>";
	 }
	?>
   <div style="padding-top:15px;">&nbsp;&nbsp;&nbsp;&nbsp;<a href="charity_list.php">
	<input type="button" value='Back to Charity List' class='btn' style="width:200px;"  /></a>
   </div> <br /> <br />
   <div id="footer">
    <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> 
	   All rights reserved | NSS Project <i class="fa fa-heart-o" aria-hidden="true"></i> 
       Designed by Aishwarya.K Chandana.P Nivya.R Swaralaya.M
	</p>
   </div>
  </form>
 </body>
</html>