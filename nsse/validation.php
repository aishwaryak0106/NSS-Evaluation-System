<?php
 
 session_start();
  
 include 'connection.php';
         
 if ($_SERVER['REQUEST_METHOD'] == "POST") 
 {
   $username = $_REQUEST['username'];
   $password = $_REQUEST['password'];
            
   $sql = "select loginid, usertype from login where username='$username' and 
	 	   password='$password' and status=1;";
   
   $result = mysqli_query($link, $sql);
      
   $row = mysqli_fetch_array($result);
      
   if(isset($row) && $row[0] != "")
   {
     $_SESSION['loginid'] = $row[0];
	 $_SESSION['usertype'] = $row[1];
          
	 if($_SESSION['usertype'] == "admin")
     {
	   echo "<script>window.location.assign('admin/admin_home.php');</script>";
     }
     else if($_SESSION['usertype'] == "officer")
     {
	   echo "<script>window.location.assign('programofficer/program_officer_home.php');</script>";
     }
     else if($_SESSION['usertype'] == "teacher")
     {
	   echo "<script>window.location.assign('teacher/teacher_home.php');</script>";
     }
     else if($_SESSION['usertype'] == "volunteer")
     {
	   echo "<script>window.location.assign('volunteer/volunteer_home.php');</script>";
     }
     else
     {
	   echo "<script>alert('Invalid Credentials. Please Retry');window.location.assign('login.php');</script>";
     }
          
    } 
    else 
    {
	  echo "<script>alert('Invalid Credentials. Please Retry');window.location.assign('login.php');</script>";
    }
  }

?>