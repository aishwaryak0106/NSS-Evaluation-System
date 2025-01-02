<?php
 session_start();

 if(  ! (isset($_SESSION['loginid'])  && isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'officer') )
 {
  header('Location:../login.php');
 }
 require_once("../connection.php");
	
 $con = mysqli_connect($servername, $username, $password);
 mysqli_select_db($con , $db);

 $target_dir = "../uploads/";
 $basefile = basename($_FILES["image"]["name"]);
 $target_file = $target_dir . basename($_FILES["image"]["name"]);

 if(getimagesize($_FILES["image"]["tmp_name"]))
 {
  move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
  include "../connection.php";
  $query ="insert into events (title,news,addeddate,image,status)
                  values ('$_POST[et]', '$_POST[nw]', '$_POST[date]','$basefile', '1' ) ; ";
  mysqli_query($con, $query);

  if(mysqli_affected_rows($con)== 1)
  {
   echo "<script>alert('Event Added Successfully..'); document.location.href='../events.php';</script>";
  }
  else
  {
   echo "<script>alert('Error. Please Retry'); document.location.href= 'add_event.php';</script>";
  }
 }

?>