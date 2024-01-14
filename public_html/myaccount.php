<?php
 	session_start();
	if(!isset($_SESSION['userid']))
		header("location:login.php");
    require("connection.php");
	$userId=(int) $_SESSION['userid'];
	$sql="SELECT * FROM user WHERE id=$userId";
	$result=mysqli_query($con,$sql);
	if(!$result){
		echo "Error: " . mysqli_error($con);
        die();
	}
	$row=mysqli_fetch_array($result);
	$points=$row['points'];

        
?>
<!DOCETYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<title>MyAccount</title>
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
		</script>
	</head>

	<body>
		<?php
			  if((!isset($_SESSION['userid'])) || ($_SESSION['role']!='ADMIN')  ){
				
					require("navbar.php");
			  }else{
				require("admin_navbar.php");
			  }
		?>

		<section id="page-header">

			<h2>#MyAccount</h2>
			<p>Collect 1000 points to get 50$ free shopping</p>
		
		</section>
		<section id="cart-add" class="section-p1">
			<div class="subtotal">
				<!-- Kam kopjuar kodin tek cart-->
				<h3>Account Details</h3>
				<table class="MyAccount-details">
					<!--cart-total1 -->

					<tr>
						<td>Name</td>
						<td><?php echo $_SESSION['name'] ?></td>
					</tr>
					<tr>
						<td>Surname</td>
						<td><?php echo $_SESSION['surname'] ?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?php echo $_SESSION['email'] ?></td>
					</tr>
					<tr>
						<td><strong>Total Points:</strong></td>
						<td><strong><?php echo $points ?></strong></td>
					</tr>

				</table>

				<button id="logout" class="normal">  <a href="logout.php" style="text-decoration: none; color: white;">Log out</a>  </button>
			</div>

		</section>


		<?php
			include("footer.php");
		?>

		<script src="main.js"></script>
		<script src="search.js"></script>
	</body>



	</html>