<?php
    session_start();
    include("connection.php");
    if((!isset($_SESSION['userid'])) || ($_SESSION['role']!='ADMIN')  ){
      header("location:login.php");
      die();
    }
    $sql="SELECT * FROM product";
    $products=mysqli_query($con,$sql);
    if(!$products){
        echo "Error: " . mysqli_error($con);
        die();
    }
   
       

?>

<!DOCETYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>All Products</title>
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
      <h2>All Products</h2>
    </section>

    <section id="cart" class="section-p1">
      <table width="100%">
        <thead>
          <tr>
            <td>Image</td>
            <td>Name</td>
            <td>Brand</td>
            <td>Price</td>
            <td>Quantity</td>
            <td>Tag</td>
            <td>Modify</td>
            <td>Delete</td>
          </tr>
        </thead>
        <tbody class="products">
          <tr>
            <?php
              while($row=mysqli_fetch_assoc($products)){
            ?>  
                <td><img src="img/products/<?php echo $row['tag']; ?>.jpg"></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['brand'];?></td> 
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $row['tag']; ?></td>
                <td><a href="update.php?id=<?php echo $row['id']; ?>">
                    <button class="normal" style="padding:15px;background-color: blue;">Modify</button></a> </td>
                <td><button class="red" onclick="deleteItem(<?php echo $row['id']; ?>)" style="padding:15px">Delete</button></td>
                </tr>
            <?php    
              } 

            ?>
        </tbody>

      </table>
</body>
<script>
    function deleteItem(productId){
        Swal.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
  if (result.isConfirmed) {
    var product={productId:productId};
    $.ajax({
        type:"POST",
        url:"processing_data/delete_product.php", 
        data:product,
        success: function(res){
            console.log(res);
            if(res){
                Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success"
            });
            window.location.href = "allproducts.php";
            }else{
                Swal.fire({
                title: "Not Deleted!",
                text: "Your file has not been deleted.Try again later!",
                icon: "error"
                    });  
            }
        },
        error: function(err){
            console.log(err);
        }
    });
  }
});
    }
</script>
</html>

