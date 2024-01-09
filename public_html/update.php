<?php
    session_start();
    include("connection.php");
    if((!isset($_SESSION['userid'])) || ($_SESSION['role']!='ADMIN')  ){
      header("location:login.php");
      die();
    }

    $productId=$_GET['id'];
    $sql="SELECT * FROM product WHERE id=$productId";
    $result=mysqli_query($con,$sql);
    if(!$result){
        echo "Error: " . mysqli_error($con);
        die();
    }
    $product=mysqli_fetch_assoc($result);
   
       

?>

<!DOCETYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
    </script>
    <script src='https://code.jquery.com/jquery-3.6.4.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
                
    
  </head>



  <body>
      <?php
          require("admin_navbar.php");
      ?>

    <section id="page-header">
      <h2>Update Product</h2>
    </section>

    
		<section id="cart-add" class="section-p1">
			<div class="details">
				<form  action="#" method="POST">
					<h3>Give the product details</h3>
					<span>Product Name:</span><input type="text" name="name" placeholder="Product Name" required value="<?php echo $product['name']; ?>">
					<span>Brand:</span><input type="text" name="brand" placeholder="Brand" required value="<?php echo $product['brand']; ?>"> 
					<span>Price:</span><input type="number" min="0" name="price" placeholder="Price" required value="<?php echo $product['price']; ?>">
                    <span>Quantity:</span><input type="number" min="0" name="quantity" placeholder="Quantity" required value="<?php echo $product['quantity']; ?>">
					<span>Tag:</span><input type="text" name="tag" placeholder="Tag" required value="<?php echo $product['tag']; ?>">
					<span>Product description:</span><textarea name="description" cols="30" rows="5" placeholder="Product description" required><?php echo $product['description']; ?></textarea>
                    
                    <button id="add" class="normal" name="update">Update Product</button>
                </form>
				<p>*Please fill out all fields</p>
			</div>
            <div class="right-image">
                <img src="img/products/<?php echo $product['tag'];?>.jpg">
            </div>
        </section>
<?php
 if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])){
        
    if( isset($_POST['name']) && !empty($_POST['name']) &&
        isset($_POST['brand']) && !empty($_POST['brand']) &&    
        isset($_POST['price']) && !empty($_POST['price']) &&
        isset($_POST['quantity']) && !empty($_POST['quantity']) &&
        isset($_POST['tag']) && !empty($_POST['tag']) &&
        isset($_POST['description']) && !empty($_POST['description'])  
    ){ 
        $name=$_POST['name'];
        $brand=$_POST['brand'];
        $price=(int) $_POST['price'];
        $quantity=(int) $_POST['quantity'];
        $tag=$_POST['tag'];
        $description=$_POST['description'];
        $sql="UPDATE product SET name='$name',brand='$brand',description='$description',price=$price,quantity=$quantity,tag='$tag' WHERE id=$productId";
        //$sql="INSERT INTO product (name,brand,description,price,quantity,rating,no_of_comments,tag) VALUES ('$name','$brand','$description',$price,$quantity,0,0,'$tag')";
        $result=mysqli_query($con,$sql);
            if(!$result){
                echo "Error: " . mysqli_error($con);
                die();
            }
            else{
                $_POST = array();
                echo "    
            <script> Swal.fire({
            icon: 'success',
            title: 'Your product has been updated',
            showConfirmButton: false,
            timer: 2500
            }).then(function() {
                window.location.href = 'update.php?id=$productId';
            });
            </script>";
            
            }
    }
}

?>

</body>
</html>