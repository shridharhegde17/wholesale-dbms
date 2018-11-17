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
	<title>View Transactions</title>


</head> 
<body>
	<div class="topStyle">
		<h2 style="color:white;">Wholesale DataBase Management</h2>
		<a class='userNameDisplay'><?php echo $_SESSION['loginUser']; ?></a>
	</div>
	<div class='sidebar'>
		<button onclick="location.href='adminHome.php'">Home</button>
		<button onclick="location.href='viewProducts.php'">View Products</button>
		<button onclick="location.href='addStock.php'">Add Stock</button>
		<button onclick="location.href='addProduct.php'">Add New Product</button>
		<button onclick="location.href='depleted.php'">Depleted Products</button>
		<button onclick="location.href='customers.php'">Customers</button>
		<button onclick="location.href='transactions.php'">Transactions</button>
		<button onclick="location.href='logout.php'">Logout</button>
	</div>
<div class='container'>

	<fieldset><legend><b>Transactions</b></legend>
		<table class='tableLarge'><tr><th>Transaction ID</th><th>Customer ID</th><th>Amount</th><th>Payment Mode</th><th>Phone</th><th>Address</th><th>Date</th></tr>
		<?php 
			$conn=mysqli_connect("localhost","root","","wholesale");
			$sql="select * from transaction";
			$result=mysqli_query($conn,$sql);
			while($row=mysqli_fetch_assoc($result)){
				echo "<tr><td>".$row['transaction_id']."</td><td>".$row['customer_id']."</td><td>".$row['transaction_amount']."</td><td>".$row['payment']."</td><td>".$row['phone']."</td><td style='font-size: 15px;'>".$row['address']."</td><td>".$row['date']."</td></tr>";
			}
			echo "</table><br>";
		?>
	</fieldset>
	



</div>
</body>
</html>