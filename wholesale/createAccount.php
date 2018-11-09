<?php
	$serverName="localhost";
	$userName="root";
	$password="";
	$dbName="wholesale";

	$conn=mysqli_connect($serverName,$userName,$password,$dbName);
	if($conn){
		$userName=$_POST['newUserName'];
		$name=$_POST['newName'];
		$email=$_POST['newEmail'];
		$pass=$_POST['newPass'];
		$confirm=$_POST['newConfirmPass'];
		$sql="select cust_id from customer where cust_id='$userName'";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_num_rows($result);
		if ($row!=0) {
				echo "<script>alert('User Name already taken!');</script>";
				header("refresh:0;url=loginPage.php");
		}
		else{
			if($pass!=$confirm){
			echo "<script>alert('Passwords do not match!');</script>";
			header("refresh:0;url=loginPage.php");
			}
			else{
			$sql="insert into customer(cust_id,cust_name,email_id,password) values('$userName','$name','$email','$pass')";
			$result=mysqli_query($conn,$sql);
			$sql="select * from customer where email_id='$email';";
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($result);
			echo "<script>alert('Account Created. Your Username is: ".$row['cust_id']."\\nLogin with your new Account');</script>";
			header("refresh:0;url=loginPage.php");
			}
		}	
	}
	else{
		die("Connection is failed: ".mysqli_connect_error());
	}