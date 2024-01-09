<?php
	session_start();
?>
<!DOCETYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport"content="width=device-width,initial-scale=1.0">
	<title>Course</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
	<link rel="stylesheet" href="style.css">
	<script src="jquery.js"></script>
</head>
<body>
	<?php
		require("navbar.php");
	?>
	
    <section class="main-wrap" id="main-wrap">
		
	
    </section>
	<section id="comments">
		<div class="wrapper">
			<h3>You can explore a wealth of insights from our community!</h3>
			<div id="others-comments">
			</div>
			
			<div id="my-comment">
			</div>
			
		</div>
		
	</section>	

		
	<?php
			include("newsletter.php");
			include("footer.php");
	?>

	<script src="main.js"></script>
	<script src="product.js"></script>

</body>
</html>