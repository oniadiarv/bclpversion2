<?php 

session_start(); 
			date_default_timezone_set('Asia/Manila');
			$time = date("Y-m-d h:i:s");
		   
			$host = "localhost";
			$user = "root";
			$password = "";
			$db = "bclp_db";
			$con = mysqli_connect($host,$user,$password,$db);
			$userType = $_SESSION['userType'];
			$username = $_SESSION["username"];
		   
						   $query = "INSERT INTO activity_log VALUES('','$userid', '$userType','$username','Log Out','$time')";
						   mysqli_query($con, $query);
		   
					   session_destroy();
		
         	header("Location: bclp_login.php");
?>
