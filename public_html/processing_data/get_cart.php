<?php
session_start();
if(isset($_SESSION['userid'])){
    require("../connection.php");
$userId=$_SESSION['userid'];

$sql = "SELECT * FROM product INNER JOIN cart ON
    product.id=cart.product_id WHERE cart.user_id=$userId";
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
        'inCart' => $row['in_cart'],
    );

    $products[] = $product;
}

// Convert PHP array to JSON string
$productsJson = json_encode($products);

echo  $productsJson;
}
?>