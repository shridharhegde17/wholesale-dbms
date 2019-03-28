<?php
	session_start();
	if(!isset($_SESSION['loginUser'])){
		header("Location:logout.php");
	}
	$conn=mysqli_connect("localhost","root","","wholesale");
				$curUser=$_SESSION['loginUser'];
				$productID=$_GET['productID'];
				$quantity=$_GET['quantity'];
				$sql="select quantity from products where product_id='$productID' and  quantity<'$quantity'";
				$result=mysqli_query($conn,$sql);
				$rows=mysqli_num_rows($result);
				if($rows>0){
					echo "<script>alert('Quantity not available');</script>";
					header("refresh:0;url=order.php");
				}
				else{
					$sql="select * from products where product_id='$productID'";
					$result=mysqli_query($conn,$sql);
					$row=mysqli_fetch_assoc($result);
					$pName=$row['product_name'];
					$pPrice=$row['price'];
					$sql="select * from cart where product_id='$productID' and customer_id='$curUser'";
					$result=mysqli_query($conn,$sql);
					$row=mysqli_fetch_assoc($result);
					$existQuantity=$row['quantity'];
					if($existQuantity>0){
						$newQuantity=$existQuantity+$quantity;
						$pPrice*=$newQuantity;
						$sql="update cart set price='$pPrice',quantity='$newQuantity' where product_id='$productID' and customer_id='$curUser'";
						$result=mysqli_query($conn,$sql);
					}
					else{
						$pPrice*=$quantity;
						$sql="insert into cart values('$productID','$pName','$quantity','$pPrice','$curUser')";
						$result=mysqli_query($conn,$sql);
					}
					echo "<script>alert('Added to Cart');</script>";
					$sql="select quantity from products where product_id='$productID'";
					$result=mysqli_query($conn,$sql);
					$row=mysqli_fetch_assoc($result);
					$remQuantity=$row['quantity']-$quantity;
					$sql="update products set quantity='$remQuantity' where product_id='$productID'";
					$result=mysqli_query($conn,$sql);
					header("refresh:0;url=order.php");
				}	
?>