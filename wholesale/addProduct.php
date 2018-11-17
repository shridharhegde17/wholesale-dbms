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
	<title>Add Product</title>


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

	<fieldset><legend><b>Add a Product</b></legend>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='get'>
			<label for='pName'> Product Name: </label><input id='pName' type=text class='formInputItem' name='pName' required><br>
			<label for='catID'>Category ID: </label><input id='catID' type=text class='formInputItem' name='catID' required><br>
			<label for='price'>Price: </label><input id='price' type=text class='formInputItem' name='price' required><br>
			<label for='quantity'>Quantity: </label><input id='quantity' type=text class='formInputItem' name='quantity' required><br>
			<label for='submit'></label><input class='goBtn' type=submit name='submit' value='Add Product'>
		</form>
	</fieldset>
	<?php
		$conn=mysqli_connect("localhost","root","","wholesale");
		if(isset($_GET['submit'])){
			$pName=$_GET['pName'];
			$catID=$_GET['catID'];
			$price=$_GET['price'];
			$quantity=$_GET['quantity'];
			$sql="select category_id from categories where category_id='$catID'";
			$result=mysqli_query($conn,$sql);
			$row=mysqli_num_rows($result);
			if(!$row){
				echo "<script>alert('Specified Category does not exist!');</script>";
				header("refresh:0;url=addProduct.php");
			}
			else{
				$sql="insert into products(product_name,category_id,price,quantity) values('$pName','$catID','$price','$quantity')";
				$result=mysqli_query($conn,$sql);
				echo "<script>alert('Product added');</script>";
				header("refresh:0;url=addProduct.php");
			}
		}
	?>



</div>
</body>
</html>