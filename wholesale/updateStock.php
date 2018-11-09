<?php
	session_start();
	if(!isset($_SESSION['loginUser'])){
		header("Location:logout.php");
	}
	$conn=mysqli_connect("localhost","root","","wholesale");
	if(isset($_GET['submit'])){
				$curUser=$_SESSION['loginUser'];
				$productID=$_GET['productID'];
				$quantity=$_GET['quantity'];
				$sql="select * from products where product_id='$productID'";
				$result=mysqli_query($conn,$sql);
				$rows=mysqli_num_rows($result);
				if($rows==0){
					echo "<script>alert('Invalid Product ID!');</script>";
					header("refresh:0;url=addStock.php");
				}
				else{
					$row=mysqli_fetch_assoc($result);
					$existQuantity=$row['quantity'];
					$newQuantity=$existQuantity+$quantity;
					$sql="update products set quantity='$newQuantity' where product_id='$productID'";
					$result=mysqli_query($conn,$sql);
					echo "<script>alert('Stock Updated');</script>";
					header("refresh:0;url=addStock.php");
				}
	}				
?>