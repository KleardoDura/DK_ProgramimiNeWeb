<?php
    include("../connection.php");
    $productId=$_POST['productId'];
    $newQuantity=$_POST['changedQuantity'];
	$sql="UPDATE product SET quantity='$newQuantity' WHERE id=$productId";
    $result=mysqli_query($con,$sql);
		
?>