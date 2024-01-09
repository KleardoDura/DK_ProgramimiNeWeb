<?php
session_start();
if(isset($_SESSION['userid'])){
    include("../connection.php");
    $productId=(int)$_POST['id'];
    $userId=$_SESSION['userid'];
    $pdate=date("Y-m-d");
    $quantity=(int) $_POST['inCart'];
	$sql="INSERT INTO cart  VALUES ($userId,$productId,'$pdate',$quantity)";
    $result=mysqli_query($con,$sql);
}		
?>