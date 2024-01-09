<?php
require("connection.php");
session_start();
$sql = "SELECT * FROM product WHERE quantity > 0 ORDER BY `product`.`rating` DESC";
$result = mysqli_query($con, $sql);

$products = array();

while ($row = mysqli_fetch_assoc($result)) {
    $product = array(
        'id' => $row['id'],
        'name' => $row['name'],
        'brand' => $row['brand'],
        'price' => $row['price'],
        'quantity' => $row['quantity'],
        'tag' => $row['tag'],
        'description' => $row['description'],
        'inCart' => 0
    );

    $products[] = $product;
}

// Convert PHP array to JSON string
$productsJson = json_encode($products);

echo "<script>let products = $productsJson; console.log(products);</script>";
?>


<!DOCETYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Shopping</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="jquery.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <?php
		require("navbar.php");
	?>

        <section id="page-header">

            <h2>#stayhome</h2>
            <p>Save money</p>
        </section>

        <section class="container2">
            <form>
                <i class="fas fa-search"></i>
                <input type="text" name="" id="search-item" placeholder="Search products" onkeyup="search()">
            </form>
        </section>


        <section id="product1" class="section-p1">
            <div id="pro-container" class="pro-container">
                <?php
			$sql="SELECT * FROM product WHERE quantity > 0 ORDER BY `product`.`rating` DESC";
			$result=mysqli_query($con,$sql);
			while($row=mysqli_fetch_assoc($result)){
				$stars="";
				for($i=1;$i<=$row['rating'];$i++)
					$stars=$stars."<i class='fas fa-star'></i>";
				echo "
					<div class='pro'>
						<img src='img/products/".$row['tag'].".jpg' alt='' class='pro-image'>
						<div class='des'>
							<span>".$row['brand']."</span>
							<h5>".$row['name']."</h5>
							<div class='star'>
								".$stars."
							</div>
							
							<h4>$".$row['price']."</h4>
						</div>
						<a href='#'><i class='fal fa-shopping-cart cart'></i></a>
			
					</div>";
			}
			?>
            </div>
        </section>

        <section id="pagination" class="section-p1">
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#"><i class="fal fa-long-arrow-alt-right"></i></a>
        </section>
        <?php		
			include("newsletter.php");
			include("footer.php");
		?>

        <script src="main.js"></script>
        <script src="search.js"></script>
    </body>



    </html>