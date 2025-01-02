<?php
 $servername="localhost";
 $username="root";
 $password="";
 $db="nsse";
//create connection
 $link=mysqli_connect($servername,$username,$password,$db);

//check connection
 if(!$link)
 {
   die("connection failed:".mysqli_connect_error());
 }
  //echo"connected successfully";
?>
  




























