<?php
session_start();
include("../connection.php");
if (isset($_SESSION['userid'])) {
    $productId =(int) $_POST['id'];
    $userId = $_SESSION['userid'];
    $quantity = (int) $_POST['inCart'];
    $date = date("Y-m-d");
    $sql = "INSERT INTO purchase  (user_id, product_id, purchase_date, quantity) VALUES ($userId,$productId,'$date',$quantity)";
    echo "$sql";
    $result = mysqli_query($con, $sql);
    if(!$result)
        echo "". mysqli_error($con);
}
?>