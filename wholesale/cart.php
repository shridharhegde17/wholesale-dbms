<?php
	session_start(); 
	if(!isset($_SESSION['loginUser'])){
		header("Location:logout.php");
	}
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
	<link rel='stylesheet' href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<title>Cart</title>


</head> 
<body>
	<div class="topStyle">
		<h2 style="color:white;">Wholesale DataBase Management</h2>
		<a class='userNameDisplay'><?php echo $_SESSION['loginUser']; ?></a>
	</div>
	<div class='sidebar'>
		<button onclick="location.href='customerHome.php'">Home</button>
		<button onclick="location.href='viewProductsCustomer.php'">View Products</button>
		<button onclick="location.href='order.php'">Order</button>
		<button onclick="location.href='cart.php'">Cart</button>
		<button onclick="location.href='customerViewTransactions.php'">My Transactions</button>
		<button onclick="location.href='logout.php'">Logout</button>
	</div>
<div class='container'>

	<fieldset><legend><b>Cart</b></legend>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='get'><table><tr><th>Product Name</th><th>Quantity</th><th>Price</th></tr>
		<?php 
			$conn=mysqli_connect("localhost","root","","wholesale");
			$curUser=$_SESSION['loginUser'];
			$sql="select * from cart where customer_id='$curUser'";
			$result=mysqli_query($conn,$sql);
			$totPrice=0;
			while($row=mysqli_fetch_assoc($result)){
				echo "<tr><td>".$row['product_name']."</td><td>".$row['quantity']."</td><td>".$row['price']."</td><td><button type='submit' class='goBtn' name='submit' value='".$row['product_id']."'>Remove</button></td></tr>";
				$totPrice+=$row['price'];
			}
			echo "</table><br><legend>Total Price: </legend>".$totPrice."</form><form action='placeOrder.php' method='get'>
		<button style='float:right;width:200px;height:5em;' type='submit' name='totalPrice' value='".$totPrice."' class='goBtn'>Continue</button></form>";
		?>
	</fieldset>
		<?php 
			if(isset($_GET['submit'])){
				$prodID=$_GET['submit'];
				$sql="select * from cart where product_id='$prodID' and customer_id='$curUser'";
				$result=mysqli_query($conn,$sql);
				$row=mysqli_fetch_assoc($result);
				$quan=$row['quantity'];
				$sql="select * from products where product_id='$prodID'";
				$result=mysqli_query($conn,$sql);
				$row=mysqli_fetch_assoc($result);
				$remQuan=$row['quantity'];
				$remQuan+=$quan;
				$sql="update products set quantity='$remQuan' where product_id='$prodID'";
				$result=mysqli_query($conn,$sql);
				$sql="delete from cart where product_id='$prodID' and customer_id='$curUser'";
				$result=mysqli_query($conn,$sql);
				header("Location:cart.php");
			}
		?>
		



</div>
</body>
</html>