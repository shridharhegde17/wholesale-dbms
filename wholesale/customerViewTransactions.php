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
	<title>My Transactions</title>


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

	<fieldset><legend><b>My Transactions</b></legend>
		<table class='tableLarge'><tr><th>Transaction ID</th><th>Amount</th><th>Payment Mode</th><th>Phone</th><th>Address</th><th>Date</th></tr>
		<?php 
			$conn=mysqli_connect("localhost","root","","wholesale");
			$curUser=$_SESSION['loginUser'];
			$sql="select * from transaction where customer_id='$curUser'";
			$result=mysqli_query($conn,$sql);
			while($row=mysqli_fetch_assoc($result)){
				echo "<tr><td>".$row['transaction_id']."</td><td>".$row['transaction_amount']."</td><td>".$row['payment']."</td><td>".$row['phone']."</td><td style='font-size: 15px;'>".$row['address']."</td><td>".$row['date']."</td></tr>";
			}
			echo "</table><br>";
		?>
	</fieldset>
	



</div>
</body>
</html>