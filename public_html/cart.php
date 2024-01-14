<?php
	session_start();
	
	// echo "<script>
	// let products =[
	// 	{
	// 		name: 'T-Shirt',
	// 		tag: 'f1',
	// 		price: 70,
	// 		inCart:0
	// 	},
	// 	{
	// 		name: 'Shirt',
	// 		tag: 'f2',
	// 		price:30,
	// 		inCart:0
	// 	},
	// 	{
	// 		name: 'Shoes',
	// 		tag: 'f3',
	// 		price: 50,
	// 		inCart:0
	// 	},
	// 	{
	// 		name: 'White hoodie',
	// 		tag: 'f4',
	// 		price: 90,
	// 		inCart:0
	// 	},
	// 	{
	// 		name: 'Full-Zip Jacket',
	// 		tag: 'f5',
	// 		price: 100,
	// 		inCart:0
	// 	},
	// 	{
	// 		name: 'Casual Shirt',
	// 		tag: 'f6',
	// 		price: 10,
	// 		inCart:0
	// 	},
	// 	{
	// 		name: 'Puffer Jacket',
	// 		tag: 'f7',
	// 		price: 70,
	// 		inCart:0
	// 	},
	// 	{
	// 		name: 'Formal Shirt',
	// 		tag: 'f8',
	// 		price: 70,
	// 		inCart:0
	// 	}
	// ];
	// </script>";
	
	?>

<!DOCETYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<title>Shopping</title>
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">		</script>
    	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="jquery.js"></script>
		<script type="text/javascript">
			(function () {
				emailjs.init("aHxlyyt3xBnTZ_q4O");
			})();
		</script>
	</head>

	<body>
		<?php
			require("navbar.php");
		?>

		<section id="page-header">

			<h2>#cart</h2>
			<p>Let's buy</p>
		</section>

		<section id="cart" class="section-p1">
			<table width="100%">
				<thead>
					<tr>
						<td>Remove</td>
						<td>Image</td>
						<td>Product</td>
						<td>Price</td>
						<td>Quantity</td>
						<td>Subtotal</td>
					</tr>
				</thead>
				<tbody class="products">

				</tbody>

			</table>
		</section>

		<section id="cart-add" class="section-p1">
			<div class="details">
				<form name="RegForm" action="">
					<h3>Give your details</h3>
					<span id="nameError"></span><input type="text" name="Name" placeholder="Your Name" value="<?php if(isset($_SESSION['userid'])) echo $_SESSION['name']; ?>">
					<span id="emailError"></span><input type="text" name="EMail" placeholder="Email" value="<?php if(isset($_SESSION['userid'])) echo $_SESSION['email']; ?>">
					<span id="phoneError"></span><input type="text" maxlength="10" name="Telephone"
						placeholder="Phone Number">
					<span id="addressError"></span><textarea name="Address" id="" cols="30" rows="10"
						placeholder="Your Address"></textarea>
				</form>
				<p>*Please fill out all fields</p>
			</div>
			<div class="subtotal">
				<h3>Cart Totals</h3>
				<table class="cart-total1">

					<tr>
						<td>Cart Subtotal</td>
						<td>$0,00</td>
					</tr>
					<tr>
						<td>Shipping</td>
						<td>Free</td>
					</tr>
					<tr>
						<td><strong>Total:</strong></td>
						<td><strong>$0,00</strong></td>
					</tr>

				</table>
				<!---->

				<button id="buyNow" class="normal">Buy Now</button>
				<!-- Trigger/Open The Modal -->


				<!-- The Modal -->
				<div id="myModal" class="modal">

					<!-- Modal content -->
					<div class="modal-content">
						<span class="close">&times;</span>
						<p>Thank you for your order!</p>
					</div>

				</div>

				<!-- The Modal -->
				<div id="myModal2" class="modal">

					<!-- Modal content -->
					<div class="modal-content">
						<span class="close1">&times;</span>
						<p>Sorry but your Cart is Empty!</p>
					</div>

				</div>
			</div>

		</section>


		<?php
	    	include("newsletter.php");
			include("footer.php");
		?>

		<script src="cart.js"></script>
	</body>



	</html>