<?php
	$serverName="localhost";
	$userName="root";
	$password="";
	$dbName="wholesale";

	$conn=mysqli_connect($serverName,$userName,$password,$dbName);

	if($conn){
		$user=$_POST['user'];
		$pass=$_POST['pass'];
		if ($user=="shridhar" and $pass=="shridhar") {
			session_start();
			$_SESSION['loginUser']=$user;
			header("Location:adminHome.php");
		}
		else{
			$sql="select * from customer where cust_id='$user' and password='$pass'";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)==0){
				echo "<script>alert('User ID or Password is incorrect!');</script>";
				header("refresh:0;url=loginPage.php");
			}
			else{
				session_start();
				$row=mysqli_fetch_assoc($result);
				$_SESSION['loginUser']=$user;
				header("Location:customerHome.php");
			}
		}
	}
	else{
		die("Connection is failed: ".mysqli_connect_error());
	}
?>